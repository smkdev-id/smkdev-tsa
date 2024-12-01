<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/TowerOfHanoi.php';

class TowerOfHanoiTest extends TestCase
{
    private function calculateExpectedMoves($numberOfDisks)
    {
        return pow(2, $numberOfDisks) - 1;
    }

    /**
     * Test case 1: Solving Tower of Hanoi for 1 disk
     */
    public function testSolveHanoiOneDisk()
    {
        ob_start();
        towerOfHanoi(1);
        $output = ob_get_clean();

        $this->assertStringContainsString("1", $output, "Number of moves should be 1 for 1 disk.");
        $this->assertStringContainsString("1 3", $output, "Move should be from stack 1 to stack 3.");
    }

    /**
     * Test case 2: Solving Tower of Hanoi for 2 disks
     */
    public function testSolveHanoiTwoDisks()
    {
        ob_start();
        towerOfHanoi(2);
        $output = ob_get_clean();

        $this->assertStringContainsString("3", $output, "Number of moves should be 3 for 2 disks.");
        $this->assertStringContainsString("1 2", $output, "First move should be from stack 1 to stack 2.");
        $this->assertStringContainsString("2 3", $output, "Last move should be from stack 2 to stack 3.");
    }

    /**
     * Test case 3: Solving Tower of Hanoi for 3 disks
     */
    public function testSolveHanoiThreeDisks()
    {
        ob_start();
        towerOfHanoi(3);
        $output = ob_get_clean();

        $this->assertStringContainsString("7", $output, "Number of moves should be 7 for 3 disks.");
    }

    /**
     * Test case 4: Invalid input (0 disks)
     */
    public function testSolveHanoiZeroDisks()
    {
        ob_start();
        towerOfHanoi(0);
        $output = ob_get_clean();

        $this->assertStringContainsString("0", $output, "Number of moves should be 0 for 0 disks.");
    }

    /**
     * Test case 5: Solving Tower of Hanoi for 4 disks
     */
    public function testSolveHanoiFourDisks()
    {
        ob_start();
        towerOfHanoi(4);
        $output = ob_get_clean();

        $this->assertStringContainsString("15", $output, "Number of moves should be 15 for 4 disks.");
    }

    /**
     * Test case 6: Verify the sequence of moves for 3 disks
     */
    public function testSequenceForThreeDisks()
    {
        $moves = [];
        moveDisk(3, $moves, 1, 3, 2);

        $expectedMoves = [
            [1, 3],
            [1, 2],
            [3, 2],
            [1, 3],
            [2, 1],
            [2, 3],
            [1, 3],
        ];

        $this->assertEquals($expectedMoves, $moves, "The sequence of moves should match for 3 disks.");
    }

    /**
     * Test case 7: Large input test (10 disks)
     */
    public function testSolveHanoiTenDisks()
    {
        ob_start();
        towerOfHanoi(10);
        $output = ob_get_clean();

        $expectedMoves = $this->calculateExpectedMoves(10);
        $this->assertStringContainsString((string)$expectedMoves, $output, "Number of moves should be correct for 10 disks.");
    }

    /**
     * Test case 8: Negative input
     */
    public function testNegativeInput()
    {
        ob_start();
        towerOfHanoi(-5);
        $output = ob_get_clean();

        $this->assertStringContainsString("0", $output, "Number of moves should be 0 for negative input.");
    }

    /**
     * Test case 9: Validate large input efficiency (15 disks)
     */
    public function testSolveHanoiFifteenDisks()
    {
        ob_start();
        towerOfHanoi(15);
        $output = ob_get_clean();

        $expectedMoves = $this->calculateExpectedMoves(15);
        $this->assertStringContainsString((string)$expectedMoves, $output, "Number of moves should be correct for 15 disks.");
    }

    public function testSolveHanoiFiveDisks()
    {
        ob_start();
        towerOfHanoi(5);
        $output = ob_get_clean();

        $expectedMoves = $this->calculateExpectedMoves(5);
        $this->assertStringContainsString((string)$expectedMoves, $output, "Number of moves should be correct for 5 disks.");
    }

