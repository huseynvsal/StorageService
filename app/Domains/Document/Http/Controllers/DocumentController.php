<?php

namespace App\Domains\Document\Http\Controllers;

use App\Domains\Document\Http\Requests\DocumentRequest;
use App\Domains\Document\Models\Document;
use App\Domains\Document\Services\Documents\DocumentService;
use App\Exceptions\UnreportableException;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class DocumentController extends Controller
{
    public function __construct(
        private DocumentService $documentService
    ){}

    public function store(DocumentRequest $request): JsonResponse
    {
        $uuid = $this->documentService->store($request->file('file'));

        return response()->json([
            'code' => 201,
            'uuid' => $uuid
        ], 201);
    }

    /**
     * @throws UnreportableException
     */
    public function get(Document $document): JsonResponse|string|null
    {
        return $this->documentService->get($document);
    }

    /**
     * @throws UnreportableException
     */
    public function destroy(Document $document): JsonResponse
    {
        $this->documentService->destroy($document);

        return response()->json(null,204);
    }
}
