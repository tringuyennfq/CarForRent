<?php

namespace Tringuyen\CarForRent\Repository;

use Exception;
use PDO;
use Tringuyen\CarForRent\Database\DatabaseConnect;
use Tringuyen\CarForRent\Model\User;

class UserRepository extends BaseRepository
{
    /**
     * @var User
     */
    private User $user;

    public function __construct(User $user,PDO $connection = null)
    {
        $this->user = $user;
        parent::__construct($connection);
    }

    /**
     * @param $username
     * @return User|null
     */
    public function findByUsername($username): ?User
    {
        $statement = $this->getConnection()->prepare("SELECT * FROM user WHERE user_username = ? ");
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

    /**
     * @param $id
     * @return User|null
     */
    public function findById($id): ?User
    {
        $statement = $this->getConnection()->prepare("SELECT * FROM user WHERE user_ID = ? ");
        $statement->execute([$id]);

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

    /**
     * @param User $user
     * @return bool
     */
    public function insertUser(User $user): bool
    {
        $statement = $this->getConnection()->prepare("INSERT INTO user (user_username, user_password) VALUES(?, ?)");
        try {
            $statement->execute([
                $user->getUsername(),
                password_hash($user->getPassword(), PASSWORD_BCRYPT)
            ]);
        } catch (Exception $exception) {
            return false;
        }
        return true;
    }
}
