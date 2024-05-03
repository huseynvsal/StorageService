<?php

namespace App\Domains\Document\Services\Documents;

use App\Domains\Document\Models\Document;
use App\Domains\Document\Repositories\DocumentRepository;
use App\Exceptions\UnreportableException;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DocumentService implements DocumentServiceInterface
{
    private Filesystem $storage;

    public function __construct(
        private DocumentRepository $documentRepository
    )
    {
        $this->storage = Storage::disk('local');
    }

    public function store($file): string
    {
        $extension = $file->getClientOriginalExtension();
        $mimeType = $file->getClientMimeType();
        $uuid = Str::orderedUuid();

        $fileName = $uuid . '.' . $extension;
        $path = '/'.date('Y/m/d');

        $file->storeAs($path, $fileName);

        $this->documentRepository->store([
            'uuid' => $uuid,
            'path' => $path.'/'.$fileName,
            'mime_type' => $mimeType
        ]);

        return $uuid;
    }

    /**
     * @throws UnreportableException
     */
    public function get(Document $document): string
    {
        $this->setDisk($document);

        $path = $document->path;

        $this->validateExistence($path);

        $this->documentRepository->update($document);

        return $this->getFileContent($path, $document->mime_type);
    }

    /**
     * @throws UnreportableException
     */
    public function destroy(Document $document): void
    {
        $this->setDisk($document);

        $path = $document->path;

        $this->validateExistence($path);

        $this->storage->delete($path);

        $this->documentRepository->destroy($document);
    }

    /**
     * @throws UnreportableException
     */
    private function validateExistence(string $path): void
    {
        if (!$this->storage->exists($path)) {
            throw new UnreportableException("File not found in storage: " . $path, 404);
        }
    }

    private function getFileContent(string $path, ?string $mimeType): string
    {
        $content = $this->storage->get($path);

        if ($mimeType) {
            header('Content-Type: ' . $mimeType);
        }

        return $content;
    }

    private function setDisk(Document $document): void
    {
        if (!$document->local) {
            $this->storage = Storage::disk('s3');
        }
    }
}
