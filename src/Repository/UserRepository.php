<?php

namespace Tringuyen\CarForRent\Repository;

use Exception;
use Tringuyen\CarForRent\Model\User;
use Tringuyen\CarForRent\Transfer\UserRegisterRequest;

class UserRepository extends BaseRepository
{
    /**
     * @var User
     */
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
        parent::__construct();
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
                $user = new User();
                $user->setId($row['user_ID']);
                $user->setUsername($row['user_username']);
                $user->setPassword($row['user_password']);

                return $user;
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
                $user = new User();
                $user->setId($row['user_ID']);
                $user->setUsername($row['user_username']);
                $user->setPassword($row['user_password']);
                return $user;
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
    public function insertUser(UserRegisterRequest $userRegisterRequest): bool
    {
        $statement = $this->getConnection()->prepare("INSERT INTO user (user_username, user_password) VALUES(?, ?)");
        try {
            $statement->execute([
                $userRegisterRequest->getUsername(),
                $userRegisterRequest->getHashPassword()
            ]);
        } catch (Exception $exception) {
            return false;
        }
        return true;
    }
}
