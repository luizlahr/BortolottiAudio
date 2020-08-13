<?php

namespace Borto\Application\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Borto\Domain\Authentication\Logout;
use Borto\Application\Traits\ApiResponse;
use Borto\Domain\Shared\Services\AuthInfo;
use Borto\Application\Controllers\Controller;
use Borto\Domain\Authentication\AuthenticateUser;
use Borto\Application\Requests\AuthenticationRequest;
use Borto\Domain\Authentication\Entities\CredentialsEntity;

class AuthController extends Controller
{
    use ApiResponse;

    private AuthenticateUser $authenticateUser;
    private Logout $logout;
    private AuthInfo $auth;

    public function __construct(AuthenticateUser $authenticateUser, Logout $logout)
    {
        $this->authenticateUser = $authenticateUser;
        $this->logout = $logout;
    }

    public function authenticate(AuthenticationRequest $request)
    {
        $credentials = new CredentialsEntity($request->email, $request->password);
        $userData = $this->authenticateUser->authenticate($credentials);
        return $this->sendResponse($userData);
    }

    public function singOut()
    {
        $this->logout->handle();
        return $this->sendResponse(null, Response::HTTP_NO_CONTENT);
    }
}
