<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Routes configuration
    |--------------------------------------------------------------------------
    |
    | List of all (default) routes
    |
    */

    '/posts' => '/posts',
    '/posts/create' => '/posts/create',
    // '/posts/{post}' => 'posts/{post}',
    '/posts/{post}/{slug}' => '/posts/{post}/{slug}',
    '/posts/{post}/edit' => '/posts/{post}/edit',
    '/posts/{post}/favorite' => '/posts/{post}/favorite',
    '/posts/{post}/publish' => '/posts/{post}/publish',
    '/posts/{post}/unpublish' => '/posts/{post}/unpublish',
    '/posts/apply/{post}' => '/posts/apply/{post}',
    '/posts/propose/{user}' => '/posts/propose/{user}',
    // '...' => '...',
    // Temp :
    '/test' => '/test',
    '/test/{post}/{slug}' => '/test/{post}/morecomplex/{slug}',

];
