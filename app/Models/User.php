<?php

namespace App\Models;

use App\Sessions\Session;
use PDO;

class User extends Model
{
    protected $table = 'users';

    public function getByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM $this->table WHERE email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function authenticate($email, $password)
    {
        $query = 'SELECT * FROM users WHERE email = :email AND password = :password';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $session = new Session();
            $session->start();
            $session->set('user_id', $user['id']);
            return true;
        }
        return false;
    }

    public function isAuthenticated()
    {
        $session = new Session();
        $session->start();
        return $session->get('user_id') ?? false;
    }

    public function logout()
    {
        $session = new Session();
        $session->start();
        $session->remove('user_id');
        $session->destroy();
    }

    public function getEmail()
    {

    }
}
