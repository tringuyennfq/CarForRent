<?php

namespace Tringuyen\CarForRent\Model;

class Session
{
    protected $sessID;
    protected $userID;
    protected $sessLifetime;

    /**
     * @return mixed
     */
    public function getSessID()
    {
        return $this->sessID;
    }

    /**
     * @param mixed $sessID
     */
    public function setSessID($sessID): void
    {
        $this->sessID = $sessID;
    }

    /**
     * @return mixed
     */
    public function getUserID()
    {
        return $this->userID;
    }

    /**
     * @param mixed $userID
     */
    public function setUserID($userID): void
    {
        $this->userID = $userID;
    }

    /**
     * @return mixed
     */
    public function getSessLifetime()
    {
        return $this->sessLifetime;
    }

    /**
     * @param mixed $sessLifetime
     */
    public function setSessLifetime($sessLifetime): void
    {
        $this->sessLifetime = $sessLifetime;
    }

}