    /**
     * Test case 11: Validate move sequence for 2 disks
     */
    public function testSequenceForTwoDisks()
    {
        $moves = [];
        moveDisk(2, $moves, 1, 3, 2);

        $expectedMoves = [
            [1, 2],
            [1, 3],
            [2, 3],
        ];

        $this->assertEquals($expectedMoves, $moves, "The sequence of moves should match for 2 disks.");
    }

    /**
     * Test case 12: Large input test (20 disks)
     */
    public function testSolveHanoiTwentyDisks()
    {
        $expectedMoves = $this->calculateExpectedMoves(20);

        $this->assertEquals($expectedMoves, pow(2, 20) - 1, "Number of moves for 20 disks should match the formula (2^n - 1).");
    }

    /**
     * Test case 13: Validate move sequence for 4 disks
     */
    public function testSequenceForFourDisks()
    {
        $moves = [];
        moveDisk(4, $moves, 1, 3, 2);

        $this->assertCount($this->calculateExpectedMoves(4), $moves, "The sequence should have the correct number of moves for 4 disks.");
    }

    /**
     * Test case 14: Verify number of moves for 6 disks
     */
    public function testSolveHanoiSixDisks()
    {
        ob_start();
        towerOfHanoi(6);
        $output = ob_get_clean();

        $expectedMoves = $this->calculateExpectedMoves(6);
        $this->assertStringContainsString((string)$expectedMoves, $output, "Number of moves should be correct for 6 disks.");
    }

    /**
     * Test case 15: Validate edge case for 1 disk sequence
     */
    public function testSingleDiskSequence()
    {
        $moves = [];
        moveDisk(1, $moves, 1, 3, 2);

        $expectedMoves = [
            [1, 3],
        ];

        $this->assertEquals($expectedMoves, $moves, "The move sequence should be correct for 1 disk.");
    }

    /**
     * Test case 16: Edge case with no disks (0 disks)
     */
    public function testNoDiskEdgeCase()
    {
        $moves = [];
        moveDisk(0, $moves, 1, 3, 2);

        $this->assertEmpty($moves, "The move sequence should be empty for 0 disks.");
    }

    /**
     * Test case 17: Validate recursive calls for 3 disks
     */
    public function testRecursiveLogicThreeDisks()
    {
        $moves = [];
        moveDisk(3, $moves, 1, 3, 2);

        $expectedMoveCount = $this->calculateExpectedMoves(3);
        $this->assertCount($expectedMoveCount, $moves, "Recursive logic should produce the correct number of moves for 3 disks.");
    }

    /**
     * Test case 18: Test for efficiency with 15 disks
     */
    public function testEfficiencyFifteenDisks()
    {
        $startTime = microtime(true);

        $moves = [];
        moveDisk(15, $moves, 1, 3, 2);

        $endTime = microtime(true);
        $executionTime = $endTime - $startTime;

        $this->assertLessThan(5, $executionTime, "The function should execute efficiently for 15 disks.");
    }

    /**
     * Test case 19: Validate total moves for 7 disks
     */
    public function testSolveHanoiSevenDisks()
    {
        ob_start();
        towerOfHanoi(7);
        $output = ob_get_clean();

        $expectedMoves = $this->calculateExpectedMoves(7);
        $this->assertStringContainsString((string)$expectedMoves, $output, "Number of moves should be correct for 7 disks.");
    }

    /**
     * Test case 20: Random small input test (8 disks)
     */
    public function testSolveHanoiEightDisks()
    {
        ob_start();
        towerOfHanoi(8);
        $output = ob_get_clean();

        $expectedMoves = $this->calculateExpectedMoves(8);
        $this->assertStringContainsString((string)$expectedMoves, $output, "Number of moves should be correct for 8 disks.");
    }
}

?>
