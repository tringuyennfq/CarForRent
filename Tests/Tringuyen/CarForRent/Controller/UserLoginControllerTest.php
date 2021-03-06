<?php

namespace Test\Tringuyen\CarForRent\Controller;

use PHPUnit\Framework\TestCase;
use Tringuyen\CarForRent\Bootstrap\View;
use Tringuyen\CarForRent\Controller\UserLoginController;
use Tringuyen\CarForRent\Service\SessionService;
use Tringuyen\CarForRent\Service\UserService;
use Tringuyen\CarForRent\Model\User;
use Tringuyen\CarForRent\Transfer\UserLoginRequest;
use Tringuyen\CarForRent\Transformer\UserLoginResponse;
use Tringuyen\CarForRent\Validator\LoginValidator;

class UserLoginControllerTest extends TestCase
{
    /**
     * @return void
     * @runInSeparateProcess
     */
    public function testLoginSuccessful(): void
    {
        $userServiceMock = $this->getMockBuilder(UserService::class)->disableOriginalConstructor()->getMock();
        $userServiceMock->expects($this->once())->method('login')->willReturn($this->getUserLoginResponse($this->getUser(1,'khaitri','123456')));
        $userLoginRequestMock = $this->getMockBuilder(UserLoginRequest::class)->disableOriginalConstructor()->getMock();
        $userLoginRequestMock->expects($this->once())->method('getMethod')->willReturn('POST');
        $userLoginRequestMock->method('fromArray')->willReturn($userLoginRequestMock);
        $userLoginRequestMock->method('getBody')->willReturn(['username'=>'khaitri', 'password'=>'123456']);
        $userLoginResponseMock = $this->getMockBuilder(UserLoginResponse::class)->disableOriginalConstructor()->getMock();
        $userLoginValidatorMock = $this->getMockBuilder(LoginValidator::class)->disableOriginalConstructor()->getMock();
        $userLoginValidatorMock->expects($this->once())->method('validateUserLogin')->willReturn(true);
        $sessionServiceMock = $this->getMockBuilder(SessionService::class)->disableOriginalConstructor()->getMock();
        $sessionServiceMock->expects($this->once())->method('setUserId')->willReturn(true);

        $userLoginController = new UserLoginController($userServiceMock,$userLoginRequestMock,$userLoginResponseMock,$userLoginValidatorMock,$sessionServiceMock);
        $result = $userLoginController->login();
        $expected = View::redirect('/');
        $this->assertEquals($expected,$result);

    }

    /**
     * @return void
     * @runInSeparateProcess
     */
    public function testLoginFailed()
    {
        $userServiceMock = $this->getMockBuilder(UserService::class)->disableOriginalConstructor()->getMock();
        $userServiceMock->expects($this->once())->method('login')->willReturn(null);
        $userLoginRequestMock = $this->getMockBuilder(UserLoginRequest::class)->disableOriginalConstructor()->getMock();
        $userLoginRequestMock->expects($this->once())->method('getMethod')->willReturn('POST');
        $userLoginRequestMock->method('fromArray')->willReturn($userLoginRequestMock);
        $userLoginRequestMock->method('getBody')->willReturn(['username'=>'khaitri', 'password'=>'123456']);
        $userLoginResponseMock = $this->getMockBuilder(UserLoginResponse::class)->disableOriginalConstructor()->getMock();
        $userLoginValidatorMock = $this->getMockBuilder(LoginValidator::class)->disableOriginalConstructor()->getMock();
        $userLoginValidatorMock->expects($this->once())->method('validateUserLogin')->willReturn(true);
        $sessionServiceMock = $this->getMockBuilder(SessionService::class)->disableOriginalConstructor()->getMock();
        $sessionServiceMock->expects($this->once())->method('setUserId')->willReturn(true);

        $userLoginController = new UserLoginController($userServiceMock,$userLoginRequestMock,$userLoginResponseMock,$userLoginValidatorMock,$sessionServiceMock);
        $result = $userLoginController->login();
        $expected = View::renderView('User/login', [
            'title' => 'Login',
            'username' => $_POST['username'] ?? '',
            'password' => $_POST['password'] ?? '',
            'error' => 'Username or Password is invalid!'
        ]);
        var_dump($expected);
        die();
        $this->assertStringContainsString($result,$expected);

    }

    /**
     * @return void
     * @runInSeparateProcess
     */
    public function testLogoutSuccess()
    {
        $userServiceMock = $this->getMockBuilder(UserService::class)->disableOriginalConstructor()->getMock();
        $userLoginRequestMock = $this->getMockBuilder(UserLoginRequest::class)->disableOriginalConstructor()->getMock();
        $userLoginResponseMock = $this->getMockBuilder(UserLoginResponse::class)->disableOriginalConstructor()->getMock();
        $userLoginValidatorMock = $this->getMockBuilder(LoginValidator::class)->disableOriginalConstructor()->getMock();
        $sessionServiceMock = $this->getMockBuilder(SessionService::class)->disableOriginalConstructor()->getMock();
        $sessionServiceMock->expects($this->once())->method('destroyUser')->willReturn(true);

        $userLoginController = new UserLoginController($userServiceMock,$userLoginRequestMock,$userLoginResponseMock,$userLoginValidatorMock,$sessionServiceMock);
        $this->assertEquals(View::redirect('/login'),$userLoginController->logout());
    }

    /**
     * @return void
     * @runInSeparateProcess
     */
    public function testLogoutFailed()
    {
        $userServiceMock = $this->getMockBuilder(UserService::class)->disableOriginalConstructor()->getMock();
        $userLoginRequestMock = $this->getMockBuilder(UserLoginRequest::class)->disableOriginalConstructor()->getMock();
        $userLoginResponseMock = $this->getMockBuilder(UserLoginResponse::class)->disableOriginalConstructor()->getMock();
        $userLoginValidatorMock = $this->getMockBuilder(LoginValidator::class)->disableOriginalConstructor()->getMock();
        $sessionServiceMock = $this->getMockBuilder(SessionService::class)->disableOriginalConstructor()->getMock();
        $sessionServiceMock->expects($this->once())->method('destroyUser')->willReturn(false);

        $userLoginController = new UserLoginController($userServiceMock,$userLoginRequestMock,$userLoginResponseMock,$userLoginValidatorMock,$sessionServiceMock);
        $this->assertEquals(View::redirect('/'),$userLoginController->logout());
    }


    /**
     * @param $username
     * @param $password
     * @return UserLoginRequest
     */
    private function getUserLoginRequest($username, $password): UserLoginRequest
    {
        $userLoginRequest = new UserLoginRequest();
        $userLoginRequest->setUsername($username);
        $userLoginRequest->setPassword($password);
        return $userLoginRequest;
    }

    /**
     * @param $id
     * @param $username
     * @param $password
     * @return User
     */
    private function getUser($id,$username,$password): User
    {
        $user = new User();
        $user->setId($id);
        $user->setUsername($username);
        $user->setPassword($password);
        return $user;
    }

    /**
     * @param $user
     * @return UserLoginResponse
     */
    private function getUserLoginResponse($user): UserLoginResponse
    {
        $userLoginResponse = new UserLoginResponse();
        $userLoginResponse->setUser($user);
        return $userLoginResponse;
    }
}