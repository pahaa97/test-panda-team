<?php

namespace App\Models;

class Poll extends Model
{
    protected $table = 'polls';

    public function createOrUpdate(array $data)
    {
        if (isset($data['id'])) {
            // Если указан ID, то обновляем существующий опрос
            $poll = $this->find($data['id']);

            if (!$poll) {
                throw new Exception('Опрос с указанным ID не найден');
            }
            (new Poll())->update($data['id'],[
                'title' => $data['title'],
                'status' => $data['status'],
                'user_id' => $data['user_id']
            ]);
        } else {
            // Если ID не указан, то создаем новый опрос
            $poll = new Poll;
            $poll = $poll->create([
                'title' => $data['title'],
                'status' => $data['status'],
                'user_id' => $data['user_id']
            ]);
        }
        $poll_id = $data['id'] ?? $poll;

        // Сохраняем вопросы и варианты ответов
        if (isset($data['text[]']) && isset($data['votes[]'])) {
            $this->saveQuestions($data['text[]'], $data['votes[]'], $poll_id);
        }
        return $poll_id;
    }

    private function saveQuestions(array $text, array $votes,  int $pollId)
    {
        $option = new Option();
        $option->deleteWhere('poll_id = ?', [$pollId]);

        for ($i = 0; $i < count($text); $i++) {
            $option->create([
                'text' => $text[$i],
                'votes' => $votes[$i],
                'poll_id' => $pollId
            ]);
        }
    }

    public function userPolls($user_id, $status = null)
    {
        $query = 'user_id = ?';
        $sort = (isset($_GET['sort'])) ? $_GET['sort'] : '';
        $dir = (isset($_GET['dir'])) ? $_GET['dir'] : '';
        $data = [];
        $data[] = $user_id;
        if ($status) {
            $data[] = $status;
            $query .= 'AND status = ?';
        }
        return $this->getAll($query, $data, $sort, $dir);
    }
}
