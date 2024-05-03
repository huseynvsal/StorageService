<?php

namespace App\Domains\Document\Events;

use App\Domains\Document\Models\Document;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DocumentCreating
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public Document $document
    ){}
}
