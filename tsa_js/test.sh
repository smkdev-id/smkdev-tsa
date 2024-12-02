#!/bin/bash

set -e

if [ ! -d "node_modules" ]; then
    echo "Packages directory not found. Running npm install..."
    npm install
    echo "Package installation completed."
fi

echo "Run Test Cases Problem"

npm test

echo "Test Completed"