<?php

namespace Core;
class Router{
    protected $routes = [];

    public function add($method, $uri, $controller){
        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller,
            'middleware' => null
        ];

        return $this;
    }

    public function get($uri, $controller ){
        return $this->add('GET', $uri, $controller);
    }

    public function post($uri, $controller){
        return $this->add('POST', $uri, $controller);
    }

    public function delete($uri, $controller){
        return $this->add('DELETE', $uri, $controller);
    }

    public function patch($uri, $controller){
        return $this->add('PATCH', $uri, $controller);
    }

    public function put($uri, $controller){
        return $this->add('PUT', $uri, $controller);
    }

    public function only($key){
        $this->routes[array_key_last($this->routes)]['middleware'] = $key;

        return $this;

    }

    public function route($uri, $method){
        foreach($this->routes as $route){
            if($route['uri'] === $uri && $route['method'] === strtoupper($method)){

                if($route['middleware'] === 'guest'){
                    if($_SESSION['user'] ?? false){
                        header('Location: /');
                        die();
                    }
                }
                return require base_path($route['controller']);
            }
        }
    }

    public function abort($code = 404){
        http_response_code($code);

        require base_path("views/{$code}.php");

        die();
    }
}

// function routeToController($uri, $routes) {
//     if (array_key_exists($uri, $routes)) {
//         require base_path($routes[$uri]);
//     } else {
//         abort();
//     }
// }

// function abort($code = 404) {
//     http_response_code($code);

//     require base_path("views/{$code}.php");

//     die();
// }

// $routes = require base_path('routes.php');
// $uri = parse_url($_SERVER['REQUEST_URI'])['path'];

// routeToController($uri, $routes);