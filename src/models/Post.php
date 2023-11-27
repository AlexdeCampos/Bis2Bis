<?php
namespace src\models;
use \core\Model;

class Post extends Model {
    public $id;
    public $title;
    public $content;
    public $image;
    public $user_id;
    public $created_at;
    public $deleted_at;
    public $likes_count;
}