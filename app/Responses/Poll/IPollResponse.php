<?php

namespace App\Responses\Poll;

interface IPollResponse
{
    public static function validatePollAndResponse(array $data);

    public static function validateOptionAndGetErrors(array $data);
}
