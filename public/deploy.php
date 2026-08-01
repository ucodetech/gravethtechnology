<?php
// A standalone deployment script for servers without SSH access.
// Since Laravel needs the vendor/ directory to boot, a web route won't work 
// if composer install hasn't been run yet. This script runs independently.

if (!isset($_GET['key']) || $_GET['key'] !== 'run-deploy-123') {
    header('HTTP/1.0 403 Forbidden');
    die('Unauthorized action.');
}

$baseDir = realpath(__DIR__ . '/..');

echo "<pre>";
echo "Starting deployment in: $baseDir\n\n";

// Change to the project root directory
chdir($baseDir);

// Define commands
$commands = [
    'Composer Install' => 'composer install --optimize-autoloader --no-dev 2>&1',
    'Run Migrations'   => 'php artisan migrate --force 2>&1',
    'Optimize Clear'   => 'php artisan optimize:clear 2>&1',
    'Storage Link'     => 'php artisan storage:link 2>&1',
    'NPM Install'      => 'npm install 2>&1',
    'NPM Build'        => 'npm run build 2>&1'
];

foreach ($commands as $name => $cmd) {
    echo "====================================\n";
    echo "Running: $name\n";
    echo "Command: $cmd\n";
    echo "====================================\n";
    
    if (function_exists('shell_exec')) {
        $output = shell_exec($cmd);
        echo $output ? $output : "Done.\n";
    } else {
        echo "Error: shell_exec is disabled on this server.\n";
    }
    echo "\n";
}

echo "Deployment complete.\n";
echo "</pre>";
