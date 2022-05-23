<?php

namespace Tringuyen\CarForRent\Repository;

use PDO;
use Tringuyen\CarForRent\Database\DatabaseConnect;
use Tringuyen\CarForRent\Model\User;

class UserRepository
{
    private PDO $connection;
    private User $user;

    public function __construct(User $user)
    {
        $this->connection = DatabaseConnect::getConnection();
        $this->user = $user;
    }
    public function findByUsername(string $username): ?User
    {
        $statement = $this->connection->prepare("SELECT * FROM user WHERE user_username = ? ");
        $statement->execute([$username]);

        try {
            if ($row = $statement->fetch()) {
                $this->user->setId($row['user_ID']);
                $this->user->setUsername($row['user_username']);
                $this->user->setPassword($row['user_password']);

                return $this->user;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }
}
