<?php

namespace Controllers;

use Exception;
use Services\UserService;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Models\User;

class UserController extends Controller
{
    private $service;

    function __construct()
    {
        $this->service = new UserService();
    }

    public function createUser()
    {
        try {
            $user = $this->createObjectFromPostedJson(User::class);
            $createdUser = $this->service->createUser($user);
            $this->respond($createdUser);
        } catch (\Exception $e) {
            error_log($e->getMessage());
            $this->respondWithError(500, "An error occurred while creating user");
        }
    }

    public function loginUser()
    {
        try {
            $user = $this->createObjectFromPostedJson(User::class);

            $loggedInUser = $this->service->checkUsernamePassword($user->username, $user->password);

            if (!$loggedInUser) {
                $this->respondWithError(401, "Invalid username or password");
                return;
            }

            $tokenResponse = $this->generateJwt($loggedInUser);

            $this->respond($tokenResponse);
        } catch (\Exception $e) {
            error_log($e->getMessage());
            $this->respondWithError(500, "An error occurred while logging in");
        }
    }

    public function generateJwt($user)
    {
        $jwt = \Firebase\JWT\JWT::encode([
            'iss' => 'THE_ISSUER',
            'aud' => 'THE_AUDIENCE',
            'iat' => time(),
            'exp' => time() + (60*60), 
            'data' => [
                'userId' => $user->id,
                'username' => $user->username,
            ]
        ], parse_ini_file('../.env')["SECRET_KEY"], 'HS256');

        return [
            'jwt' => $jwt,
            'userId' => $user->id
        ];
    }
}
