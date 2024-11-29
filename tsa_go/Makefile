FILES = apartement_allocation.go palindrome_queries.go tower_of_hanoi.go
TESTS = apartement_allocation_test.go palindrome_queries_test.go tower_of_hanoi_test.go

.PHONY: all
all: deps fmt test

.PHONY: deps
deps:
	@echo "Checking and installing dependencies..."
	@go mod tidy
	@echo "Dependencies installed and tidy."

.PHONY: test
test:
	@echo "Running all tests with function coverage..."
	@go test ./... -coverprofile=coverage.out && go tool cover -func=coverage.out

.PHONY: test-file
test-file:
ifndef TEST_FILE
	$(error You must specify a TEST_FILE parameter, e.g., `make test-file TEST_FILE=palindrome_queries_test.go`)
endif
	@echo "Running test for $(TEST_FILE)..."
	@go test -v ./$(TEST_FILE)

.PHONY: fmt
fmt:
	@echo "Formatting Go code..."
	@go fmt ./...

.PHONY: help
help:
	@echo "Makefile Targets:"
	@echo "  all          - Install dependencies and run all tests (default)"
	@echo "  deps         - Check and install dependencies"
	@echo "  test         - Run all tests"
	@echo "  test-file    - Run tests for a specific file (use TEST_FILE=<file>)"
	@echo "  clean        - Clean up Go test cache"
	@echo "  run          - Run the application (use FILE=<file>)"
	@echo "  fmt          - Format all Go files"
	@echo "  lint         - Lint the Go code (requires golangci-lint)"
	@echo "  build        - Build the application"