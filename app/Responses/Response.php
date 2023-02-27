<?php

namespace App\Responses;

class Response
{
    protected $body;
    protected $statusCode;
    protected $headers;

    public function __construct($body = '', $statusCode = 200, $headers = ['Content-Type'=>'application/json'])
    {
        $this->body = $body;
        $this->statusCode = $statusCode;
        $this->headers = $headers;
    }

    public function setBody($body, $status = 200)
    {
        $this->body = $body;
        $this->statusCode = $status;
        return $this;
    }

    public function setHeader($key, $value)
    {
        $this->headers[] = [$key => $value];
    }

    public function send()
    {
        http_response_code($this->statusCode);

        foreach ($this->headers as $name => $value) {
            header("$name: $value");
        }

        return print $this->body;
    }

    public function getStatus()
    {
        return $this->statusCode;
    }

    public function getBody()
    {
        return $this->body;
    }
}
