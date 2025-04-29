<?php

namespace App\Http\Controllers\API;

use App\DTOS\User\UserDtoRequestCreate;
use App\DTOS\User\UserDtoRequestUpdate;
use App\Exceptions\EntityNotFound;
use App\Exceptions\ValidationException;
use App\Interfaces\UserServiceApiInterface;
use App\Utils\ApiResponse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class UserControllerApi{

    public function __construct(
        private UserServiceApiInterface $service,
        private ApiResponse $apiResponse
    ){}

    public function findById(int $id): JsonResponse{

        try {

            return $this->apiResponse->success($this->service->findById($id));

        } catch(EntityNotFound $e){

            return $this->apiResponse->error($e->getMessage(), 404);
        }
    }

    public function findAll(): JsonResponse{

        try{

            return $this->apiResponse->success($this->service->findAll());

        } catch(Exception $e){

            return $this->apiResponse->error('Unable to search for users', 500);
        }
    }

    public function create(Request $request): JsonResponse{

        try {

            $userDto = UserDtoRequestCreate::fromArray($request->all());

            $this->service->create($userDto);

            return $this->apiResponse->success(null, 'User created successfully', 201);

        } catch(ValidationException $e){

            return $this->apiResponse->error($e->getMessage(), 422);
        }
    }

    public function update(int $id, Request $request): JsonResponse{

        try{

            $userDto = UserDtoRequestUpdate::fromArray($request->all());

            $this->service->update($id, $userDto);

            return $this->apiResponse->success(null, 'User updated successfully', 200);

        } catch(ValidationException $e){

            return $this->apiResponse->error($e->getMessage(), 422);
        }
    }

    public function destroy(int $id): JsonResponse{

        try{

            $this->service->delete($id);

            return $this->apiResponse->noContent();

        } catch(EntityNotFound $e){

            return $this->apiResponse->error($e->getMessage(), 404);
        }
    }
}
