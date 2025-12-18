<?php
class Response {
    private $headers = [];
    private $content = '';
    private $statusCode = 200;

    public function setContent($content) {
        $this->content = $content;
        return $this;
    }

    public function setStatusCode($code) {
        $this->statusCode = $code;
        return $this;
    }

    public function addHeader($name, $value) {
        $this->headers[$name] = $value;
        return $this;
    }

    public function redirect($url, $statusCode = 302) {
        $this->addHeader('Location', $url);
        $this->setStatusCode($statusCode);
        return $this;
    }

    public function json($data) {
        $this->addHeader('Content-Type', 'application/json');
        $this->content = json_encode($data);
        return $this;
    }

    public function send() {
        http_response_code($this->statusCode);
        
        foreach ($this->headers as $name => $value) {
            header("$name: $value");
        }
        
        echo $this->content;
        exit;
    }
} 