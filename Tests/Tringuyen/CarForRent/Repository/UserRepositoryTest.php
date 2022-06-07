<?php

namespace Test\Tringuyen\CarForRent\Repository;


use PHPUnit\Framework\TestCase;
use Tringuyen\CarForRent\Repository\UserRepository;
use Tringuyen\CarForRent\Model\User;

class UserRepositoryTest extends TestCase
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

    /**
     * @param array $params
     * @param $expected
     * @return void
     * @dataProvider findByUsernameDataProvider
     */
    public function testFindByUsername(array $params,mixed $expected)
    {
        $userRepositoryTest = new UserRepository(new User());
        $result = $userRepositoryTest->findByUsername($params['username']);
        $this->assertEquals($expected, $result);
    }

    /**
     * @return array[]
     */
    public function findByUsernameDataProvider()
    {
        return [
            'happy-case-1' => [
                'params' => [
                    'username'=>'khaitri'
                ],
                'expected'=>$this->getUser(1,'khaitri','$2y$10$VyvaTO0FwZISWpb987IAGeFNWxd8vU36NXNZ3MFng07kKTo70dA3a')
            ],
            'unhappy-case-1' => [
                'params' => [
                    'username'=>'wrongusername'
                ],
                'expected'=>null
            ]
        ];
    }

    /**
     * @param array $params
     * @param mixed $expected
     * @return void
     * @dataProvider findByIdDataProvider
     */
    public function testFindById(array $params,mixed $expected)
    {
        $userRepositoryTest = new UserRepository(new User());
        $result = $userRepositoryTest->findById($params['id']);
        $this->assertEquals($expected, $result);
    }
    /**
     * @return array[]
     */
    public function findByIdDataProvider()
    {
        return [
            'happy-case-1' => [
                'params' => [
                    'id'=> 1
                ],
                'expected'=>$this->getUser(1,'khaitri','$2y$10$VyvaTO0FwZISWpb987IAGeFNWxd8vU36NXNZ3MFng07kKTo70dA3a')
            ],
            'unhappy-case-1' => [
                'params' => [
                    'id'=>'wronguserID'
                ],
                'expected'=>null
            ]
        ];
    }
}
