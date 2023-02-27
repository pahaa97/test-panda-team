<?php

namespace App\Controllers\Polls;

use App\Models\Poll;
use App\Models\User;
use App\Responses\Poll\CreateResponse;
use App\Responses\Poll\UpdateResponse;

class PollController extends PollDefaultController
{
    public function create()
    {
        CreateResponse::validatePollAndResponse($this->request->only(['title','status']));
        $text = $this->request->input('text[]');
        $votes = $this->request->input('votes[]');
        if (empty($text) || empty($votes)) {
            $this->response->setBody(json_encode(['errors' => ['options'=>'Options not found']]), 400);
            return $this->response->send();
        }
        for ($i = 0; $i < count($text); $i++) {
            $fieldError = CreateResponse::validateOptionAndGetErrors([$text[$i], $votes[$i]]);
            if ($fieldError) {
                $errors[$i] = $fieldError;
            }
        }
        if (!empty($errors)) {
            $this->response->setBody(json_encode(['errors' => ['options'=>$errors]]), 400);
            return $this->response->send();
        }
        $poll = new Poll();
        $data = $this->request->all();
        $data['user_id'] = (new User())->isAuthenticated();
        $poll_id = $poll->createOrUpdate($data);
        $this->response->setBody(json_encode(['poll_id' => $poll_id]));
        return $this->response->send();
    }

    public function update($id)
    {
        $response = $this->getPoll($id);
        if ($response->getStatus() !== 200) {
            return $response->send();
        }
        $data = $this->request->all();
        $data['id'] = $id;
        UpdateResponse::validatePollAndResponse($data);
        $text = $this->request->input('text[]');
        $votes = $this->request->input('votes[]');
        if (empty($text) || empty($votes)) {
            $this->response->setBody(json_encode(['errors' => ['options'=>'Options not found']]), 400);
            return $this->response->send();
        }
        for ($i = 0; $i < count($text); $i++) {
            $fieldError = UpdateResponse::validateOptionAndGetErrors([$text[$i], $votes[$i]]);
            if ($fieldError) {
                $errors[$i] = $fieldError;
            }
        }
        if (!empty($errors)) {
            $this->response->setBody(json_encode(['errors' => ['options'=>$errors]]), 400);
            return $this->response->send();
        }
        $poll = new Poll();
        $data['user_id'] = (new User())->isAuthenticated();
        $poll_id = $poll->createOrUpdate($data);
        $this->response->setBody(json_encode(['poll_id' => $poll_id]));
        return $this->response->send();
    }

    public function delete($id)
    {
        $response = $this->getPoll($id);
        if ($response->getStatus() !== 200) {
            return $response->send();
        }
        $this->poll->delete($id);
        return $response->send();
    }

    public function allByUser()
    {
        $userPolls = json_encode($this->poll->userPolls($this->user_id));
        $this->response->setBody($userPolls);
        return $this->response->send();
    }
}
