package tsa_java;

import static org.junit.jupiter.api.Assertions.assertEquals;

import java.util.ArrayList;
import java.util.List;

import org.junit.jupiter.api.Test;

public class TowerOfHanoiTest {

    // Helper method to validate the number of moves and the last move
    private void validateTowerOfHanoi(int numberOfDisks, int expectedMoves, int[] expectedLastMove) {
        List<int[]> moves = new ArrayList<>();
        TowerOfHanoi.moveDisk(numberOfDisks, moves, 1, 3, 2);
        assertEquals(expectedMoves, moves.size(), "Incorrect number of moves");
        assertEquals(expectedLastMove[0], moves.get(moves.size() - 1)[0], "Last move source mismatch");
        assertEquals(expectedLastMove[1], moves.get(moves.size() - 1)[1], "Last move destination mismatch");
    }

    // Test Case 1: Test with one disk
    @Test
    void testSingleDisk() {
        validateTowerOfHanoi(1, 1, new int[]{1, 3});
    }

    // Test Case 2: Test with two disks
    @Test
    void testTwoDisks() {
        validateTowerOfHanoi(2, 3, new int[]{2, 3});
    }

    // Test Case 3: Test with three disks
    @Test
    void testThreeDisks() {
        List<int[]> moves = new ArrayList<>();
        TowerOfHanoi.moveDisk(3, moves, 1, 3, 2);
        assertEquals(7, moves.size(), "Incorrect number of moves for three disks");
        assertEquals(1, moves.get(0)[0], "First move source mismatch");
        assertEquals(3, moves.get(6)[1], "Last move destination mismatch");
    }

    // Test Case 4: Verify moves for zero disks (edge case)
    @Test
    void testZeroDisks() {
        List<int[]> moves = new ArrayList<>();
        TowerOfHanoi.moveDisk(0, moves, 1, 3, 2);
        assertEquals(0, moves.size(), "No moves should occur for zero disks");
    }

    // Test Case 5: Validate total moves formula (2^n - 1) for four disks
    @Test
    void testFourDisksMovesFormula() {
        List<int[]> moves = new ArrayList<>();
        TowerOfHanoi.moveDisk(4, moves, 1, 3, 2);
        assertEquals((int) Math.pow(2, 4) - 1, moves.size(), "Incorrect number of moves for four disks");
    }

    // Test Case 6: Test with more disks (e.g., 5 disks)
    @Test
    void testFiveDisks() {
        List<int[]> moves = new ArrayList<>();
        TowerOfHanoi.moveDisk(5, moves, 1, 3, 2);
        assertEquals(31, moves.size(), "Incorrect number of moves for five disks");
        assertEquals(1, moves.get(0)[0], "First move source mismatch");
        assertEquals(3, moves.get(30)[1], "Last move destination mismatch");
    }

    // Test Case 7: Verify first move is always from source to destination
    @Test
    void testFirstMove() {
        List<int[]> moves = new ArrayList<>();
        TowerOfHanoi.moveDisk(3, moves, 1, 3, 2);
        assertEquals(1, moves.get(0)[0], "First move source mismatch");
        assertEquals(3, moves.get(0)[1], "First move destination mismatch");
    }

    // Test Case 8: Verify total moves for large input (e.g., 10 disks)
    @Test
    void testLargeNumberOfDisks() {
        List<int[]> moves = new ArrayList<>();
        TowerOfHanoi.moveDisk(10, moves, 1, 3, 2);
        assertEquals((int) Math.pow(2, 10) - 1, moves.size(), "Incorrect number of moves for ten disks");
    }

    // Test Case 9: Validate sequence of moves for three disks
    @Test
    void testMoveSequenceForThreeDisks() {
        List<int[]> moves = new ArrayList<>();
        TowerOfHanoi.moveDisk(3, moves, 1, 3, 2);
        assertEquals(7, moves.size(), "Incorrect number of moves for three disks");
        // Specific move verification
        assertEquals(1, moves.get(0)[0]);
        assertEquals(3, moves.get(0)[1]);
    }

    // Test Case 10: Validate no duplicate moves
    @Test
    void testNoDuplicateMoves() {
        List<int[]> moves = new ArrayList<>();
        TowerOfHanoi.moveDisk(4, moves, 1, 3, 2);
        assertEquals(moves.size(), moves.stream().distinct().count(), "Duplicate moves detected");
    }

    // Test Case 11: Verify moves contain only valid stack numbers
    @Test
    void testValidStackNumbers() {
        List<int[]> moves = new ArrayList<>();
        TowerOfHanoi.moveDisk(3, moves, 1, 3, 2);
        for (int[] move : moves) {
            for (int stack : move) {
                assertEquals(true, stack >= 1 && stack <= 3, "Invalid stack number");
            }
        }
    }

    // Test Case 12: Verify empty list for invalid input (negative disks)
    @Test
    void testNegativeDisks() {
        List<int[]> moves = new ArrayList<>();
        TowerOfHanoi.moveDisk(-1, moves, 1, 3, 2);
        assertEquals(0, moves.size(), "No moves should occur for negative disks");
    }

    // Test Case 13: Validate recursive behavior for three disks
    @Test
    void testRecursiveBehavior() {
        List<int[]> moves = new ArrayList<>();
        TowerOfHanoi.moveDisk(3, moves, 1, 3, 2);
        assertEquals(7, moves.size(), "Incorrect moves generated");
        assertEquals(1, moves.get(0)[0]);
        assertEquals(3, moves.get(6)[1]);
    }

    // Test Case 14: Test source and destination swapped
    @Test
    void testSourceAndDestinationSwapped() {
        List<int[]> moves = new ArrayList<>();
        TowerOfHanoi.moveDisk(3, moves, 3, 1, 2);
        assertEquals(7, moves.size(), "Incorrect moves generated");
        assertEquals(3, moves.get(0)[0]);
    }

    // Test Case 15: Test minimum valid disks
    @Test
    void testMinimumDisks() {
        validateTowerOfHanoi(1, 1, new int[]{1, 3});
    }

    // Test Case 16: Validate no changes for uninitialized list
    @Test
    void testUninitializedMovesList() {
        List<int[]> moves = new ArrayList<>();
        TowerOfHanoi.moveDisk(2, moves, 1, 3, 2);
        assertEquals(3, moves.size(), "Moves list not updated correctly");
    }

    // Test Case 17: Validate behavior for a very high number of disks
    @Test
    void testHighNumberOfDisks() {
        List<int[]> moves = new ArrayList<>();
        TowerOfHanoi.moveDisk(15, moves, 1, 3, 2);
        assertEquals((int) Math.pow(2, 15) - 1, moves.size(), "Incorrect moves for high number of disks");
    }

    // Test Case 18: Ensure proper move pattern for specific stack roles
    @Test
    void testSpecificStackRoles() {
        List<int[]> moves = new ArrayList<>();
        TowerOfHanoi.moveDisk(2, moves, 2, 3, 1);
        assertEquals(3, moves.size(), "Moves incorrect for specific stack roles");
        assertEquals(2, moves.get(0)[0]);
    }

    // Test Case 19: Validate recursive breakdown of moves
    @Test
    void testRecursiveBreakdown() {
        List<int[]> moves = new ArrayList<>();
        TowerOfHanoi.moveDisk(4, moves, 1, 3, 2);
        assertEquals((int) Math.pow(2, 4) - 1, moves.size());
    }

    // Test Case 20: Validate correct last move for even number of disks
    @Test
    void testLastMoveForEvenDisks() {
        validateTowerOfHanoi(4, 15, new int[]{2, 3});
    }
}
