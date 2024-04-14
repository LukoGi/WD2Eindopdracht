<?php

namespace Repositories;

use PDO;
use PDOException;
use Repositories\Repository;

class UserRepository extends Repository
{
    public function createUser($user)
    {
        try {
            $user->password = $this->hashPassword($user->password);

            $stmt = $this->connection->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
            $stmt->bindParam(':username', $user->username);
            $stmt->bindParam(':password', $user->password);
            $stmt->execute();

            $user->id = $this->connection->lastInsertId();

            $user->password = "";

            return $user;
        } catch (PDOException $e) {
            error_log('Error creating user: ' . $e->getMessage());
            throw new \Exception('Error creating user');
        }
    }

    function checkUsernamePassword($username, $password)
    {
        try {
            $stmt = $this->connection->prepare("SELECT id, username, password FROM users WHERE username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Models\User');
            $user = $stmt->fetch();

            $result = $this->verifyPassword($password, $user->password);

            if (!$result)
                return false;

            $user->password = "";

            return $user;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    function verifyPassword($input, $hash)
    {
        return password_verify($input, $hash);
    }
}
