<?php

class Router
{
    private $routes = [];

    public function get($uri, $action)
    {
        $this->routes['GET'][$uri] = $action;
    }

    public function dispatch()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes[$method] ?? [] as $route => $action) {

            // convert /test/{name} → regex
            $pattern = preg_replace('#\{[^/]+\}#', '([^/]+)', $route);
            $pattern = "#^" . $pattern . "$#";

            if (preg_match($pattern, $uri, $matches)) {

                array_shift($matches); // remove full match

                [$controller, $method] = explode('@', $action);

                $controller = new $controller();

                // 🔥 teaching debug
                echo "<pre>";
                echo "Matched route: $route\n";
                echo "URI: $uri\n";
                print_r($matches);
                echo "</pre>";

                return call_user_func_array([$controller, $method], $matches);
            }
        }

        http_response_code(404);
        echo "404 - Page Not Found";
    }
}
