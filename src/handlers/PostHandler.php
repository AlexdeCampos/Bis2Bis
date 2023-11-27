<?php
namespace src\handlers;

use \src\models\Post;
use \src\models\PostLike;
use \src\models\User;

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

    public static function _postListToObject($postList, $loggedUserId) {
        $posts = [];
        foreach($postList as $postItem) {
            $newPost = new Post();
            $newPost->id = $postItem['id'];
            $newPost->title = $postItem['title'];
            $newPost->content = $postItem['content'];
            $newPost->image = $postItem['image'];
            $newPost->created_at = $postItem['created_at'];
            $newPost->mine = false;

            if($postItem['user_id'] == $loggedUserId) {
                $newPost->mine = true;
            }

            $newUser = User::select()->where('id', $postItem['user_id'])->one();
            $newPost->user = new User();
            $newPost->user->id = $newUser['id'];
            $newPost->user->name = $newUser['name'];
            $newPost->user->avatar = $newUser['avatar'];

            $likes = PostLike::select()->where('post_id', $postItem['id'])->get();

            $newPost->likes_count = count($likes);
            $newPost->liked = self::isLiked($postItem['id'], $loggedUserId);

            $posts[] = $newPost;
        }
        
        return $posts;
    }

    public static function isLiked($id, $loggedUserId) {
        $myLike = PostLike::select()
            ->where('post_id', $id)
            ->where('user_id', $loggedUserId)
        ->get();

        if(count($myLike) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function deleteLike($id, $loggedUserId) {
        PostLike::delete()
            ->where('post_id', $id)
            ->where('user_id', $loggedUserId)
        ->execute();
    }

    public static function addLike($id, $loggedUserId) {
        PostLike::insert([
            'post_id' => $id,
            'user_id' => $loggedUserId,
        ])->execute();
    }

    public static function getUserFeed($idUser, $page, $loggedUserId) {
        $perPage = 2;

        $postList = Post::select()
            ->where('user_id', $idUser)
            ->orderBy('created_at', 'desc')
            ->page($page, $perPage)
        ->get();

        $total = Post::select()
            ->where('user_id', $idUser)
        ->count();
        $pageCount = ceil($total / $perPage);

        $posts = self::_postListToObject($postList, $loggedUserId);

        return [
            'posts' => $posts,
            'pageCount' => $pageCount,
            'currentPage' => $page
        ];
    }

    public static function getHomeFeed($idUser, $page) {
        $perPage = 5;

        $postList = Post::select()
            ->orderBy('created_at', 'desc')
            ->page($page, $perPage)
            ->get();

        $total = Post::select()->count();
        $pageCount = ceil($total / $perPage);

        $posts = self::_postListToObject($postList, $idUser);

        return [
            'posts' => $posts,
            'pageCount' => $pageCount,
            'currentPage' => $page
        ];
    }

    public static function delete($id, $loggedUserId) {
        $post = Post::select()
            ->where('id', $id)
            ->where('user_id', $loggedUserId)
            ->get();

        if(count($post) > 0) {
            $post = $post[0];

            PostLike::delete()->where('post_id', $id)->execute();

            if($post['image'] !== '') {
                $img = __DIR__.'/../../public/media/uploads/'.$post['image'];
                if(file_exists($img)) {
                    unlink($img);
                }
            }

            Post::delete()->where('id', $id)->execute();
        }
    }

}