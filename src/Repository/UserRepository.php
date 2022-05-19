<?php

namespace Tringuyen\CarForRent\Repository;

use Tringuyen\CarForRent\Model\User;

class UserRepository
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }
    public function findByUsername($username)
    {
        $statement = $this->connection->prepare("SELECT * FROM user WHERE user_username = ? ");
        $statement->execute([$username]);

        try {
            $user = new User();
            if ($row = $statement->fetch()) {
                $user->id = $row['user_ID'];
                $user->username = $row['user_username'];
                $user->password = $row['user_password'];

                return $user;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }
}
