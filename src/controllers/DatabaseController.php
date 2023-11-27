<?php
namespace src\controllers;

use \core\Controller;

use \src\handlers\UserHandler;

class DatabaseController extends Controller {
    private $loggedUser;

    public function __construct() {
        $this->loggedUser = UserHandler::checkLogin();
        if($this->loggedUser === false) {
            $this->redirect('/login');
        }
    }

    public function index(){
        $this->render('base', [
            'loggedUser' => $this->loggedUser,
        ]);
    }
}