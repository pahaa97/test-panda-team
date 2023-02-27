<?php

namespace App\Middleware;

use App\Models\User;

class AuthMiddleware
{
    public function handle()
    {
        $user = new User();
        if (!$user->isAuthenticated()) {
            header('Location: /login');
            exit;
        }
    }
}
