<?php

namespace Tringuyen\CarForRent\Model;

class Session
{
    public $id;
    public $userid;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUserid()
    {
        return $this->userid;
    }

}