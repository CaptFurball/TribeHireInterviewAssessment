<?php
    /**
     * This is commited for the sake of assessment. One must not
     * include env files inside git repository
     */

    $variables = [
        // The host of the API for obtaining post and comments 
        'JSONPLACEHOLDER_HOST' => 'https://jsonplaceholder.typicode.com'
    ];

    foreach ($variables as $key => $value) {
        putenv("$key=$value");
    }