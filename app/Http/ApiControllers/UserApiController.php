<?php

namespace App\Http\ApiControllers;

use App\Exceptions\EntityNotFound;
use App\Exceptions\ValidationException;
use App\Services\API\UserServiceApi;
use App\Utils\ApiResponse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class UserApiController{

    public function __construct(
        private UserServiceApi $service,
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

            $this->service->create($request->all());

            return $this->apiResponse->success(null, 'User created successfully', 201);

        } catch(ValidationException $e){

            return $this->apiResponse->error($e->getMessage(), 422);
        }
    }

    public function update(int $id, Request $request): JsonResponse{

        try{

            $this->service->update($id, $request->all());

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
