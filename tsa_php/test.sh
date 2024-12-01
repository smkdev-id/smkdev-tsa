#!/bin/bash

set -e

if [ ! -d "vendor" ]; then
    echo "Vendor directory not found. Running composer install..."
    composer install --quiet --no-interaction --optimize-autoloader --prefer-dist --no-dev
    echo "Composer install completed."
fi

echo "Run Test Cases Problem"
XDEBUG_MODE=coverage ./vendor/bin/phpunit tests --coverage-html coverage --coverage-filter src

echo "Test Completed"