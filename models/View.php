<?php
class View {
    private $layout = 'default';
    private $view;
    private $data = [];

    public function __construct($view = null) {
        $this->view = $view;
    }

    public function setLayout($layout) {
        $this->layout = $layout;
        return $this;
    }

    public function with($key, $value = null) {
        if (is_array($key)) {
            $this->data = array_merge($this->data, $key);
        } else {
            $this->data[$key] = $value;
        }
        return $this;
    }

    public function render($view = null) {
        if ($view) {
            $this->view = $view;
        }

        if (!$this->view) {
            throw new Exception('View name not specified');
        }

        extract($this->data);

        ob_start();
        include APP_PATH . "/views/{$this->view}.php";
        $content = ob_get_clean();

        if ($this->layout) {
            ob_start();
            include APP_PATH . "/views/layouts/{$this->layout}.php";
            return ob_get_clean();
        }

        return $content;
    }

    public static function make($view, $data = []) {
        return (new self($view))->with($data)->render();
    }
} 