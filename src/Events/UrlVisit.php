<?php namespace iWedmak\UrlAuth\Events;

class UrlVisit
{
    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }
    
}
