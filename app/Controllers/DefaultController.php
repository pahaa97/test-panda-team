<?php

namespace App\Controllers;

use App\Models\ApiKey;
use App\Models\Poll;
use App\Models\User;
use App\Responses\Response;

class DefaultController extends Controller
{
    public function __construct()
    {
        $this->response = new Response();
        $this->poll = new Poll();
        $this->user = new User();
        $this->api_key = new ApiKey();
    }

    public function index()
    {
        $user = $this->user->find($this->user->isAuthenticated());
        $api_key = $this->api_key->whereUserId(intval($user['id']))['key_value'] ?? null;
        $this->renderView('dashboard',[
            'user_email' => $user['email'],
            'api_key' => $api_key
        ]);
    }

    public function home()
    {
        $this->renderView('home');
    }

    public function documentation()
    {
        $this->renderView('documentation');
    }
}
