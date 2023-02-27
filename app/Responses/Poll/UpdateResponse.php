<?php

namespace App\Responses\Poll;

use App\Responses\Response;
use App\Validators\PollValidator;

class UpdateResponse extends Response implements IPollResponse
{
    public static function validatePollAndResponse(array $data)
    {
        $validator = new PollValidator();
        $validator->validate($data, [
            'title' => 'required|min:3|unique:'.$data['id'],
            'status' => 'required',
        ]);
        $errors = $validator->getErrors();
        if (!empty($errors)) {
            $validator->clearErrors();
            $response = new Response();
            $response->setBody(json_encode(['errors' => $errors]), 400);
            $response->send();
            die();
        }
        return true;
    }

    public static function validateOptionAndGetErrors(array $data)
    {
        $validator = new PollValidator();
        $validator->validate($data, [
            'text' => 'required|min:3',
            'votes' => 'required|integer|morezero',
        ]);
        $errors = $validator->getErrors();
        $validator->clearErrors();
        return $errors;
    }
}
