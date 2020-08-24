<?php

namespace Borto\Application\Controllers;

use Borto\Application\Requests\CreateUserRequest;
use Borto\Application\Requests\UpdateUserRequest;
use Borto\Application\Traits\ApiResponse;
use Borto\Domain\Authentication\CreateUser;
use Borto\Domain\Authentication\DeleteUser;
use Borto\Domain\Authentication\Entities\UserRequestEntity;
use Borto\Domain\Authentication\Exceptions\UserNotFoundException;
use Borto\Domain\Authentication\Repositories\UserRepository;
use Borto\Domain\Authentication\UpdateUser;
use Illuminate\Http\Response;

class UserController extends Controller
{
    use ApiResponse;

    private CreateUser $createUser;
    private UpdateUser $updateUser;
    private DeleteUser $deleteUser;
    private UserRepository $userRepository;

    public function __construct(CreateUser $createUser, UpdateUser $updateUser, DeleteUser $deleteUser, UserRepository $userRepository)
    {
        $this->createUser = $createUser;
        $this->updateUser = $updateUser;
        $this->deleteUser = $deleteUser;
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $users = $this->userRepository->getAll();
        return $this->sendResponse($users->toArray());
    }

    public function store(CreateUserRequest $request)
    {
        $userRequest = new UserRequestEntity($request->all());

        $user = $this->createUser->handle($userRequest);
        return $this->sendResponse($user->toArray(), Response::HTTP_CREATED);
    }

    public function show(int $id)
    {
        $user = $this->userRepository->getById($id);

        // TODO: Move logic to a Action
        if (!$user) {
            throw new UserNotFoundException();
        }

        return $this->sendResponse($user->toArray());
    }

    public function update(int $id, UpdateUserRequest $request)
    {
        $userRequest = new UserRequestEntity($request->all());

        $user = $this->updateUser->handle($id, $userRequest);
        return $this->sendResponse($user->toArray());
    }

    public function destroy(int $id)
    {
        $this->deleteUser->handle($id);
        return $this->sendResponse(null, Response::HTTP_NO_CONTENT);
    }
}
