<?php

namespace App\Requests;

class Request
{
    private $post;

    public function __construct()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $json = file_get_contents('php://input');
            if ($json == '') {
                $result = $_POST ?? [];
            }
            elseif (is_array(json_decode($json))) {
                foreach (json_decode($json) as $item) {
                    if (str_contains($item->name,'[]')) {
                        $result[$item->name][] = $item->value;
                    } else {
                        $result[$item->name] = $item->value;
                    }
                }
            } else {
                $result = json_decode($json, true);
            }
            $this->post = $result ?? [];
        } else {
            $this->post = $_POST ?? [];
        }
    }

    public function post($key, $default = null)
    {
        return $this->post[$key] ?? $default;
    }

    public function input($key)
    {
        return (isset($this->post[$key])) ? $this->post[$key] : false;
    }

    public function all()
    {
        return $this->post;
    }

    public function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    public function only(array $keys)
    {
        $values = [];
        foreach ($keys as $key) {
            $values[$key] = $this->post($key);
        }
        return $values;
    }
}
