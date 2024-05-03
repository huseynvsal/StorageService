<?php

namespace App\Domains\Document\Services\Documents;

use App\Domains\Document\Models\Document;

interface DocumentServiceInterface
{
    public function store($file): string;

    public function get(Document $document): string;

    public function destroy(Document $document): void;
}
