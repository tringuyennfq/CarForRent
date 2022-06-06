<?php

namespace Tringuyen\CarForRent\Repository;

use PDO;
use Tringuyen\CarForRent\Database\DatabaseConnect;

class BaseRepository
{
    private PDO $connection;
    public function __construct()
    {
        $this->connection = DatabaseConnect::getConnection();
    }

    /**
     * @return PDO
     */
    public function getConnection(): PDO
    {
        return $this->connection;
    }

    /**
     * @param PDO $connection
     */
    public function setConnection(PDO $connection): void
    {
        $this->connection = $connection;
    }
}
