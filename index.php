<?php

require 'vendor/autoload.php';
require './env.php';

spl_autoload_register(function ($className) {
    $file_name = './' . str_replace('\\', '/', strtolower($className)) . '.php';

    if (file_exists($file_name)) {
        require_once($file_name);
    }
});

Flight::route('GET /api/v1/posts/sort/comments', function () {
    App\Controllers\Post::sortByComments();
});

Flight::route('GET /api/v1/comments', function () {
    App\Controllers\Post::comments();
});

Flight::start();
