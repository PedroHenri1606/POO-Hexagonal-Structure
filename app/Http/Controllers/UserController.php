<?php

namespace App\Http\Controllers;

use App\Interfaces\UserServiceWebInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Request;

class UserController extends Controller{

    public function __construct(
        private UserServiceWebInterface $service
    ){}

    public function index(): View {

        $users = $this->service->findAll();

        return view('users.index', compact('users'));
    }

    public function show(int $id): View {

        $user = $this->service->findById($id);

        return view('users.show', compact('user'));
    }

    public function create(): View {

        return view('users.create');
    }

    public function store(Request $request): RedirectResponse {

        $this->service->create($request->all());

        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    public function edit(int $id){

        $user = $this->service->findById($id);

        return view('users.update', compact('user'));
    }

    public function update(int $id,Request $request): RedirectResponse {

        $this->service->update($id, $request->all());

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    public function destroy(int $id): RedirectResponse{

        $this->service->delete($id);

        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
