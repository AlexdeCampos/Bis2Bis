<?php
namespace src\handlers;

use \src\models\Post;

class PostHandler {

    public static function addPost($idUser, $image, $content) {
        $content = trim($content);
        $image = trim($image);

        if(!empty($idUser) && (!empty($content) || !empty($image))) {

            Post::insert([
                'user_id' => $idUser,
                'title' => '',
                'content' => $content,
                'image' => $image,
                'created_at' => date('Y-m-d H:i:s'),
            ])->execute();

        }
    }


}