<?php

// Register the autoloader
// Register the autoloader
spl_autoload_register('getClass');

function getClass($className) {
    $directories = ['Controller/', 'Model/', 'View/'];

    // Convert namespace separators to directory separators
    $className = ltrim($className, '\\');
    $fileName  = '';
    $namespace = '';

    if ($lastNsPos = strrpos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }

    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

    // Loop through each directory
    foreach ($directories as $dir) {
        $fullPath = __DIR__ . '/' . $dir . $className.'.class.php';

        // Check if the file exists
        if (file_exists($fullPath)) {
            require_once $fullPath;
            return;
        }
    }

    // Debugging statement
    echo "File not found for class: $className<br>";
}
