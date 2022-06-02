<?php

namespace Tringuyen\CarForRent\Tranformer;

use Tringuyen\CarForRent\Model\User;

class UserTranformer
{
    /**
     * @param User $user
     * @return array
     */
    public function UserToArray(User $user): array
    {
        return [
            'id' => $user->getId(),
            'username' => $user->getUsername()
        ];
    }
}
