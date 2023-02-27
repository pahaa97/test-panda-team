<?php

namespace App\Validators;

use App\Models\Poll;

class PollValidator extends Validator
{
    public function validateMorezero($field, $value)
    {
        return $value >= 0;
    }

    public function validateUnique($field, $value, $id = null) {
        $poll = new Poll();
        $polls = $poll->getAll("$field = ?", [$value]);
        if ($id) {
            foreach ($polls as $item) {
                if ($item['id'] == $id) {
                    return true;
                }
            }
        }
        if ($polls) {
            return false;
        }
        return true;
    }
}

