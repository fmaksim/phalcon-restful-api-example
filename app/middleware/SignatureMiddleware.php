<?php

namespace App\Middleware;

use App\Services\ServiceException;
use Phalcon\Events\Event;
use Phalcon\Mvc\Micro;
use Phalcon\Mvc\Micro\MiddlewareInterface;

/**
 * FirewallMiddleware
 *
 * Checks the whitelist and allows clients or not
 */
class SignatureMiddleware extends \Phalcon\DI\Injectable implements MiddlewareInterface
{
    /**
     * Before anything happens
     *
     * @param Event $event
     * @param Micro $application
     *
     * @returns bool
     */
    public function beforeHandleRoute(Event $event, Micro $application)
    {
        $blockedRoutes = ['/login'];
        $queryUrl = $this->request->getQuery()["_url"];

        if (!in_array($queryUrl, $blockedRoutes)) {

            if ($this->signatureHelper->checkSignature()) {
                return true;
            }

            throw new ServiceException();
        }
        return true;
    }

    /**
     * Calls the middleware
     *
     * @param Micro $application
     *
     * @returns bool
     */
    public function call(Micro $application)
    {
        return true;
    }
}