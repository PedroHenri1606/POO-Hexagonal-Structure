<?php

namespace App\Http\Controllers\WEB;

use App\DTOS\Auth\AuthDtoRequestLogin;
use App\Exceptions\AuthFailedException;
use App\Http\Controllers\Controller;
use App\Interfaces\Auth\AuthWebServiceInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AuthWebController extends Controller{

    public function __construct(
        private AuthWebServiceInterface $service
    ){}

    public function index(): View{
        return redirect()->route('login.index');
    }

    public function login(Request $request): View{

        try{
            $userDto = AuthDtoRequestLogin::fromArray($request->all());

            $this->service->login($userDto);

            return redirect()->route('dashboard.index');

        } catch(AuthFailedException $e){
            return view('login.index', ['error' => $e->getMessage()]);
        }
    }

    public function logout(): View{

        $this->service->logout();

        return redirect()->route('login.index');
    }
}
