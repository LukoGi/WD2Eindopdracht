<?php
namespace Services;

use Repositories\UserRepository;

class UserService {

    private $repository;

    function __construct()
    {
        $this->repository = new UserRepository();
    }

    public function createUser($user) {
        return $this->repository->createUser($user);
    }

    public function checkUsernamePassword($username, $password) {
        return $this->repository->checkUsernamePassword($username, $password);
    }
}

?>