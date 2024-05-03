<?php

namespace App\Domains\Document\Listeners;

use App\Domains\Document\Events\DocumentCreating;
use Illuminate\Support\Str;

class DocumentCreatingListener
{
    public function __construct()
    {
        //
    }

    public function handle(DocumentCreating $event): void
    {
        $document = $event->document;

        if (!isset($document->uuid)) {
            $document->uuid = Str::orderedUuid();
        }

        $document->local = 1;
    }
}
