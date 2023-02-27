<?php

namespace App\Responses\Auth;

use App\Models\User;
use App\Responses\Response;
use App\Validators\PollValidator;
use App\Validators\Validator;

class RegisterResponse extends Response
{
    public static function validateRegisterAndResponse(array $data)
    {
        $validator = new Validator();
        $validator->validate($data, [
            'email' => 'required|email', //unique:users,email
            'password' => 'required|min:6',
            'password_confirmation' => 'required|confirmation|min:6',
        ]);
        $errors = $validator->getErrors();
        $response = new Response();
        if (!empty($errors)) {
            $response->setBody(json_encode(['errors' => $errors]), 400);
            $response->send();
            die();
        }
        $user = new User();
        if ($user->getByEmail($data['email'])) {
            $response->setBody(json_encode(['errors' => ['email'=>['User with this email is registered']]]), 400);
            $response->send();
            die();
        }
    }
}
