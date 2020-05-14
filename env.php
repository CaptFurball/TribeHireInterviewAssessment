<?php
    /**
     * This is only for the sake of assessment. One must not
     * include env files inside git repository
     */

    $variables = [
        'JSONPLACEHOLDER_HOST' => 'https://jsonplaceholder.typicode.com'
    ];

    foreach ($variables as $key => $value) {
        putenv("$key=$value");
    }