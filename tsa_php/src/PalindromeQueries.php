<?php

/**
 * Recursive function to move disks for the Tower of Hanoi problem.
 *
 * @param int $diskNumber The number of disks to move. Must be a positive integer.
 * @param array &$moves Array to store the sequence of moves as pairs of stack indices.
 *        Each move is represented as [sourceStack, destinationStack].
 * @param int $sourceStack The index of the source stack (typically 1, 2, or 3).
 * @param int $destinationStack The index of the destination stack (typically 1, 2, or 3).
 * @param int $auxiliaryStack The index of the auxiliary stack (typically 1, 2, or 3).
 */
function moveDisk($diskNumber, &$moves, $sourceStack, $destinationStack, $auxiliaryStack)
{
    // YOUR CODE HERE
    if ($diskNumber == 1) {
        $moves[] = [$sourceStack, $destinationStack];
        return;
    }

    moveDisk($diskNumber - 1, $moves, $sourceStack, $auxiliaryStack, $destinationStack);
    $moves[] = [$sourceStack, $destinationStack];
    moveDisk($diskNumber - 1, $moves, $auxiliaryStack, $destinationStack, $sourceStack);
}

/**
 * Function to solve the Tower of Hanoi problem.
 *
 * @param int $numberOfDisks The total number of disks to move. Must be a positive integer.
 */
function towerOfHanoi($numberOfDisks)
{
    // YOUR CODE HERE
    $moves = [];
    moveDisk($numberOfDisks, $moves, 1, 3, 2);

    echo count($moves) . "\n";
    foreach ($moves as [$from, $to]) {
        echo "$from $to\n";
    }
}

?>