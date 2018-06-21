<?php

function urlauth($user_id, $url)
{
    $record=new \iWedmak\UrlAuth\UrlAuth;
    $record->user_id=$user_id;
    $record->url=$url;
    $record->save();
    return route('urlAuth', $record['token']);
}