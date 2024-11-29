const { solveApartement } = require('./apartement-allocation');

describe('solveApartement', () => {
    test('returns correct matches when all applicants perfectly match apartments', () => {
        expect(solveApartement([10, 20, 30], [10, 20, 30], 3, 3, 0)).toBe(3);
    });

    test('returns 0 when no applicant matches an apartment', () => {
        expect(solveApartement([10, 20, 30], [40, 50, 60], 3, 3, 5)).toBe(0);
    });

    test('matches one applicant to a nearby apartment within tolerance', () => {
        expect(solveApartement([15], [10, 20, 30], 1, 3, 5)).toBe(1);
    });

    test('handles fewer applicants than apartments correctly', () => {
        expect(solveApartement([10, 15], [10, 15, 20], 2, 3, 5)).toBe(2);
    });

    test('handles fewer apartments than applicants correctly', () => {
        expect(solveApartement([10, 20, 30], [15, 25], 3, 2, 5)).toBe(2);
    });

    test('matches all when all sizes are identical and tolerance is 0', () => {
        expect(solveApartement([10, 10, 10], [10, 10, 10], 3, 3, 0)).toBe(3);
    });

    test('matches all when tolerance is very large', () => {
        expect(solveApartement([1, 2, 3], [100, 200, 300], 3, 3, 1000)).toBe(3);
    });

    test('matches only exact sizes when tolerance is 0', () => {
        expect(solveApartement([1, 2, 3], [1, 3, 5], 3, 3, 0)).toBe(2);
    });

    test('handles negative values in both arrays', () => {
        expect(solveApartement([-5, -2, 0], [-4, -2, 1], 3, 3, 1)).toBe(3);
    });

    test('works correctly when arrays are pre-sorted', () => {
        expect(solveApartement([1, 2, 3], [2, 3, 4], 3, 3, 1)).toBe(3);
    });

    test('sorts unsorted arrays before matching', () => {
        expect(solveApartement([3, 1, 2], [4, 2, 3], 3, 3, 1)).toBe(3);
    });

    test('returns 0 when one array is empty', () => {
        expect(solveApartement([], [1, 2, 3], 0, 3, 1)).toBe(0);
    });

    test('returns 0 when both arrays are empty', () => {
        expect(solveApartement([], [], 0, 0, 1)).toBe(0);
    });

    test('matches all when tolerance exceeds all size differences', () => {
        expect(solveApartement([1, 10], [5, 15], 2, 2, 20)).toBe(2);
    });

    test('returns 0 when tolerance is too small for any match', () => {
        expect(solveApartement([1, 10], [5, 15], 2, 2, 1)).toBe(0);
    });

    test('matches partially when arrays have different lengths', () => {
        expect(solveApartement([1, 2, 3, 4], [2, 4], 4, 2, 1)).toBe(2);
    });

    test('handles large input sizes efficiently', () => {
        const A = Array.from({ length: 1000 }, (_, i) => i);
        const B = Array.from({ length: 1000 }, (_, i) => i);
        expect(solveApartement(A, B, 1000, 1000, 0)).toBe(1000);
    });

    test('returns 0 when tolerance is 0 and no matches exist', () => {
        expect(solveApartement([1, 2, 3], [4, 5, 6], 3, 3, 0)).toBe(0);
    });

    test('returns 0 when one array is too small for any match', () => {
        expect(solveApartement([1, 2, 3], [100, 200, 300], 3, 3, 10)).toBe(0);
    });

    test('handles single applicant and apartment correctly', () => {
        expect(solveApartement([10], [10], 1, 1, 0)).toBe(1);
    });
});