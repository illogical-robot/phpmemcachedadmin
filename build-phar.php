<?php

$pharName = 'phpmemcachedadmin.phar';
$pharFile = __DIR__ . '/' . $pharName;

if (file_exists($pharFile)) {
    unlink($pharFile);
}

$phar = new Phar($pharFile);

$phar->startBuffering();

// Add files from src, vendor, and other necessary files
// Excluding the phar script itself, git files, etc.
$phar->buildFromDirectory(__DIR__, '/^((?!build-phar\.php|build\.php|node_modules|\.git|\.idea|tests|docker).)*$/');

// Custom stub to handle web requests and static assets
$stub = <<<'EOT'
<?php
Phar::mapPhar();
$pharPath = 'phar://' . __FILE__;

// Basic mime type detection
function getMimeType($filename) {
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    $mimes = [
        'css'   => 'text/css',
        'js'    => 'application/javascript',
        'png'   => 'image/png',
        'jpg'   => 'image/jpeg',
        'jpeg'  => 'image/jpeg',
        'gif'   => 'image/gif',
        'svg'   => 'image/svg+xml',
        'ico'   => 'image/x-icon',
        'woff'  => 'font/woff',
        'woff2' => 'font/woff2',
        'ttf'   => 'font/ttf',
        'eot'   => 'application/vnd.ms-fontobject',
        'html'  => 'text/html',
    ];
    return isset($mimes[$ext]) ? $mimes[$ext] : 'application/octet-stream';
}

// Handle web request
if (php_sapi_name() !== 'cli') {
    $requestUri = $_SERVER['REQUEST_URI'] ?? '/';
    
    // Strip query string
    if (($pos = strpos($requestUri, '?')) !== false) {
        $requestUri = substr($requestUri, 0, $pos);
    }

    // If the script is running as /phpmemcachedadmin.phar/some/path, we need to extract /some/path
    $scriptName = $_SERVER['SCRIPT_NAME'];
    if (strpos($requestUri, $scriptName) === 0) {
        $path = substr($requestUri, strlen($scriptName));
    } else {
        $path = $requestUri;
    }

    // normalize path, so there always no start and end slashes
    $path = trim($path, '/');

//    if ($path === '') {
//        $path = '/';
//    }

    $fileName = basename($path);
    if (!str_contains($fileName, '.')) {
        // we can serve only files. If there is no dot in the path last segment, this is probably a directory. Let's
        // assume the directory should contain an index.php file

        $path .= '/index.php';
    }

    // Map to src/public
    $internalPath = "src/public/$path";
    $absolutePath = "$pharPath/$internalPath";

    if (is_file($absolutePath)) {
        // If it's a PHP file, include it (mainly for index.php)
        if (pathinfo($absolutePath, PATHINFO_EXTENSION) === 'php') {
            require $absolutePath;
        } else {
            // Serve static asset
            header('Content-Type: ' . getMimeType($absolutePath));
            readfile($absolutePath);
        }
        exit;
    }
    
    
//    if (file_exists($absolutePath)) {
//        if (is_dir($absolutePath)) {
//            // Check for index.php in the directory
//            $indexFile = $absolutePath . '/index.php';
//            if (file_exists($indexFile)) {
//                require $indexFile;
//                exit;
//            }
//        } else {
//            // If it's a PHP file, include it
//            if (pathinfo($absolutePath, PATHINFO_EXTENSION) === 'php') {
//                require $absolutePath;
//            } else {
//                // Serve static asset
//                header('Content-Type: ' . getMimeType($absolutePath));
//                readfile($absolutePath);
//            }
//            exit;
//        }
//    }
    
    // Fallback to index.php for routing if file not found (optional, depending on app logic)
    // But usually static assets should be found. If not, maybe it's a route handled by index.php?
    // The original index.php seems to handle query params (?show=...), not path routing.
    // So if we are here, it might be a 404 or a request for index.php with params.
    
    require "$pharPath/src/public/index.php";
    exit;
}

// CLI mode
require "$pharPath/src/public/index.php";

__HALT_COMPILER();
EOT;

$phar->setStub($stub);

$phar->stopBuffering();

echo "PHAR archive created successfully: $pharName\n";
