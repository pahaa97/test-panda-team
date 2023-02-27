<?php
    $poll = (isset($data)) ? json_decode($data) : null;
    $content = "poll_content.php";
    include __DIR__."/../layout/general.php";
    ?>
