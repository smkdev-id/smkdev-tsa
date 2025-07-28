function moveDisk(diskNumber, moves, sourceStack, destinationStack, auxiliaryStack) {
    /**
        * @param {number} diskNumber - The number of disks to move. Must be a positive integer.
        * @param {Array<Array<number>>} moves - Array to store the sequence of moves as pairs of stack indices.
        *        Each move is represented as [sourceStack, destinationStack].
        * @param {number} sourceStack - The index of the source stack (typically 1, 2, or 3).
        * @param {number} destinationStack - The index of the destination stack (typically 1, 2, or 3).
        * @param {number} auxiliaryStack - The index of the auxiliary stack (typically 1, 2, or 3).
    */
    
    if (diskNumber < 1) {
        return;

    }

    if (diskNumber === 1) {
        moves.push([sourceStack, destinationStack]);
        return;

    }

    moveDisk(diskNumber - 1, moves, sourceStack, auxiliaryStack, destinationStack);
    moves.push([sourceStack, destinationStack]);
    moveDisk(diskNumber - 1, moves, auxiliaryStack, destinationStack, sourceStack);
}

// Function to solve Tower of Hanoi problem
function towerOfHanoi(numberOfDisks) {
    /**
        * @param {number} numberOfDisks - The total number of disks to move. Must be a positive integer.
    */
    const moves = [];
    moveDisk(numberOfDisks, moves, 1, 3, 2);

    console.log(moves.length);
    for (const [from, to] of moves) {
        console.log(from, to);

    }
    
}

module.exports = { moveDisk, towerOfHanoi };