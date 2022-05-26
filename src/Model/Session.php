<?php

namespace Tringuyen\CarForRent\Model;

class Session
{
    protected  $sessID;
    protected  $userID;
    protected $sessLifetime;


    public function getSessID()
    {
        return $this->sessID;
    }


    public function setSessID($sessID)
    {
        $this->sessID = $sessID;
    }

    public function getUserID()
    {
        return $this->userID;
    }


    public function setUserID($userID)
    {
        $this->userID = $userID;
    }


    public function getSessLifetime()
    {
        return $this->sessLifetime;
    }


    public function setSessLifetime($sessLifetime)
    {
        $this->sessLifetime = $sessLifetime;
    }
}
