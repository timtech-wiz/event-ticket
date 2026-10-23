<?php

namespace App\Exceptions;

use Exception;

class InsufficientSeatsException extends Exception
{
    public function render()
    {
        return response()->json([
            'success' => false,
            'message' => $this->getMessage(),
        ], 409);
    }
}
