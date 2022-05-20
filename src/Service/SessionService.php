<?php

namespace Tringuyen\CarForRent\Service;

use Tringuyen\CarForRent\Model\Session;
use Tringuyen\CarForRent\Repository\SessionRepository;
use Tringuyen\CarForRent\Repository\UserRepository;

class SessionService
{
    public static $COOKIE_NAME = "X-SESSION";
    private $sessionRepository;
    private $userRepository;

    public function __construct(SessionRepository $sessionRepository, UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->sessionRepository = $sessionRepository;
    }

    public function create($userId)
    {
        $session =  new Session();
        $session->id = uniqid();
        $session->userid = $userId;
    }
}
