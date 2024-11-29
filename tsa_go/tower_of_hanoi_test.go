package main

import (
	"testing"

	"github.com/stretchr/testify/assert"
)

func TestMoveDisk(t *testing.T) {
	t.Run("moves a single disk correctly", func(t *testing.T) {
		var moves [][]int
		MoveDisk(1, &moves, 1, 3, 2)
		expected := [][]int{{1, 3}}
		assert.Equal(t, expected, moves)
	})

	t.Run("moves two disks correctly", func(t *testing.T) {
		var moves [][]int
		MoveDisk(2, &moves, 1, 3, 2)
		expected := [][]int{
			{1, 2},
			{1, 3},
			{2, 3},
		}
		assert.Equal(t, expected, moves)
	})

	t.Run("moves three disks correctly", func(t *testing.T) {
		var moves [][]int
		MoveDisk(3, &moves, 1, 3, 2)
		expected := [][]int{
			{1, 3}, {1, 2}, {3, 2},
			{1, 3}, {2, 1}, {2, 3}, {1, 3},
		}
		assert.Equal(t, expected, moves, "The sequence of moves for 3 disks is incorrect")
	})

	t.Run("handles base case of zero disks", func(t *testing.T) {
		result := TowerOfHanoi(0)
		assert.Empty(t, result, "Expected an empty slice for 0 disks")
	})

	t.Run("handles base case of one disk with different source and destination stacks", func(t *testing.T) {
		var moves [][]int
		MoveDisk(1, &moves, 2, 3, 1)
		expected := [][]int{{2, 3}}
		assert.Equal(t, expected, moves)
	})

	t.Run("moves four disks correctly", func(t *testing.T) {
		var moves [][]int
		MoveDisk(4, &moves, 1, 3, 2)
		assert.Equal(t, 15, len(moves))
	})

	t.Run("moves two disks with source and destination switched", func(t *testing.T) {
		var moves [][]int
		MoveDisk(2, &moves, 3, 1, 2)
		expected := [][]int{
			{3, 2},
			{3, 1},
			{2, 1},
		}
		assert.Equal(t, expected, moves)
	})

	t.Run("handles different auxiliary stack", func(t *testing.T) {
		var moves [][]int
		MoveDisk(3, &moves, 1, 3, 4)
		assert.Equal(t, 7, len(moves))
	})

	t.Run("handles a large number of disks without crashing (10 disks)", func(t *testing.T) {
		var moves [][]int
		MoveDisk(10, &moves, 1, 3, 2)
		assert.Equal(t, 1023, len(moves))
	})

	t.Run("handles invalid inputs gracefully (negative number of disks)", func(t *testing.T) {
		var moves [][]int
		MoveDisk(-1, &moves, 1, 3, 2)
		assert.Equal(t, 0, len(moves))
	})
}

func TestTowerOfHanoi(t *testing.T) {
	t.Run("solves the problem for 1 disk", func(t *testing.T) {
		result := TowerOfHanoi(1)
		expected := [][]int{{1, 3}}
		assert.Equal(t, expected, result)
	})

	t.Run("solves the problem for 2 disks", func(t *testing.T) {
		result := TowerOfHanoi(2)
		expected := [][]int{
			{1, 2},
			{1, 3},
			{2, 3},
		}
		assert.Equal(t, expected, result)
	})

	t.Run("solves the problem for 3 disks", func(t *testing.T) {
		result := TowerOfHanoi(3)
		assert.Equal(t, 7, len(result))
	})

	t.Run("handles edge case of 0 disks", func(t *testing.T) {
		result := TowerOfHanoi(0)
		assert.Equal(t, 0, len(result))
	})

	t.Run("calculates correct total moves for 4 disks", func(t *testing.T) {
		result := TowerOfHanoi(4)
		assert.Equal(t, 15, len(result))
	})

	t.Run("outputs correct moves for a large number of disks (5 disks)", func(t *testing.T) {
		result := TowerOfHanoi(5)
		assert.Equal(t, 31, len(result))
	})

	t.Run("does not crash with large input (10 disks)", func(t *testing.T) {
		result := TowerOfHanoi(10)
		assert.Equal(t, 1023, len(result))
	})

	t.Run("solves Tower of Hanoi for 4 disks", func(t *testing.T) {
		moves := TowerOfHanoi(4)

		expected := [][]int{
			{1, 2}, {1, 3}, {2, 3},
			{1, 2}, {3, 1}, {3, 2}, {1, 2},
			{1, 3}, {2, 3}, {2, 1}, {3, 1},
			{2, 3}, {1, 2}, {1, 3}, {2, 3},
		}

		assert.Equal(t, expected, moves, "The sequence of moves for 4 disks is incorrect")
	})

	t.Run("logs correct moves for custom stacks (2 disks)", func(t *testing.T) {
		result := TowerOfHanoi(2)
		expected := [][]int{
			{1, 2},
			{1, 3},
			{2, 3},
		}
		assert.Equal(t, expected, result)
	})

	t.Run("logs correct moves for 6 disks", func(t *testing.T) {
		result := TowerOfHanoi(6)
		assert.Equal(t, 63, len(result))
	})
}
