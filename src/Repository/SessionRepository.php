<?php

namespace Tringuyen\CarForRent\Repository;

use PDO;
use Tringuyen\CarForRent\Database\DatabaseConnect;
use Tringuyen\CarForRent\Model\Session;

class SessionRepository
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
    public function save(Session $session)
    {
        $statement = $this->connection->prepare("INSERT INTO sessions (sess_id, user_ID, sess_lifetime) VALUES(?, ?, ?)");
        $insertSuccess = $statement->execute([
            $session->getSessID(),
            $session->getUserID(),
            $session->getSessLifetime()
        ]);
        if (!$insertSuccess) {
            return false;
        }
        return $session;
    }

    public function deleteById($sessionID): bool
    {
        $statement = $this->connection->prepare("DELETE FROM sessions WHERE sess_id = '$sessionID' ");
        return $statement->execute();
    }

    public function findById($sessionID): Session
    {
        $statement = $this->connection->prepare("SELECT * FROM sessions WHERE sess_id = '$sessionID' ");
        $statement->execute();

        try {
            $session = new Session();
            if ($row = $statement->fetch()) {
                $session->setSessID($row['sess_id']);
                $session->setUserID($row['user_ID']);
                $session->setSessLifetime($row['sess_lifetime']);
            }
            return $session;
        } finally {
            $statement->closeCursor();
        }
    }
}
