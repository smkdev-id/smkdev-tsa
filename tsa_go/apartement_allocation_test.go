package main

import (
	"testing"

	"github.com/stretchr/testify/assert"
)

func TestSolve(t *testing.T) {
	t.Run("handles base case with one applicant and one apartment within tolerance", func(t *testing.T) {
		A := []int{50}
		B := []int{55}
		N, M, K := 1, 1, 10
		result := SolveApartement(A, B, N, M, K)
		expected := 1
		assert.Equal(t, expected, result)
	})

	t.Run("handles base case with one applicant and one apartment out of tolerance", func(t *testing.T) {
		A := []int{50}
		B := []int{70}
		N, M, K := 1, 1, 10
		result := SolveApartement(A, B, N, M, K)
		expected := 0
		assert.Equal(t, expected, result)
	})

	t.Run("handles multiple applicants and apartments all within tolerance", func(t *testing.T) {
		A := []int{30, 40, 50}
		B := []int{35, 45, 55}
		N, M, K := 3, 3, 10
		result := SolveApartement(A, B, N, M, K)
		expected := 3
		assert.Equal(t, expected, result)
	})

	t.Run("handles applicants and apartments with some matches", func(t *testing.T) {
		A := []int{10, 20, 30}
		B := []int{15, 50, 55}
		N, M, K := 3, 3, 10
		result := SolveApartement(A, B, N, M, K)
		expected := 1
		assert.Equal(t, expected, result)
	})

	t.Run("handles applicants with no apartments available", func(t *testing.T) {
		A := []int{10, 20, 30}
		B := []int{}
		N, M, K := 3, 0, 10
		result := SolveApartement(A, B, N, M, K)
		expected := 0
		assert.Equal(t, expected, result)
	})

	t.Run("handles apartments with no applicants available", func(t *testing.T) {
		A := []int{}
		B := []int{10, 20, 30}
		N, M, K := 0, 3, 10
		result := SolveApartement(A, B, N, M, K)
		expected := 0
		assert.Equal(t, expected, result)
	})

	t.Run("handles when K is zero, no matches possible unless exact", func(t *testing.T) {
		A := []int{10, 20, 30}
		B := []int{20, 30, 40}
		N, M, K := 3, 3, 0
		result := SolveApartement(A, B, N, M, K)
		expected := 2
		assert.Equal(t, expected, result)
	})

	t.Run("handles larger tolerance K allowing more matches", func(t *testing.T) {
		A := []int{10, 20, 30}
		B := []int{25, 35, 45}
		N, M, K := 3, 3, 20
		result := SolveApartement(A, B, N, M, K)
		expected := 3
		assert.Equal(t, expected, result)
	})

	t.Run("handles unequal number of applicants and apartments, fewer apartments", func(t *testing.T) {
		A := []int{10, 20, 30, 40}
		B := []int{15, 35}
		N, M, K := 4, 2, 10
		result := SolveApartement(A, B, N, M, K)
		expected := 2
		assert.Equal(t, expected, result)
	})

	t.Run("handles unequal number of applicants and apartments, fewer applicants", func(t *testing.T) {
		A := []int{10, 20}
		B := []int{15, 25, 35, 45}
		N, M, K := 2, 4, 10
		result := SolveApartement(A, B, N, M, K)
		expected := 2
		assert.Equal(t, expected, result)
	})

	t.Run("handles all matches when tolerance is very large", func(t *testing.T) {
		A := []int{10, 20, 30}
		B := []int{100, 200, 300}
		N, M, K := 3, 3, 1000
		result := SolveApartement(A, B, N, M, K)
		expected := 3
		assert.Equal(t, expected, result)
	})

	t.Run("handles no matches when arrays are disjoint", func(t *testing.T) {
		A := []int{10, 20, 30}
		B := []int{100, 200, 300}
		N, M, K := 3, 3, 10
		result := SolveApartement(A, B, N, M, K)
		expected := 0
		assert.Equal(t, expected, result)
	})

	t.Run("handles mixed case of matches and mismatches", func(t *testing.T) {
		A := []int{10, 50, 90}
		B := []int{20, 60, 100}
		N, M, K := 3, 3, 15
		result := SolveApartement(A, B, N, M, K)
		expected := 3
		assert.Equal(t, expected, result)
	})

	t.Run("handles single-element arrays with no match", func(t *testing.T) {
		A := []int{10}
		B := []int{30}
		N, M, K := 1, 1, 10
		result := SolveApartement(A, B, N, M, K)
		expected := 0
		assert.Equal(t, expected, result)
	})

	t.Run("handles single-element arrays with exact match", func(t *testing.T) {
		A := []int{10}
		B := []int{10}
		N, M, K := 1, 1, 0
		result := SolveApartement(A, B, N, M, K)
		expected := 1
		assert.Equal(t, expected, result)
	})

	t.Run("handles larger arrays with all matches", func(t *testing.T) {
		A := []int{10, 20, 30, 40, 50}
		B := []int{11, 21, 31, 41, 51}
		N, M, K := 5, 5, 5
		result := SolveApartement(A, B, N, M, K)
		expected := 5
		assert.Equal(t, expected, result)
	})

	t.Run("handles descending arrays", func(t *testing.T) {
		A := []int{50, 40, 30, 20, 10}
		B := []int{51, 41, 31, 21, 11}
		N, M, K := 5, 5, 5
		result := SolveApartement(A, B, N, M, K)
		expected := 5
		assert.Equal(t, expected, result)
	})

	t.Run("handles high variance in demands and apartment sizes", func(t *testing.T) {
		A := []int{5, 20, 50, 80, 120}
		B := []int{10, 30, 40, 100, 110}
		N, M, K := 5, 5, 15
		result := SolveApartement(A, B, N, M, K)
		expected := 4
		assert.Equal(t, expected, result)
	})

	t.Run("handles apartments with duplicate sizes", func(t *testing.T) {
		A := []int{10, 15, 20}
		B := []int{20, 20, 20}
		N, M, K := 3, 3, 5
		result := SolveApartement(A, B, N, M, K)
		expected := 2
		assert.Equal(t, expected, result)
	})

	t.Run("handles both arrays empty", func(t *testing.T) {
		A := []int{}
		B := []int{}
		N, M, K := 0, 0, 10
		result := SolveApartement(A, B, N, M, K)
		expected := 0
		assert.Equal(t, expected, result)
	})
}
