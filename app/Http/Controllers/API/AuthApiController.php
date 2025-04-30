<?php

namespace App\Http\Controllers\API;

use App\DTOS\Auth\AuthDtoRequestLogin;
use App\Http\Controllers\Controller;
use App\Interfaces\Auth\AuthApiServiceInterface;
use App\Utils\ApiResponse;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthApiController extends Controller{

    public function __construct(
        private AuthApiServiceInterface $service,
        private ApiResponse $apiResponse
    ){}

    public function login(Request $request): JsonResponse{

        try {

            $userDto = AuthDtoRequestLogin::fromArray($request->all());

            return $this->apiResponse->success($this->service->login($userDto), 200);

        } catch( Exception $e){

            return $this->apiResponse->error(null,$e->getMessage(), 401);
        }
    }

    public function logout(): JsonResponse{

        try {

            $this->service->logout();

            return $this->apiResponse->noContent();

        } catch( Exception $e){

            return $this->apiResponse->error(null,$e->getMessage(), 401);
        }
    }

    public function refreshToken(): JsonResponse{

        try {

            return $this->apiResponse->success($this->service->refresh(), 201);

        } catch( Exception $e){

            return $this->apiResponse->error(null,$e->getMessage(), 401);
        }
    }

    public function checkToken(): JsonResponse{

        try {

            return $this->apiResponse->success($this->service->checkToken(),200);

        } catch(Exception $e){

            return $this->apiResponse->error(null,$e->getMessage(),400);
        }
    }

    public function getTokenPayload(): JsonResponse{

        try {

            return $this->apiResponse->success($this->service->getTokenPayload(),200);

        } catch(Exception $e){

            return $this->apiResponse->error(null,$e->getMessage(),400);
        }
    }
}
