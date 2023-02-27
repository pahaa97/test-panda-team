<?php

namespace App\Controllers\Api\Polls;

use App\Models\ApiKey;
use App\Models\Option;
use App\Models\Poll;
use App\Responses\Response;

class PollController
{
    public function __construct()
    {
        $this->api_key = new ApiKey();
        $this->response = new Response();
        $this->poll = new Poll();
        $this->options = new Option();
    }

    public function getRandomPoll($apikey)
    {
        $api_key = $this->api_key->whereKey($apikey);

        if (!$api_key) {
            $this->response->setBody(json_encode(['errors' => 'Invalid API key']), 400);
            return $this->response->send();
        }
        $polls = $this->poll->userPolls($api_key['user_id'], 'published');
        if (empty($polls)) {
            $this->response->setBody(json_encode(['errors' => 'No polls available']), 400);
            return $this->response->send();
        }

        $randomIndex = rand(0, count($polls) - 1);
        $selectedPoll = $polls[$randomIndex];
        unset($selectedPoll['user_id']);
        unset($selectedPoll['status']);
        unset($selectedPoll['created_at']);

        $options = $this->options->getAll('poll_id = ?', [$selectedPoll['id']]) ?? null;
        unset($selectedPoll["id"]);
        foreach ($options as $option) {
            unset($option['id']);
            unset($option['poll_id']);
            $selectedPoll['options'][] = $option;
        }

        $this->response->setBody(json_encode($selectedPoll), 200);
        return $this->response->send();
    }
}
