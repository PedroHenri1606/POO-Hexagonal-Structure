<?php

namespace Tests\Unit;

use App\DTOS\User\UserDtoRequestCreate;
use App\DTOS\User\UserDtoRequestUpdate;
use App\Exceptions\EntityNotFound;
use App\Exceptions\ValidationException;
use App\Interfaces\User\UserRepositoryInterface;
use App\Models\User;
use App\Services\API\UserApiService;
use App\Utils\Validator;
use Mockery;
use Mockery\MockInterface;

beforeEach(function(){
    $this->repository = Mockery::mock(UserRepositoryInterface::class);
    $this->validator = Mockery::mock(Validator::class);

    $this->service = new UserApiService(
        $this->repository,
        $this->validator
    );
});

function expectValidatorToPass(MockInterface $validator){

    $validator->shouldReceive('validate')
        ->once()
        ->andReturnTrue();
}

function expectValidatorToFail(MockInterface $validator, array $errors){

    $validator->shouldReceive('validate')
        ->once()
        ->andThrow(new ValidationException($errors));
}

it('FindById - Exception', function () {
    $this->repository->shouldReceive('findById')
        ->with(1)
        ->andThrow(new EntityNotFound('User'));

    $this->service->findById(1);
})->throws(EntityNotFound::class);

it('FindById - Success', function () {

    $user = new User([
        'id'    => 10,
        'name'  => 'João',
        'email' => 'joao@email.com'
    ]);

    $this->repository->shouldReceive('findById')
        ->with(10)
        ->andReturn($user);

    $result = $this->service->findById(10);

    expect($result)->and($result->name)->toBe('João');
});

it('FindByEmail - Exception', function () {
    $this->repository->shouldReceive('findByEmail')
        ->andThrow(new EntityNotFound('User'));

    $this->service->findByEmail('joao@email.com');
})->throws(EntityNotFound::class);

it('FindByEmail - Success', function () {

    $user = new User([
        'id'    => 10,
        'name'  => 'João',
        'email' => 'joao@email.com'
    ]);

    $this->repository->shouldReceive('findByEmail')
        ->with('joao@email.com')
        ->andReturn($user);

    $result = $this->service->findByEmail('joao@email.com');

    expect($result)->and($result->email)->toBe('joao@email.com');
});

it('FindAll - Exception', function () {

    $this->repository->shouldReceive('findAll')
        ->andThrow(new EntityNotFound('User'));

    $result = $this->service->findAll();

})->throws(EntityNotFound::class);

it('FindAll - Success', function () {

    $this->repository->shouldReceive('findAll')
        ->andReturn([
            [
                'id'    => 1,
                'name'  => 'Pedro',
                'email' => 'pedro@email.com',
            ],
            [
                'id'    => 2,
                'name'  => 'João',
                'email' => 'joao@email.com',
            ],
        ]);

    $result = $this->service->findAll();

    expect($result)->and($result)->toHaveCount(2);
});

it('Create - Exception', function () {

    $userDto = new UserDtoRequestCreate('João', 'joao.com', '123');

    expectValidatorToFail($this->validator, [
        'email' => 'O campo email é obrigatório',
    ]);

    $this->service->create($userDto);

})->throws(ValidationException::class);

it('Create - Success', function () {

    $userDto = new UserDtoRequestCreate('João', 'joao@gmail.com', '123');

    expectValidatorToPass($this->validator);

    $this->repository->shouldReceive('create')
        ->once()
        ->with((array) $userDto)
        ->andReturnTrue();

    $result = $this->service->create($userDto);

    expect($result)->toBeTrue();
});

it('Update - Exception', function () {

    $userDto = new UserDtoRequestUpdate(10,'João', 'joao.com');

    $this->repository->shouldReceive('findById')
        ->once()
        ->with(1)
        ->andThrow(new EntityNotFound('User'));

    $this->service->update(1,$userDto);

})->throws(EntityNotFound::class);

it('Update - Exception - Invalid Operation', function () {

    $user = new User([
        'id'    => 1,
        'name'  => 'João',
        'email' => 'joao@email.com'
    ]);

    $userDto = new UserDtoRequestUpdate(10,'João', 'joao@gmail.com');

    $this->repository->shouldReceive('findById')
        ->once()
        ->with(1)
        ->andReturn($user);

    $this->service->update(1, $userDto);

})->throws(ValidationException::class);

it('Update - Success', function () {

    $user = new User([
        'id'    => 10,
        'name'  => 'João',
        'email' => 'joao@email.com'
    ]);

    $userDto = new UserDtoRequestUpdate(10,'Joãozinho', 'joao@gmail.com');

    expectValidatorToPass($this->validator);

    $this->repository->shouldReceive('findById')
        ->once()
        ->with(1)
        ->andReturn($user);

    $this->repository->shouldReceive('update')
        ->once()
        ->with((array) $userDto,1)
        ->andReturnTrue();

    $result = $this->service->update(1,$userDto);

    expect($result)->toBeTrue();
});

it('Delete - Exception', function () {

    $this->repository->shouldReceive('findById')
        ->once()
        ->with(1)
        ->andThrow(EntityNotFound::class);

    $this->service->delete(1);

})->throws(EntityNotFound::class);

it('Delete - Success', function () {

    $user = new User([
        'id'    => 10,
        'name'  => 'João',
        'email' => 'joao@email.com'
    ]);

    $this->repository->shouldReceive('findById')
        ->once()
        ->with(10)
        ->andReturn($user);

    $this->repository->shouldReceive('delete')
        ->once()
        ->with(10)
        ->andReturnTrue();

    $result = $this->service->delete(10);

    expect($result)->toBeTrue();
});
