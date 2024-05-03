<?php

namespace App\Domains\Document\Repositories;

use App\Domains\Document\Models\Document;
use Carbon\Carbon;

class DocumentRepository
{
    public function store(array $documentData): void
    {
        Document::create($documentData);
    }

    public function update(Document $document): void
    {
        $document->increment('download_count');
        $document->update(['last_downloaded_at' => Carbon::now()]);
    }

    public function destroy(Document $document): void
    {
        $document->delete();
    }
}
