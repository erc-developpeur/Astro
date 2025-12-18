<?php
class Request {
    private $get;
    private $post;
    private $server;
    private $files;
    private $cookie;

    public function __construct() {
        $this->get = $_GET;
        $this->post = $_POST;
        $this->server = $_SERVER;
        $this->files = $_FILES;
        $this->cookie = $_COOKIE;
    }

    public function getMethod() {
        return strtoupper($this->server['REQUEST_METHOD']);
    }

    public function getUri() {
        return $this->server['REQUEST_URI'];
    }

    public function get($key = null, $default = null) {
        if ($key === null) {
            return $this->get;
        }
        return $this->get[$key] ?? $default;
    }

    public function post($key = null, $default = null) {
        if ($key === null) {
            return $this->post;
        }
        return $this->post[$key] ?? $default;
    }

    public function file($key = null) {
        if ($key === null) {
            return $this->files;
        }
        return $this->files[$key] ?? null;
    }

    public function cookie($key = null, $default = null) {
        if ($key === null) {
            return $this->cookie;
        }
        return $this->cookie[$key] ?? $default;
    }

    public function isGet() {
        return $this->getMethod() === 'GET';
    }

    public function isPost() {
        return $this->getMethod() === 'POST';
    }

    public function isAjax() {
        return isset($this->server['HTTP_X_REQUESTED_WITH']) && 
               strtolower($this->server['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }

    public function getIp() {
        return $this->server['REMOTE_ADDR'] ?? null;
    }

    public function getUserAgent() {
        return $this->server['HTTP_USER_AGENT'] ?? null;
    }
} 