<?php

namespace App\Resource;

use GuzzleHttp\Client;
use App\Helpers\ArrayHelper;

class JsonPlaceholder
{
    private $client;
    private $posts;

    public function __construct ()
    {
        if (empty($this->client)) {
            $this->client = new Client([
                'base_uri' => getenv('JSONPLACEHOLDER_HOST'),
                'timeout'  => 60
            ]);
        }
    }

    public function getPosts ()
    {
        try {
            $resp = $this->client->request('GET', '/posts');
        } catch (\Exception $e) {
            return false;
        }

        return json_decode($resp->getBody(), 1);
    }

    public function getPostByID ($id)
    {
        if (empty($this->posts)) {
            $posts = $this->getPosts();
            $this->posts = ArrayHelper::groupByAttr($posts, 'id');
        }

        return empty($this->posts[$id])? false: reset($this->posts[$id]);
    }

    public function getComments ()
    {
        try {
            $resp = $this->client->request('GET', '/comments');
        } catch (\Exception $e) {
            return false;
        }

        return json_decode($resp->getBody(), 1);
    }
}