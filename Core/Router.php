<?php
namespace Core;
class Router
{
    private $routes = [];

    public function handleRequest(string $uri, string $method)
    {
        foreach ($this->routes as $route) {
            if($route['uri'] == $uri && $route['method'] === $method) {
                $controller = new $route['callback'][0];
                $function = $route['callback'][1];
                return $controller->$function();
            }
        }
        http_response_code(404);
        throw new \Exception('uri not found');
    }

    public function getRouteList()
    {
        return $this->routes;
    }

    public function get(string $uri, array $callback)
    {
        $this->routes[] = [
            'uri' => $uri,
            'callback' => $callback,
            'method' => 'GET',
        ];
    }

    public function post(string $uri, array $callback, array $body)
    {
        $this->routes[] = [
            'uri' => $uri,
            'callback' => $callback,
            'method' => 'POST',
            'body' => $body,
        ];
    }

    public function put(string $uri, array $callback, array $body)
    {
        $this->routes[] = [
            'uri' => $uri,
            'callback' => $callback,
            'method' => 'PUT',
            'body' => $body,
        ];
    }

    public function delete(string $uri, array $callback)
    {
        $this->routes[] = [
            'uri' => $uri,
            'callback' => $callback,
            'method' => 'DELETE',
        ];
    }

}