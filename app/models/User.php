<?php

namespace app\models;


class User extends AppModel
{
    public $attributes = [
        'name' => '',
        'username' => '',
        'email' => '',
        'password' => '',
        'block' => '',
    ];

    public $rules = [
        'required' => [
            ['name'],
            ['username'],
            ['email'],
            ['password'],
        ],
        'email' => [
            ['email'],
        ],
        'lengthMin' => [
            ['password', 6],
        ]
    ];

    public function checkUnique(){
        $user = \R::findOne('mlr_users', 'username = ? OR email = ?', [$this->attributes['username'], $this->attributes['email']]);
        if($user){
            if($user->username == $this->attributes['username']){
                $this->errors['unique'][] = 'Этот логин уже занят';
            }
            if($user->email == $this->attributes['email']){
                $this->errors['unique'][] = 'Этот email уже занят';
            }
            return false;
        }
        return true;
    }

    public function login($isAdmin = false){
        $username = !empty(trim($_POST['username'])) ? trim($_POST['username']) : null;
        $password = !empty(trim($_POST['password'])) ? trim($_POST['password']) : null;
        if($username && $password){
            if($isAdmin){
                $user = \R::findOne('mlr_users', "username = ? AND role = 'admin'", [$username]);
            }else{
                $user = \R::findOne('mlr_users', "username = ?", [$username]);
            }
            if($user){
                if(password_verify($password, $user->password)){
                    foreach($user as $k => $v){
                        if($k != 'password') $_SESSION['user'][$k] = $v;
                    }
                    return true;
                }
            }
        }
        return false;
    }
}