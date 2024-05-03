<?php

namespace App\Domains\Document\Models;

use App\Domains\Document\Events\DocumentCreating;
use App\Traits\HasRouteBinding;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory, HasRouteBinding;

    public $incrementing = false;
    protected $primaryKey = 'uuid';
    protected $fillable = [
        'uuid',
        'path',
        'mime_type'
    ];

    protected $dispatchesEvents = [
        'creating' => DocumentCreating::class
    ];
}
