<?php

namespace App\Exceptions;

use Exception;

class ValidationException extends Exception
{
    protected array $errors = [];


    public function __construct(array $errors, $code = 422, Exception $previous = null){

        $this->errors = $errors;

        parent::__construct('Validation failed', $code, $previous);
    }

    public function getErrors(){
        return $this->errors;
    }
}
