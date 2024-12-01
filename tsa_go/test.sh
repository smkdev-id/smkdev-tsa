#!/bin/bash

set -e

echo "Checking and installing dependencies..."
go mod tidy
echo "Dependencies installed and tidy."

echo "Formatting Go code..."
go fmt ./...

echo "Running all tests with function coverage..."
go test ./... -coverprofile=coverage.out && go tool cover -func=coverage.out