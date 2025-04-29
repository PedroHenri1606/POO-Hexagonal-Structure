<?php

namespace App\Utils;

use App\Exceptions\ValidationException;

class Validator{

    public function validate(array $data, array $rules): void{
        $validator = validator()->make($data, $rules);

        if($validator->fails()){
            throw new ValidationException($validator->errors()->toArray());
        }
    }
}
