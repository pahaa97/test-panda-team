<?php

namespace App\Controllers\Auth;

use App\Controllers\Controller;
use App\Models\User;
use App\Requests\Request;
use App\Responses\Response;
use App\Validators\Validator;

class AuthController extends Controller
{
    private $user;
    private $request;
    private $response;
    private $validator;

    public function __construct()
    {
        $this->user = new User();
        $this->request = new Request();
        $this->response = new Response();
        $this->validator = new Validator();
    }

    public function index()
    {
        $this->renderView('login');
    }

    public function login()
    {
        $this->validator->validate($this->request->all(), [
            'email' => 'required|email', //unique:users,email
            'password' => 'required|min:6',
        ]);
        $errors = $this->validator->getErrors();
        if (!empty($errors)) {
            $this->response->setBody(json_encode(['errors' => $errors]), 400);
            return $this->response->send();
        }
        $result = $this->user->authenticate($this->request->input('email'),hash('md5',$this->request->input('password')));
        if (!$result) {
            $this->response->setBody(json_encode(['errors' => ['email'=>['Incorrect email or password']]]), 400);
            return $this->response->send();
        }
        $this->response->setBody('Success');
        return $this->response->send();
    }

    public function logout()
    {
        $this->user->logout();
        header('Location: /login');
    }
}
