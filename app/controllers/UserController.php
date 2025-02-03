<?php

namespace app\controllers;

use app\services\AuthService;
use app\models\User;
use Flight;

class UserController
{
    public static function registerForm()
    {
        Flight::render('FormulaireAddClient');
    }

    public static function register()
    {
        $data = Flight::request()->data;
        $password_hash = $data['password_hash'];
        $mail = $data['mail'];
        $nom = $data['nom'];

        // $request = Flight::request();
        // $password_hash = $request->data->password_hash;
        // $mail = $request->data->mail;
        // $nom = $request->data->nom;

        User::create($nom, $mail,$password_hash);
        Flight::redirect('/user/loginForm');
    }

    public static function loginForm()
    {
        Flight::render('FormulaireLoginClient');
    }

    public static function login()
    {
        $request = Flight::request()->data;
        $password_hash = $request['password_hash'];
        $mail = $request['mail'];

        if (AuthService::login($mail,  $password_hash)) {
            Flight::redirect('/home');
        } else {
            Flight::redirect('/user/loginForm');
        }
    }
}

