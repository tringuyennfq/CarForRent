<?php

namespace Test\Tringuyen\CarForRent\Repository;

use PHPUnit\Framework\TestCase;
use Tringuyen\CarForRent\Database\DatabaseConnect;
use Tringuyen\CarForRent\Repository\BaseRepository;

class BaseRepositoryTest extends TestCase
{
    public function testGetSet()
    {
        $testBaseRepository = new BaseRepository();
        $testBaseRepository->setConnection(DatabaseConnect::getConnection());
        $result = $testBaseRepository->getConnection();
        $expected = DatabaseConnect::getConnection();
        $this->assertEquals($expected,$result);
    }

}