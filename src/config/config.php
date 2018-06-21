<?php
/**
 * This file is part of iWedmak\UrlAuth,
 * urlauth for Laravel.
 *
 * @license MIT
 * @package iWedmak\UrlAuth
 */
return [
    /*
    |--------------------------------------------------------------------------
    | UrlAuth Table
    |--------------------------------------------------------------------------
    |
    | Table to use
    |
    */
    'table' => 'urlauth',
    /*
    |--------------------------------------------------------------------------
    | UrlAuth lifetime
    |--------------------------------------------------------------------------
    |
    | lifetime period in hours for url to work
    |
    */
    'lifetime' => 72,
    /*
    |--------------------------------------------------------------------------
    | UrlAuth User Model
    |--------------------------------------------------------------------------
    |
    | Which laravel model to use as user model, default \App\User
    |
    */
    'user_model' => '\App\User',
    /*
    |--------------------------------------------------------------------------
    | UrlAuth exception
    |--------------------------------------------------------------------------
    | 
    | Which exception to trow if token not found or lifetime is over, default '\Illuminate\Auth\AuthenticationException' so user gets login page
    |
    */
    'exception' => '\Illuminate\Auth\AuthenticationException',
];