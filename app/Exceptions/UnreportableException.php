<?php

namespace App\Exceptions;

use Exception;

class UnreportableException extends Exception
{
    public function render()
    {
        $code = $this->getCode() ?? 400;
        $code = $code > 511 || $code < 100 ? 500 : $code;
        return response()->json(["code" => $code, "message" => $this->getMessage()], $code);
    }
}
