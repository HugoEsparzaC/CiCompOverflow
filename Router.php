<?php
namespace MVC;

class Router {
    public array $getRoutes = [];
    public array $postRoutes = [];

    public function get($url, $fn) {
        $this->getRoutes[$url] = $fn;
    }

    public function post($url, $fn) {
        $this->postRoutes[$url] = $fn;
    }

    public function checkRoutes() {
        // Protect Routes...
        session_start();

        $currentUrl = $_SERVER['PATH_INFO'] ?? '/';
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method === 'GET') {
            $fn = $this->getRoutes[$currentUrl] ?? null;
        } else {
            $fn = $this->postRoutes[$currentUrl] ?? null;
        }

        if ( $fn ) {
            // Call user fn will call a function when we don't know which one it will be
            call_user_func($fn, $this); // This is to pass arguments
        } else {
            echo "Page Not Found or Invalid Route";
        }
    }

    public function render($view, $datos = []) {
        // Read what we pass to the view
        foreach ($datos as $key => $value) {
            $$key = $value;  // Double dollar sign means: variable variable, basically our variable remains the original, but when assigning it to another it does not overwrite it, it keeps its value, this way the variable name is assigned dynamically
        }

        ob_start(); // Store in memory for a moment...

        // then include the view in the layout
        include_once __DIR__ . "/views/$view.php";
        $content = ob_get_clean(); // Clean the Buffer
        include_once __DIR__ . '/views/layout.php';
    }
}