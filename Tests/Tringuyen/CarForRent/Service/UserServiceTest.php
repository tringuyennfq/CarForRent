<?php

namespace Test\Tringuyen\CarForRent\Service;

use JetBrains\PhpStorm\ArrayShape;
use PHPUnit\Framework\TestCase;
use Tringuyen\CarForRent\Exception\LoginException;
use Tringuyen\CarForRent\Model\User;
use Tringuyen\CarForRent\Model\UserLoginRequest;
use Tringuyen\CarForRent\Model\UserLoginResponse;
use Tringuyen\CarForRent\Repository\UserRepository;
use Tringuyen\CarForRent\Service\UserService;

class UserServiceTest extends TestCase
{
    /**
     * @param int $id
     * @param string $username
     * @param string $password
     * @return User
     */
    private function getUser(int $id, string $username, string $password)
    {
        $user = new User();
        $user->setId($id);
        $user->setUsername($username);
        $user->setPassword($password);
        return $user;
    }

    private function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    /**
     * @return void
     * @test
     */
    public function testGetUserRepository(): void
    {
        $userServiceTest = new UserService(new UserRepository(new User()));
        $userRepositoryTest = new UserRepository(new User());
        $userServiceTest->setUserRepository($userRepositoryTest);
        $result = $userServiceTest->getUserRepository();
        $this->assertEquals($userRepositoryTest,$result);
    }

    /**
     * @param array $params
     * @param UserLoginResponse $expected
     * @return void
     * @test
     * @dataProvider loginSuccessfulDataProvider
     */
    public function testLoginSuccessful(array $params,bool $expected): void
    {
        $userRepositoryMock = $this->getMockBuilder(UserRepository::class)->disableOriginalConstructor()->getMock();
        $userRepositoryMock->expects($this->once())->method("findByUsername")->willReturn($params['user']);
        $userServiceTest = new UserService($userRepositoryMock);

        $userLoginRequestTest = new UserLoginRequest();
        $userLoginRequestTest->fromArray($params);

        $result = $userServiceTest->login($userLoginRequestTest);
        $this->assertEquals($expected,$result);
    }

    /**
     * @return array[]
     */
    #[ArrayShape(['happy-case-1' => "array"])] public function loginSuccessfulDataProvider()
    {
        return [
            'happy-case-1' => [
                'params' => [
                    'user'=> $this->getUser(1,'khaitri','$2y$10$0BxlcWJVCq0Nrlfh.IFcF.tvgMSrIzSPcPQmcr8Qr7dpbVzqng6ny'),
                    'username'=>'khaitri',
                    'password'=>'123456'
                ],
                'expected' =>  true
            ]
        ];
    }

    /**
     * @param array $params
     * @return void
     * @throws LoginException
     * @test
     * @dataProvider loginFailedDataProvider
     */
    public function testLoginFailed(array $params, bool $expected): void
    {
        $userRepositoryMock = $this->getMockBuilder(UserRepository::class)->disableOriginalConstructor()->getMock();
        $userRepositoryMock->expects($this->once())->method("findByUsername")->willReturn(null);
        $userServiceTest = new UserService($userRepositoryMock);

        $userLoginRequestTest = new UserLoginRequest();
        $userLoginRequestTest->fromArray($params);

        $result = $userServiceTest->login($userLoginRequestTest);
        $this->assertEquals($expected,$result);
    }

    public function loginFailedDataProvider()
    {
        return [
            'unhappy-case-1' => [
                'params' => [
                    'username'=>'khaitri',
                    'password'=>'123456'
                ],
                'expected'=>false
            ]
        ];
    }
}