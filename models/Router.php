<?php
class Router {
    private $routes = [];
    private $notFoundCallback;

    public function get($path, $callback) {
        $this->addRoute('GET', $path, $callback);
    }

    public function post($path, $callback) {
        $this->addRoute('POST', $path, $callback);
    }

    public function put($path, $callback) {
        $this->addRoute('PUT', $path, $callback);
    }

    public function delete($path, $callback) {
        $this->addRoute('DELETE', $path, $callback);
    }

    private function addRoute($method, $path, $callback) {
        $pattern = preg_replace('/\/{([^\/]+)}/', '/([^/]+)', $path);
        $pattern = str_replace('/', '\/', $pattern);
        $pattern = '/^' . $pattern . '$/';
        
        $this->routes[] = [
            'method' => $method,
            'pattern' => $pattern,
            'callback' => $callback
        ];
    }

    public function notFound($callback) {
        $this->notFoundCallback = $callback;
    }

    public function dispatch() {
        $request = new Request();
        $method = $request->getMethod();
        $uri = parse_url($request->getUri(), PHP_URL_PATH);

        foreach ($this->routes as $route) {
            if ($route['method'] !== $method) {
                continue;
            }

            if (preg_match($route['pattern'], $uri, $matches)) {
                array_shift($matches);
                
                if (is_callable($route['callback'])) {
                    return call_user_func_array($route['callback'], $matches);
                }
                
                if (is_string($route['callback'])) {
                    list($controller, $action) = explode('@', $route['callback']);
                    $controllerClass = "Controllers\\$controller";
                    $controllerInstance = new $controllerClass();
                    return call_user_func_array([$controllerInstance, $action], $matches);
                }
            }
        }

        if ($this->notFoundCallback) {
            return call_user_func($this->notFoundCallback);
        }

        header("HTTP/1.0 404 Not Found");
        echo "404 Not Found";
    }
} 