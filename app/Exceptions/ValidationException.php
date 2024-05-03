<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\JsonResponse;

class ValidationException extends Exception
{
    public function __construct(Validator $validator, string $class, int $code = 0,  ?\Throwable $previous = null)
    {
        $this->class = $class;

        $failed = $validator->failed();
        $this->rule = array_key_first($failed).'.'.strtolower(array_key_first($failed[array_key_first($failed)]));

        parent::__construct($validator->getMessageBag()->first(), $code, $previous);
    }

    public function render(): JsonResponse
    {
        $code = $this->getCode() ?? 400;
        $code = $code > 511 || $code < 100 ? 500 : $code;
        return response()->json(["code" => $code, "message" => $this->getMessage()], $code);
    }
}
