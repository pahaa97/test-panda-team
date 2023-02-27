<?php

namespace App\Controllers\Auth;

use App\Controllers\Controller;
use App\Models\ApiKey;
use App\Models\User;
use App\Requests\Request;
use App\Responses\Auth\RegisterResponse;
use App\Responses\Response;

class RegistrationController extends Controller
{
    private $user;
    private $request;
    private $response;
    private $api_key;

    public function __construct()
    {
        $this->user = new User();
        $this->request = new Request();
        $this->response = new Response();
        $this->api_key = new ApiKey();
    }

    public function index()
    {
        $this->renderView('registration');
    }

    public function processRegistration()
    {
        RegisterResponse::validateRegisterAndResponse($this->request->all());
        $user_id = $this->user->create([
            'email' => $this->request->input('email'),
            'password' => hash('md5',$this->request->input('password')),
        ]);
        $this->api_key->create([
            'key_value' => hash('sha256', uniqid()),
            'user_id' => $user_id
        ]);
        $this->response->setBody(json_encode(['success' => 'You have successfully registered. You can log in. You will be redirected in 3 seconds']));
        return $this->response->send();
    }
}

