<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Admin\ApiBaseController;
use \App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthenticateController extends ApiBaseController
{
    /**
     * @var UserRepository
     */
    protected $userRepository;


    /**
     * AuthenticateController constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Authenticate the user request
     * @param Request $request
     * @return JsonResponse
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        try {
            if (!$token = auth()->attempt($credentials)) {
                return $this->respondWithError('Unauthorized', 401);
            }
        } catch (JWTException $e) {
            return $this->respondWithError('Could not create token');
        }
        return $this->respondWithMessage("Token retrieved successfully",
            array(
                "access_token" => $token,
            )
        );
    }


    public function unauthorized(): JsonResponse
    {
        return $this->respondWithError('Unauthorized', 401);
    }

}
