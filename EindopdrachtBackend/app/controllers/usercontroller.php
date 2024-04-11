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

    // initialize services
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
            // Create a User object from the posted JSON
            $user = $this->createObjectFromPostedJson(User::class);

            // Check the username and password
            $loggedInUser = $this->service->checkUsernamePassword($user->username, $user->password);

            if (!$loggedInUser) {
                $this->respondWithError(401, "Invalid username or password");
                return;
            }

            // Generate a JWT
            $jwt = $this->generateJwt($loggedInUser);

            // Respond with the JWT
            $this->respond(['jwt' => $jwt]);
        } catch (\Exception $e) {
            error_log($e->getMessage());
            $this->respondWithError(500, "An error occurred while logging in");
        }
    }

    private function generateJwt($user)
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
        ], parse_ini_file('../.env')["SECRET_KEY"]);

        return $jwt;
    }
}
