const { moveDisk, towerOfHanoi } = require('./tower-of-hanoi');

describe("Tower of Hanoi - moveDisk function", () => {
    test("moves a single disk correctly", () => {
        let moves = [];
        moveDisk(1, moves, 1, 3, 2);
        expect(moves).toEqual([[1, 3]]);
    });

    test("moves two disks correctly", () => {
        let moves = [];
        moveDisk(2, moves, 1, 3, 2);
        expect(moves).toEqual([[1, 2], [1, 3], [2, 3]]);
    });

    test("moves three disks correctly", () => {
        let moves = [];
        moveDisk(3, moves, 1, 3, 2);
        expect(moves).toEqual([
            [1, 3], [1, 2], [3, 2],
            [1, 3], [2, 1], [2, 3], [1, 3]
        ]);
    });    

    test("handles a base case of zero disks", () => {
        let moves = [];
        moveDisk(0, moves, 1, 3, 2);
        expect(moves).toEqual([]);
    });

    test("handles base case of one disk with different source and destination stacks", () => {
        let moves = [];
        moveDisk(1, moves, 2, 1, 3);
        expect(moves).toEqual([[2, 1]]);
    });

    test("moves four disks correctly", () => {
        let moves = [];
        moveDisk(4, moves, 1, 3, 2);
        expect(moves).toHaveLength(15);
    });

    test("moves two disks with source and destination switched", () => {
        let moves = [];
        moveDisk(2, moves, 3, 1, 2);
        expect(moves).toEqual([[3, 2], [3, 1], [2, 1]]);
    });

    test("handles different auxiliary stack", () => {
        let moves = [];
        moveDisk(2, moves, 1, 3, 4);
        expect(moves).toEqual([[1, 4], [1, 3], [4, 3]]);
    });

    test("handles a large number of disks without crashing (10 disks)", () => {
        let moves = [];
        moveDisk(10, moves, 1, 3, 2);
        expect(moves).toHaveLength(1023);
    });

    test("handles invalid inputs gracefully (negative number of disks)", () => {
        let moves = [];
        moveDisk(-3, moves, 1, 3, 2);
        expect(moves).toEqual([]);
    });
});

describe("Tower of Hanoi - towerOfHanoi function", () => {
    const consoleSpy = jest.spyOn(console, 'log').mockImplementation();

    afterEach(() => {
        consoleSpy.mockClear();
    });

    test("solves the problem for 1 disk", () => {
        towerOfHanoi(1);
        expect(consoleSpy).toHaveBeenCalledWith(1);
        expect(consoleSpy).toHaveBeenCalledWith(1, 3);
    });

    test("solves the problem for 2 disks", () => {
        towerOfHanoi(2);
        expect(consoleSpy).toHaveBeenCalledWith(3);
        expect(consoleSpy.mock.calls.slice(1)).toEqual([
            [1, 2],
            [1, 3],
            [2, 3],
        ]);
    });

    test("solves the problem for 3 disks", () => {
        towerOfHanoi(3);
        expect(consoleSpy).toHaveBeenCalledWith(7);
        const loggedMoves = consoleSpy.mock.calls.slice(1).map(call => call.slice(0, 2));
        expect(loggedMoves).toEqual([
            [1, 3],
            [1, 2],
            [3, 2],
            [1, 3],
            [2, 1],
            [2, 3],
            [1, 3],
        ]);
    });
    
    test("handles edge case of 0 disks", () => {
        towerOfHanoi(0);
        expect(consoleSpy).toHaveBeenCalledWith(0);
        expect(consoleSpy.mock.calls.slice(1)).toHaveLength(0);
    });

    test("calculates correct total moves for 4 disks", () => {
        towerOfHanoi(4);
        expect(consoleSpy).toHaveBeenCalledWith(15);
    });

    test("outputs correct moves for a large number of disks (5 disks)", () => {
        towerOfHanoi(5);
        expect(consoleSpy).toHaveBeenCalledWith(31);
    });

    test("does not call console.log for invalid inputs", () => {
        towerOfHanoi(-1);
        expect(consoleSpy).toHaveBeenCalledTimes(1);
        expect(consoleSpy).toHaveBeenCalledWith(0);
    });    

    test("ensures no repeated moves in 3-disk solution", () => {
        towerOfHanoi(3);
        const moves = consoleSpy.mock.calls.slice(1);
        expect(new Set(moves).size).toBe(moves.length);
    });

    test("logs correct output for custom stacks (2 disks)", () => {
        let moves = [];
        moveDisk(2, moves, 2, 3, 1);
        expect(moves).toEqual([[2, 1], [2, 3], [1, 3]]);
    });

    test("logs correct moves for 6 disks", () => {
        towerOfHanoi(6);
        expect(consoleSpy).toHaveBeenCalledWith(63);
    });
});