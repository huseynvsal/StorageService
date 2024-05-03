<?php

namespace App\Domains\Document\Http\Requests;

use App\Http\Requests\ParentRequest;

class DocumentRequest extends ParentRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'file' => 'required|file|mimes:ppt,pptx,doc,docx,pdf,xls,xlsx,jpg,png,webp,adoc,html,gz,htm,zip,ogg,aac,txt,mp4,mpeg,amr,jpeg,3gp,wav,mp3,opus|max:16384'
        ];
    }
}
