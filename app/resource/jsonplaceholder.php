<?php

namespace App\Resource;

use GuzzleHttp\Client;
use App\Helpers\ArrayHelper;

class JsonPlaceholder
{
    private $client;
    private $storedPosts;

    /**
     * Initializesingleton GuzzleClient
     */
    public function __construct ()
    {
        if (empty($this->client)) {
            $this->client = new Client([
                'base_uri' => getenv('JSONPLACEHOLDER_HOST'),
                'timeout'  => 60
            ]);
        }
    }

    /**
     * Calls API to get all posts information
     * 
     * @return array This returns an array of multiple posts information
     */
    public function getPosts ()
    {
        try {
            $resp = $this->client->request('GET', '/posts');
        } catch (\Exception $e) {
            return false;
        }

        return json_decode($resp->getBody(), 1);
    }

    /**
     * Fetch post by post ID
     * This method fetches from a stored post if exists
     * 
     * @var integer ID of the post requested
     * 
     * @return array An array consisting a single post information
     */
    public function getStoredPostByID ($id)
    {
        if (empty($this->storedPosts)) {
            $posts = $this->getPosts();
            $this->storedPosts = ArrayHelper::groupByAttr($posts, 'id');
        }

        return empty($this->storedPosts[$id])? false: reset($this->storedPosts[$id]);
    }

    /**
     * Calls API to get a single post information
     * 
     * @return array An array consisting a single post information
     */
    public function getPostByID ($id)
    {
        try {
            $resp = $this->client->request('GET', "/posts/$id");
        } catch (\Exception $e) {
            return false;
        }

        return json_decode($resp->getBody(), 1);
    }

    /**
     * Calls API to get all comments
     * 
     * @return array This returns an array of multiple comments information
     */
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