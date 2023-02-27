<?php

namespace App\Controllers\Polls;

use App\Controllers\Controller;
use App\Models\Poll;
use App\Requests\Request;
use App\Responses\Response;
use App\Sessions\Session;

abstract class PollDefaultController extends Controller
{
    protected $poll;
    protected $request;
    protected $response;
    protected $user_id;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->poll = new Poll();
        $this->user_id = Session::get('user_id');
    }

    public function getPoll($id)
    {
        $poll = $this->poll->find($id);
        if (empty($poll)) {
            return $this->response->setBody(json_encode(['errors' => ['Not found']]), 400);
        }
        if ($this->user_id !== $poll['user_id']) {
            return $this->response->setBody(json_encode(['errors' => ['Access denied']]), 400);
        }
        return $this->response->setBody(json_encode($poll));
    }
}
