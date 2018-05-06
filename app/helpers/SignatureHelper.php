<?php

namespace App\Helpers;


use App\Controllers\AbstractHttpException;
use App\Controllers\HttpExceptions\Http400Exception;
use App\Models\Users;
use App\Services\ServiceException;
use App\Services\UsersService;

class SignatureHelper extends \Phalcon\DI\Injectable
{
    const ERROR_INVALID_SIGNATURE = 1106;

    public function checkSignature(): bool
    {
        $headers = $this->request->getHeaders();
        $user = $this->usersService->findByLogin($headers['Login']);

        if (!$user)
            throw new Http400Exception('User not found', UsersService::ERROR_USER_NOT_FOUND);

        $secret = $this->generateSecret($user);
        $signature = $this->generateSignature($secret);

        if ($signature != $headers['Signature'])
            throw new Http400Exception('Incorrect signature', self::ERROR_INVALID_SIGNATURE);
        else
            return true;
    }

    private function generateSecret($user)
    {
        return $user->getPassword();
    }

    private function generateSignature($secret)
    {
        $requestText = $this->fetchRequestText();
        return base64_encode(hash_hmac('sha256', $requestText, $secret));
    }

    private function fetchRequestText()
    {
        $body = $this->request->getRawBody();
        return $body ? $body : $this->request->getURI();
    }

}