<?php

session_start();

// Load .env Environment Configuration
$envFile = __DIR__ . '/../.env';
if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $line = trim($line);
        if (empty($line) || strpos($line, '#') === 0) continue;
        if (strpos($line, '=') !== false) {
            list($name, $val) = explode('=', $line, 2);
            $name = trim($name);
            $val = trim($val, " \"'");
            if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
                putenv("$name=$val");
                $_ENV[$name] = $val;
                $_SERVER[$name] = $val;
            }
        }
    }
}

function env(string $key, mixed $default = null): mixed {
    $value = getenv($key);
    if ($value === false) {
        return $default;
    }
    switch (strtolower($value)) {
        case 'true':
        case '(true)':
            return true;
        case 'false':
        case '(false)':
            return false;
        case 'null':
        case '(null)':
            return null;
    }
    return $value;
}

// Basic PSR-4 Autoloader for App namespace
spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $baseDir = __DIR__ . '/../app/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relativeClass = substr($class, $len);
    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});

// Initialize Database Connection & Tables
\App\Database\Database::getConnection();

// Global URL & Asset Helpers for Subfolder Deployments
function url(string $path = '/'): string {
    $scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/'));
    $base = rtrim($scriptDir, '/');
    if ($path === '/' || $path === '') {
        return $base !== '' ? $base : '/';
    }
    return $base . '/' . ltrim($path, '/');
}

function asset(string $path): string {
    return url($path);
}

// Robust URI Normalization for Subfolder & cPanel Deployments
$requestMethod = $_SERVER['REQUEST_METHOD'];
$rawUri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$scriptName = urldecode($_SERVER['SCRIPT_NAME']);
$scriptDir = dirname($scriptName);

// Clean up scriptDir for windows backslashes
$scriptDir = str_replace('\\', '/', $scriptDir);

$requestUri = $rawUri;

// If request Uri starts with scriptDir, strip it
if ($scriptDir !== '/' && $scriptDir !== '.' && strpos($requestUri, $scriptDir) === 0) {
    $requestUri = substr($requestUri, strlen($scriptDir));
}

// Strip trailing /public if scriptDir didn't include it
if (strpos($requestUri, '/public') === 0) {
    $requestUri = substr($requestUri, 7);
}

// Normalize trailing slashes
if ($requestUri !== '/' && substr($requestUri, -1) === '/') {
    $requestUri = rtrim($requestUri, '/');
}

if (empty($requestUri)) {
    $requestUri = '/';
}

$routes = require __DIR__ . '/../routes/web.php';
$routeKey = "$requestMethod $requestUri";

if (isset($routes[$routeKey])) {
    [$controllerClass, $method] = $routes[$routeKey];
    $controller = new $controllerClass();
    $controller->$method();
} else {
    http_response_code(404);
    $title = "404 Sayfa Bulunamadı - Miraç Su";
    $settings = \App\Models\Setting::getAll();
    require __DIR__ . '/../resources/views/layouts/app.php';
    echo '<div class="container py-5 text-center my-5"><h1 class="display-3 font-weight-bold text-primary mb-3"><i class="fa-solid fa-water-ladder text-info"></i> 404</h1><p class="lead">Aradığınız sayfa bulunamadı veya kaldırılmış olabilir.</p><a href="' . url('/') . '" class="btn btn-primary mt-3"><i class="fa-solid fa-house"></i> Ana Sayfaya Dön</a></div>';
}
