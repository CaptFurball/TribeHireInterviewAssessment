<?php

namespace App\Controllers;

use App\Resource\JsonPlaceholder;
use App\Helpers\ArrayHelper;
use \Flight;

class Post 
{
    public static function sortByComments ()
    {
        $resource = new JsonPlaceholder();

        $comments = $resource->getComments();
        $commentsByPostID = ArrayHelper::groupByAttr($comments, 'postId');

        $posts = [];
        foreach ($commentsByPostID as $postID => $postComments) {
            $post = $resource->getPostByID($postID);

            array_push($posts, [
                'post_id' => $post['id'],
                'post_title' => $post['title'],
                'post_body' => $post['body'],
                'total_number_of_comments' => count($postComments)
            ]);
        }

        Flight::json(
            [
                'msg' => ArrayHelper::sortDescByAttr($posts, 'total_number_of_comments')
            ]
        );
    }

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
        $comments = $resource->getComments();
        
        $filteredComments = ArrayHelper::strictSearch($comments, $filters);

        Flight::json(
            [
                'msg' => $filteredComments
            ]
        );
    }
}