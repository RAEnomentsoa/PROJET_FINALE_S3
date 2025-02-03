<?php

namespace app\models;

use Flight;

class User
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public static function findByUsername($username)
    {
        $stmt = Flight::db()->prepare("SELECT * FROM users WHERE nom = ?");
        $stmt->execute([$username]);
        return $stmt->fetch();
    }

    public static function findByMail($mail)
    {
        $stmt = Flight::db()->prepare("SELECT * FROM users WHERE mail = ?");
        $stmt->execute([$mail]);
        return $stmt->fetch();
    }

    public static function findRoleById($id)
    {
        $stmt = Flight::db()->prepare("SELECT user_role FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public static function findById($id)
    {
        $stmt =  Flight::db()->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public static function create($nom, $mail, $password_hash)
    {
        $stmt = Flight::db()->prepare("INSERT INTO users (nom, mail,  password_hash, user_role) VALUES (?, ?, ?, 'client')");
        return $stmt->execute([
            $nom,
            $mail,
            $password_hash
        ]);
    }
}
