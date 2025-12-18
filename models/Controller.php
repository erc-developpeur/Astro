<?php
class Controller {
    protected $request;
    protected $response;
    protected $view;

    public function __construct() {
        $this->request = new Request();
        $this->response = new Response();
        $this->view = new View();
    }

    protected function render($view, $data = []) {
        return $this->view->with($data)->render($view);
    }

    protected function json($data, $status = 200) {
        return $this->response
            ->setContent(json_encode($data))
            ->setHeader('Content-Type', 'application/json')
            ->setStatus($status);
    }

    protected function redirect($url, $status = 302) {
        return $this->response
            ->setHeader('Location', $url)
            ->setStatus($status);
    }

    protected function back() {
        return $this->redirect($_SERVER['HTTP_REFERER'] ?? '/');
    }

    protected function validate($data, $rules) {
        $validator = new Validator($data, $rules);
        if (!$validator->passes()) {
            return $this->json([
                'errors' => $validator->errors()
            ], 422);
        }
        return true;
    }
} 