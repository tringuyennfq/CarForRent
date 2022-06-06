<?php

namespace Test\Tringuyen\CarForRent\Repository;

use PHPUnit\Framework\TestCase;
use Tringuyen\CarForRent\Database\DatabaseConnect;
use Tringuyen\CarForRent\Model\Session;
use Tringuyen\CarForRent\Repository\SessionRepository;

class SessionRepositoryTest extends TestCase
{
    /**
     * @return void
     */
    public function testGetConnection()
    {
        $testSessionRepository = new SessionRepository();
        $testSessionRepository->setConnection(DatabaseConnect::getConnection());
        $actual = $testSessionRepository->getConnection();
        $this->assertEquals(DatabaseConnect::getConnection(),$actual);
    }

    /**
     * @return void
     */
    public function testFindByIdSuccess(): void
    {
        $session = new Session();
        $sessionRepository = new SessionRepository();
        $session->setSessID(uniqid());
        $session->setUserID(1);
        $session->setSessLifetime(time() + (60 * 60 * 24));
        $sessionRepository->save($session);

        $result = $sessionRepository->findById($session->getSessID());
        $this->assertEquals($session->getSessID(), $result->getSessID());
        $this->assertEquals($session->getUserID(), $result->getUserID());

        $sessionRepository->deleteById($session->getSessID());
        $result = $sessionRepository->findById($session->getSessID());
        $this->assertNull($result->getSessID());
    }

    /**
     * @return void
     */
    public function testFindByIdFailed()
    {
        $sessionRepository = new SessionRepository();
        $result = $sessionRepository->findById('wrongIdExample');
        self::assertNull($result->getSessID());
    }

    /**
     * @return void
     */
    public function testSaveFailed()
    {
        $session = new Session();
        $session->setUserID(0);
        $session->setSessID('');
        $sessionRepository = new SessionRepository();
        $actual = $sessionRepository->save($session);
        $this->assertEquals(false,$actual);
    }
}