<?php
namespace src\controllers;

use \core\Controller;
use \src\handlers\UserHandler;

class LoginController extends Controller {

    public function signin() {
        $flash = '';
        if(!empty($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }
        $this->render('signin', [
            'flash' => $flash
        ]);
    }

    public function signinAction() {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');

        if($email && $password) {
            $token = UserHandler::verifyLogin($email, $password);
            if($token) {
                $_SESSION['token'] = $token;
                $this->redirect('/');
            } else {
                $_SESSION['flash'] = 'E-mail e/ou senha não conferem.';
                $this->redirect('/login');
            }
        } else {
            $this->redirect('/login');
        }
    }

    public function signup() {
        $flash = '';
        if(!empty($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }
        $this->render('signup', [
            'flash' => $flash
        ]);
    }

    public function signupAction() {
        $name = filter_input(INPUT_POST, 'name');
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');

        if($name && $email && $password) {
            if(UserHandler::emailExists($email) === false) {
                $token = UserHandler::addUser($name, $email, $password);
                $_SESSION['token'] = $token;
                $this->redirect('/');
            } else {
                $_SESSION['flash'] = 'E-mail já cadastrado!';
                $this->redirect('/cadastro');
            }

        } else {
            $this->redirect('/cadastro');
        }
    }

    public function logout() {
        $_SESSION['token'] = '';
        $this->redirect('/login');
    }

    public function newAdmin(){
        $loggedUser = UserHandler::checkLogin();
        if($loggedUser === false) {
            $this->redirect('/home');
        }

        $flash = '';
        if(!empty($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }

        if($loggedUser === false) {
            $this->redirect('/home');
        }
        $page = intval(filter_input(INPUT_GET, 'page'));

        $users = UserHandler::listAdmin($page, $loggedUser);
        $this->render('signupAdmin', [
            'flash' => $flash,
            'loggedUser' => $loggedUser,
            'userList' => $users
        ]);
    }

    public function newAdminAction(){
        $loggedUser = UserHandler::checkLogin();
        if($loggedUser === false) {
            $this->redirect('/login');
        }

        $name = filter_input(INPUT_POST, 'name');
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');

        if($name && $email && $password) {
            if(UserHandler::emailExists($email) === false) {
                UserHandler::addUser($name, $email, $password, 'admin');
            } else {
                $_SESSION['flash'] = 'E-mail já cadastrado!';
            }
        } else {
            
        }
        $this->redirect('/cadastro/admin');
    }

}