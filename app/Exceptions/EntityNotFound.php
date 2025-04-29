<?php

namespace App\Exceptions;

use Exception;

class EntityNotFound extends Exception
{
    public function __construct(string $entityType = 'Entity', $code = 404, Exception $previous = null){
        parent::__construct("{$entityType} Not Found", $code, $previous);
    }
}
