const {
    HashSegmentTree,
    initializeHashPowers,
    initializeHashTables,
    processOperations,
} = require('./palindrome-queries');

const MOD = 1000000007;
const HASH = 257;

describe('HashSegmentTree', () => {
    test('Basic update and query functionality', () => {
        const tree = new HashSegmentTree(5);
        tree.update(0, 10);
        tree.update(1, 20);
        expect(tree.query(0, 0)).toBe(10);
        expect(tree.query(0, 1)).toBe(30);
    });

    test('Query across full range', () => {
        const tree = new HashSegmentTree(4);
        tree.update(0, 1);
        tree.update(1, 2);
        tree.update(2, 3);
        tree.update(3, 4);
        expect(tree.query(0, 3)).toBe(10);
    });

    test('Updating and querying overlapping ranges', () => {
        const tree = new HashSegmentTree(6);
        tree.update(2, 5);
        tree.update(3, 7);
        expect(tree.query(2, 3)).toBe(12);
    });

    test('Edge case: query on empty tree', () => {
        const tree = new HashSegmentTree(3);
        expect(tree.query(0, 2)).toBe(0);
    });
});

describe('initializeHashPowers', () => {
    test('Correct hash powers for length 1', () => {
        const hashPowers = initializeHashPowers(1);
        expect(hashPowers).toEqual([1]);
    });

    test('Correct hash powers for longer length', () => {
        const hashPowers = initializeHashPowers(5);
        const expected = [1, 257, 66049, 16974593, 362470373];
        expect(hashPowers).toEqual(expected);
    });

    test('initializeHashPowers correctly handles large string lengths', () => {
        const length = 10; // A moderate string length
        const hashPowers = initializeHashPowers(length);
    
        // Verify the calculated hash powers
        let expected = [1];
        for (let i = 1; i < length; i++) {
            expected.push((expected[i - 1] * HASH) % MOD);
        }
    
        expect(hashPowers).toEqual(expected);
    });
    
    test('initializeHashPowers handles zero length gracefully', () => {
        const length = 0;
        const hashPowers = initializeHashPowers(length);
    
        // Should return an array with a single element [1]
        expect(hashPowers).toEqual([1]);
    });
     
});

describe('initializeHashTables', () => {
    test('Forward and backward hashes match for a palindrome', () => {
        const s = "radar";
        const hashPower = initializeHashPowers(s.length);
        const { fwdHash, bckHash } = initializeHashTables(s.length, s, hashPower);
        const fwdSum = fwdHash.query(0, 4);
        const bckSum = bckHash.query(0, 4);
        expect(fwdSum).toBe(bckSum);
    });

    test('Forward and backward hashes differ for non-palindrome', () => {
        const s = "abcde";
        const hashPower = initializeHashPowers(s.length);
        const { fwdHash, bckHash } = initializeHashTables(s.length, s, hashPower);
        const fwdSum = fwdHash.query(0, 4);
        const bckSum = bckHash.query(0, 4);
        expect(fwdSum).not.toBe(bckSum);
    });

    test('Individual hash values are correctly calculated', () => {
        const s = "abc";
        const hashPower = initializeHashPowers(s.length);
        const { fwdHash } = initializeHashTables(s.length, s, hashPower);
        expect(fwdHash.query(0, 0)).toBe((s.charCodeAt(0) * hashPower[0]) % MOD);
        expect(fwdHash.query(1, 1)).toBe((s.charCodeAt(1) * hashPower[1]) % MOD);
    });

    test('initializeHashTables calculates forward and backward hashes correctly', () => {
        const s = "abc";
        const hashPower = initializeHashPowers(s.length);
    
        // Initialize hash tables
        const { fwdHash, bckHash } = initializeHashTables(s.length, s, hashPower);
    
        // Manually calculate expected forward and backward hash values
        const expectedFwdHash = [
            (s.charCodeAt(0) * hashPower[0]) % MOD,
            (s.charCodeAt(1) * hashPower[1]) % MOD,
            (s.charCodeAt(2) * hashPower[2]) % MOD,
        ];
    
        const expectedBckHash = [
            (s.charCodeAt(0) * hashPower[2]) % MOD,
            (s.charCodeAt(1) * hashPower[1]) % MOD,
            (s.charCodeAt(2) * hashPower[0]) % MOD,
        ];
    
        // Verify the hash tables using queries
        expect(fwdHash.query(0, 0)).toBe(expectedFwdHash[0]);
        expect(fwdHash.query(1, 1)).toBe(expectedFwdHash[1]);
        expect(fwdHash.query(2, 2)).toBe(expectedFwdHash[2]);
    
        expect(bckHash.query(0, 0)).toBe(expectedBckHash[0]);
        expect(bckHash.query(1, 1)).toBe(expectedBckHash[1]);
        expect(bckHash.query(2, 2)).toBe(expectedBckHash[2]);
    });    
});

describe('processOperations', () => {
    test('Basic palindrome query with no updates', () => {
        const s = "abba";
        const operations = [[2, 1, 4]];
        const results = processOperations(s.length, operations, s);
        expect(results).toEqual(["YES"]);
    });

    test('Non-palindrome query with no updates', () => {
        const s = "abcd";
        const operations = [[2, 1, 4]];
        const results = processOperations(s.length, operations, s);
        expect(results).toEqual(["NO"]);
    });

    test('Single character query', () => {
        const s = "x";
        const operations = [[2, 1, 1]];
        const results = processOperations(s.length, operations, s);
        expect(results).toEqual(["YES"]);
    });

    test('Update to make substring palindrome', () => {
        const s = "abc";
        const operations = [
            [1, 2, 'a'],
            [2, 1, 3],  
        ];
        const results = processOperations(s.length, operations, s);
        console.log('Operations Results:', results);
        expect(results).toEqual(["YES"]);
    });    

    test('Update breaking a palindrome', () => {
        const s = "aba";
        const operations = [
            [1, 2, 'c'],
            [2, 1, 3],
        ];
        const results = processOperations(s.length, operations, s);
        expect(results).toEqual(["NO"]);
    });    

    test('Multiple queries with mixed results', () => {
        const s = "radar";
        const operations = [
            [2, 1, 5],
            [2, 2, 4],
            [2, 3, 3],
        ];
        const results = processOperations(s.length, operations, s);
        expect(results).toEqual(["YES", "YES", "YES"]);
    });

    test('Long string with multiple updates and queries', () => {
        const s = "abcdefghijklmnopqrstuvwxyz";
        const operations = [
            [2, 1, 26],
            [1, 13, 'z'],
            [2, 1, 26],
        ];
        const results = processOperations(s.length, operations, s);
        expect(results).toEqual(["NO", "NO"]);
    });

    test('Update then revert', () => {
        const s = "abba";
        const operations = [
            [1, 2, 'c'],
            [2, 1, 4],
            [1, 2, 'b'],
            [2, 1, 4],
        ];
        const results = processOperations(s.length, operations, s);
        expect(results).toEqual(["NO", "YES"]);
    });
});
