<?php

namespace Test\Tringuyen\CarForRent\Service;

use http\Cookie;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Functions\OpeningFunctionBraceKernighanRitchieSniff;
use PHPUnit\Framework\TestCase;
use Tringuyen\CarForRent\Model\Session;
use Tringuyen\CarForRent\Model\User;
use Tringuyen\CarForRent\Repository\SessionRepository;
use Tringuyen\CarForRent\Repository\UserRepository;
use Tringuyen\CarForRent\Service\CookieService;
use Tringuyen\CarForRent\Service\SessionService;


class SessionServiceTest extends TestCase
{
    /**
     * @return void
     */
    public function testGetUserIdSuccess()
    {
        $session = $this->getSession('lmao','1',60*60*24);
        $sessionRepositoryMock = $this->getMockBuilder(SessionRepository::class)->disableOriginalConstructor()->getMock();
        $sessionRepositoryMock->expects($this->once())->method('findById')->willReturn($session);
        $user = $this->getUser(1,'userexample', 'password');
        $userRepositoryMock = $this->getMockBuilder(UserRepository::class)->disableOriginalConstructor()->getMock();
        $userRepositoryMock->expects($this->once())->method('findById')->willReturn($user);
        $cookieService = $this->getMockBuilder(CookieService::class)->disableOriginalConstructor()->getMock();
        $resultSessionService = new SessionService($sessionRepositoryMock,$userRepositoryMock,$cookieService);
        $resultUserID = $resultSessionService->getUserId();
        $this->assertEquals(1,$resultUserID);

    }
    public function testGetUserIdFailed()
    {
        $session = new Session();
        $sessionRepositoryMock = $this->getMockBuilder(SessionRepository::class)->disableOriginalConstructor()->getMock();
        $sessionRepositoryMock->expects($this->once())->method('findById')->willReturn($session);
        $userRepositoryMock = $this->getMockBuilder(UserRepository::class)->disableOriginalConstructor()->getMock();
        $cookieService = $this->getMockBuilder(CookieService::class)->disableOriginalConstructor()->getMock();
        $sessionService = new SessionService($sessionRepositoryMock,$userRepositoryMock,$cookieService);
        $this->assertEquals(null,$sessionService->getUserId());
    }

    /**
     * @return void
     * @runInSeparateProcess
     */
    public function testSetUserIdSuccessful(): void
    {
        $session = $this->getSession('sess_id',1,60*60*24);
        $sessionRepositoryMock = $this->getMockBuilder(SessionRepository::class)->disableOriginalConstructor()->getMock();
        $sessionRepositoryMock->expects($this->once())->method('save')->willReturn($session);
        $userRepositoryMock = $this->getMockBuilder(UserRepository::class)->disableOriginalConstructor()->getMock();
        $cookieService = new CookieService();
        $sessionService = new SessionService($sessionRepositoryMock, $userRepositoryMock,$cookieService);
        $resultSet = $sessionService->setUserId(1);
        $this->assertTrue($resultSet);
    }

    /**
     * @return void
     * @runInSeparateProcess
     */
    public function testSetUserIdFailed(): void
    {
        $sessionRepositoryMock = $this->getMockBuilder(SessionRepository::class)->disableOriginalConstructor()->getMock();
        $sessionRepositoryMock->expects($this->once())->method('save')->willReturn(false);
        $userRepositoryMock = $this->getMockBuilder(UserRepository::class)->disableOriginalConstructor()->getMock();
        $cookieService = new CookieService();
        $sessionService = new SessionService($sessionRepositoryMock, $userRepositoryMock,$cookieService);
        $resultSet = $sessionService->setUserId(1);
        $this->assertFalse($resultSet);
    }
    /**
     * @runInSeparateProcess
     */
    public function testDestroyUserSuccessful()
    {
        $sessionRepositoryMock = $this->getMockBuilder(SessionRepository::class)->disableOriginalConstructor()->getMock();
        $sessionRepositoryMock->expects($this->once())->method('deleteById')->willReturn(true);
        $userRepositoryMock = $this->getMockBuilder(UserRepository::class)->disableOriginalConstructor()->getMock();
        $cookieService = new CookieService();
        $sessionService = new SessionService($sessionRepositoryMock, $userRepositoryMock,$cookieService);
        $resultDestroy = $sessionService->destroyUser();
        $this->assertTrue($resultDestroy);
    }

    /**
     * @runInSeparateProcess
     */
    public function testDestroyUserFailed()
    {
        $sessionRepositoryMock = $this->getMockBuilder(SessionRepository::class)->disableOriginalConstructor()->getMock();
        $sessionRepositoryMock->expects($this->once())->method('deleteById')->willReturn(false);
        $userRepositoryMock = $this->getMockBuilder(UserRepository::class)->disableOriginalConstructor()->getMock();
        $cookieService = new CookieService();
        $sessionService = new SessionService($sessionRepositoryMock, $userRepositoryMock,$cookieService);
        $resultDestroy = $sessionService->destroyUser();
        $this->assertFalse($resultDestroy);
    }

    /**
     * @return void
     * @runInSeparateProcess
     */
    public function testIsLogin(): void
    {
        $sessionServiceMock = $this->getMockBuilder(SessionService::class)->onlyMethods(['getUserId'])->disableOriginalConstructor()->getMock();
        $sessionServiceMock->method('getUserId')->willReturn(1);
        $resultIsLogin = $sessionServiceMock->isLogin();
        $this->assertTrue($resultIsLogin);
    }
    /**
     * @param $id
     * @param $userID
     * @param $lifetime
     * @return Session
     */
    private function getSession($id, $userID, $lifetime ): Session
    {
        $session = new Session();
        $session->setSessID($id);
        $session->setUserID($userID);
        $session->setSessLifetime($lifetime);
        return $session;
    }

    /**
     * @param $userID
     * @param $username
     * @param $password
     * @return User
     */
    private function getUser($userID, $username, $password): User
    {
        $user = new User();
        $user->setId($userID);
        $user->setUsername($username);
        $user->setPassword($password);
        return $user;
    }
}