// Path to the .env file
$envFilePath = __DIR__ . '/.env';

// Read the .env file
$lines = file($envFilePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// Parse each line of the .env file
foreach ($lines as $line) {
    // Ignore lines starting with # (comments) and lines without '='
    if (strpos(trim($line), '#') === 0 || strpos(trim($line), '=') === false) {
        continue;
    }

    // Split the line into key and value
    list($key, $value) = explode('=', $line, 2);

    // Set the environment variable
    $_ENV[$key] = $value;
    putenv("$key=$value");
}