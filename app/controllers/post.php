<?php

namespace App\Controllers;

use App\Resource\JsonPlaceholder;
use App\Helpers\ArrayHelper;
use \Flight;

class Post 
{
    /**
     * Retrieves posts sorted from the most comments to the least
     */
    public static function sortByComments ()
    {
        $resource = new JsonPlaceholder();

        $commentsByPostID = ArrayHelper::groupByAttr(
            $resource->getComments(), 
            'postId');

        $output = [];
        foreach ($commentsByPostID as $postID => $postComments) {
            $post = $resource->getStoredPostByID($postID);

            array_push($output, [
                'post_id' => $post['id'],
                'post_title' => $post['title'],
                'post_body' => $post['body'],
                'total_number_of_comments' => count($postComments)
            ]);
        }

        Flight::json(
            [
                'msg' => ArrayHelper::sortDescByAttr($output, 'total_number_of_comments')
            ]
        );
    }

    /**
     * Retrieves comments for post with filter in query string
     */
    public static function comments ()
    {
        $filters = [
            'postId'    => Flight::request()->query->post_id,
            'id'        => Flight::request()->query->comment_id,
            'name'      => Flight::request()->query->name,
            'email'     => Flight::request()->query->email,
            'body'      => Flight::request()->query->body,
        ];

        $resource = new JsonPlaceholder();
        
        $output = ArrayHelper::strictSearch(
            $resource->getComments(), 
            $filters);

        Flight::json(
            [
                'msg' => $output
            ]
        );
    }
}