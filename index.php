<?php

require 'vendor/autoload.php';
require './env.php';

spl_autoload_register(function ($className) {
    $file_name = './' . str_replace('\\', '/', strtolower($className)) . '.php';

    if (file_exists($file_name)) {
        require_once($file_name);
    }
});

/**
 * Question 1: Return a list of top posts ordered by the number of comments. 
 * Consume the API endpoints provided.
 * 
 * Note to interviewer: This however is hard to tell if it is working
 * correctly as the comments for each post for this JSON placeholder
 * API is always 5. Will need to mock data to check if it is working.
 * If you have a mock data hosted elsewhere, simply change the host in env.php
 */
Flight::route('GET /api/v1/posts/sort/comments', function () {
    App\Controllers\Post::sortByComments();
});

/**
 * Question 2: Search API - Create an endpoint that allows a user to filter 
 * the comments based on all the available fields. Your solution needs to be scalable.
 */
Flight::route('GET /api/v1/comments', function () {
    App\Controllers\Post::comments();
});

Flight::start();
