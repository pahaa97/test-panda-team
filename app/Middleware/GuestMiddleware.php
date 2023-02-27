<?php

namespace App\Middleware;

use App\Models\User;

class GuestMiddleware
{
    public function handle()
    {
        $user = new User();
        if ($user->isAuthenticated()) {
            header('Location: /dashboard');
            exit;
        }
    }
}
