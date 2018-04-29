<?php

namespace App\Services;

use App\Models\Users;
use App\Controllers\HttpExceptions\Http400Exception;

/**
 * Business-logic for users
 *
 * Class UsersService
 */
class UsersService extends AbstractService
{
    /** Unable to create user */
    const ERROR_UNABLE_CREATE_USER = 11001;

    /** User not found */
    const ERROR_USER_NOT_FOUND = 11002;

    /** No such user */
    const ERROR_INCORRECT_USER = 11003;

    /** Unable to update user */
    const ERROR_UNABLE_UPDATE_USER = 11004;

    /** Unable to delete user */
    const ERROR_UNABLE_DELETE_USER = 1105;

    /** Unable to delete user */
    const ERROR_INVALID_SIGNATURE = 1106;

    public function checkSignature()
    {
        $headers = $this->request->getHeaders();
        $user = $this->findUser($headers['Login']);

        if (!$user)
            throw new ServiceException('User not found', self::ERROR_USER_NOT_FOUND);

        $secret = $this->generateSecret($user);
        $signature = $this->generateSignature($secret);
        if ($signature != $headers['Signature'])
            throw new ServiceException('Incorrect signature', self::ERROR_INVALID_SIGNATURE);
    }

    private function findUser($login)
    {
        return Users::findFirst(
            [
                'conditions' => 'login = :login:',
                'bind' => [
                    'login' => $login
                ]
            ]
        );
    }

    private function generateSecret($user)
    {
        return $user->getPassword();
    }

    private function generateSignature($secret)
    {
        $requestText = $this->fetchRequestText();
        //echo hash_hmac('sha256', $requestText, $secret) . "  ---- ";
        //echo base64_encode(hash_hmac('sha256', $requestText, $secret));
        //die();
        return base64_encode(hash_hmac('sha256', $requestText, $secret));
    }

    private function fetchRequestText()
    {
        $body = $this->request->getRawBody();
        return $body ? $body : $this->request->getURI();
    }

    public function login(array $userData)
    {
        try {
            $user = $this->findUser($userData['login']);

            if (!$user)
                throw new ServiceException('User not found', self::ERROR_USER_NOT_FOUND);

            $user = $user->toArray();
            if ($user["password"] != hash('sha256', trim($userData["password"])))
                throw new ServiceException('Incorrect user password', self::ERROR_INCORRECT_USER);

            return true;

        } catch (\PDOException $e) {
            throw new ServiceException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Creating a new user
     *
     * @param array $userData
     */
    public function createUser(array $userData)
    {
        try {
            $user = new Users();
            $result = $user->setLogin($userData['login'])
                ->setPass(password_hash($userData['password'], PASSWORD_DEFAULT))
                ->setFirstName($userData['first_name'])
                ->setLastName($userData['last_name'])
                ->create();

            if (!$result)
                throw new ServiceException('Unable to create user', self::ERROR_UNABLE_CREATE_USER);

        } catch (\PDOException $e) {
            if ($e->getCode() == 23505) {
                throw new ServiceException('User already exists', self::ERROR_ALREADY_EXISTS, $e);
            } else {
                throw new ServiceException($e->getMessage(), $e->getCode(), $e);
            }
        }
    }

    /**
     * Updating an existing user
     *
     * @param array $userData
     */
    public function updateUser(array $userData)
    {
        try {
            $user = Users::findFirst(
                [
                    'conditions' => 'id = :id:',
                    'bind' => [
                        'id' => $userData['id']
                    ]
                ]
            );

            $userData['login'] = (is_null($userData['login'])) ? $user->getLogin() : $userData['login'];
            $userData['password'] = (is_null($userData['password'])) ? $user->getPass() : password_hash($userData['password'], PASSWORD_DEFAULT);
            $userData['first_name'] = (is_null($userData['first_name'])) ? $user->getFirstName() : $userData['first_name'];
            $userData['last_name'] = (is_null($userData['last_name'])) ? $user->getLastName() : $userData['last_name'];

            $result = $user->setLogin($userData['login'])
                ->setPass($userData['password'])
                ->setFirstName($userData['first_name'])
                ->setLastName($userData['last_name'])
                ->update();

            if (!$result) {
                throw new ServiceException('Unable to update user', self::ERROR_UNABLE_UPDATE_USER);
            }

        } catch (\PDOException $e) {
            throw new ServiceException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Delete an existing user
     *
     * @param int $userId
     */
    public function deleteUser($userId)
    {
        try {
            $user = Users::findFirst(
                [
                    'conditions' => 'id = :id:',
                    'bind' => [
                        'id' => $userId
                    ]
                ]
            );

            if (!$user) {
                throw new ServiceException("User not found", self::ERROR_USER_NOT_FOUND);
            }

            $result = $user->delete();

            if (!$result) {
                throw new ServiceException('Unable to delete user', self::ERROR_UNABLE_DELETE_USER);
            }

        } catch (\PDOException $e) {
            throw new ServiceException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Returns user list
     *
     * @return array
     */
    public function getUserList()
    {
        try {
            $users = Users::find(
                [
                    'conditions' => '',
                    'bind' => [],
                    'columns' => "id, login, first_name, last_name",
                ]
            );

            if (!$users) {
                return [];
            }

            return $users->toArray();
        } catch (\PDOException $e) {
            throw new ServiceException($e->getMessage(), $e->getCode(), $e);
        }
    }

}
