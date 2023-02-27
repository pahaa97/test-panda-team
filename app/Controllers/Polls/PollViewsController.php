<?php

namespace App\Controllers\Polls;

use App\Models\Option;

class PollViewsController extends PollDefaultController
{
    public function indexView()
    {
        return $this->renderView('polls');
    }

    public function createView()
    {
        $data = [
            'type' => 'create',
            'title' => 'Создание опроса',
            'data' => null
        ];
        return $this->renderView('poll', $data);
    }

    public function editView($id)
    {
        $response = $this->getPoll($id);
        if ($response->getStatus() === 200) {
            $options = new Option();
            $options = $options->getAll('poll_id = ?', [$id]) ?? null;
            $data = [
                'type' => 'edit',
                'title' => 'Редактирование опроса',
                'pull_id' => $id,
                'data' => $response->getBody(),
                'options' => $options
            ];
            return $this->renderView('poll', $data);
        }
        return $this->renderView('errors', ['errors'=>$response->getBody()]);
    }
}
