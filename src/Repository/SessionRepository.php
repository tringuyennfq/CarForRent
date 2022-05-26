<?php

namespace Tringuyen\CarForRent\Repository;

use Exception;
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

    /**
     * @param Session $session
     * @return bool|Session
     */
    public function save(Session $session): bool | Session
    {
        try {
            $statement = $this->connection->prepare("INSERT INTO sessions (sess_id, user_ID, sess_lifetime) VALUES(?, ?, ?)");
            $insertSuccess = $statement->execute([
                $session->getSessID(),
                $session->getUserID(),
                $session->getSessLifetime()
            ]);
            return $session;
        } catch (Exception) {
            return false;
        }
    }

    /**
     * @param $sessionID
     * @return bool
     */
    public function deleteById($sessionID): bool
    {
        $statement = $this->connection->prepare("DELETE FROM sessions WHERE sess_id = '$sessionID' ");
        return $statement->execute();
    }

    /**
     * @param $sessionID
     * @return Session
     */
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
