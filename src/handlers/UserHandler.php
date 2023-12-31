<?php
namespace src\handlers;

use \src\models\User;

class UserHandler {

    public static function checkLogin() {
        if(!empty($_SESSION['token'])) {
            $token = $_SESSION['token'];

            $data = User::select()->where('token', $token)->one();
            if(count($data) > 0) {

                $loggedUser = new User();
                $loggedUser->id = $data['id'];
                $loggedUser->name = $data['name'];
                $loggedUser->avatar = $data['avatar'];
                $loggedUser->type = $data['type'];

                return $loggedUser;
            }
        }

        return false;
    }

    public static function verifyLogin($email, $password) {
        $user = User::select()->where('email', $email)->one();

        if($user) {
            if(password_verify($password, $user['password'])) {
                $token = md5(time().rand(0,9999).time());

                User::update()
                    ->set('token', $token)
                    ->where('email', $email)
                ->execute();

                return $token;
            }
        }

        return false;
    }

    public function idExists($id) {
        $user = User::select()->where('id', $id)->one();
        return $user ? true : false;
    }

    public static function emailExists($email) {
        $user = User::select()->where('email', $email)->one();
        return $user ? true : false;
    }

    public static function getUser($id) {
        $data = User::select()->where('id', $id)->one();

        if($data) {
            $user = new User();
            $user->id = $data['id'];
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->avatar = $data['avatar'];
            $user->type = $data['type'];

            return $user;
        }

        return false;
    }

    public static function addUser($name, $email, $password, $type = 'viewer') {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $token = md5(time().rand(0,9999).time());

        User::insert([
            'email' => $email,
            'password' => $hash,
            'name' => $name,
            'token' => $token,
            'type' => $type,
        ])->execute();

        return $token;
    }

    public static function updateUser(array $fields, string $idUser) {
        if(count($fields) > 0) {

            $update = User::update();

            foreach($fields as $fieldName => $fieldValue) {
                if($fieldName == 'password') {
                    $fieldValue = password_hash($fieldValue, PASSWORD_DEFAULT);
                }

                $update->set($fieldName, $fieldValue);
            }

            $update->where('id', $idUser)->execute();
        }
    }

    public static function _userListToObject($userList) {
        $users = [];
        foreach($userList as $user) {
            $newUser = new User();
            $newUser->id = $user['id'];
            $newUser->name = $user['name'];
            $newUser->email = $user['email'];
            $newUser->avatar = $user['avatar'];

            $users[] = $newUser;
        }
        
        return $users;
    }

    public static function listAdmin(int $page, User $loggedUser){
        $perPage = 5;

        $userList = User::select()
            ->where('id', '!=',$loggedUser->id)
            ->andWhere('type', 'admin')
            ->page($page, $perPage)
            ->get();

        $total = User::select()
            ->where('id', '!=' ,$loggedUser->id)
            ->andWhere('type', 'admin')
            ->count();
        $pageCount = ceil($total / $perPage);

        $users = self::_userListToObject($userList);
        return [
            'users' => $users,
            'pageCount' => $pageCount,
            'currentPage' => $page
        ];
    }

}