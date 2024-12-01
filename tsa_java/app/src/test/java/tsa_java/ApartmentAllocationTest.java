package tsa_java;

import org.junit.jupiter.api.Test;
import static org.junit.jupiter.api.Assertions.*;

import java.util.Arrays;

public class ApartmentAllocationTest {

    @Test
    void testExactMatch() {
        int[] A = {50};
        int[] B = {50};
        int N = 1, M = 1, K = 0;
        assertEquals(1, ApartementAllocation.solve(A, B, N, M, K), "Test when applicant demand and apartment size are exactly equal.");
    }

    @Test
    void testSingleNoMatch() {
        int[] A = {50};
        int[] B = {60};
        int N = 1, M = 1, K = 5;
        assertEquals(0, ApartementAllocation.solve(A, B, N, M, K), "Test when a single applicant cannot match any apartment due to tight tolerance.");
    }

    @Test
    void testSingleMatchWithinTolerance() {
        int[] A = {50};
        int[] B = {53};
        int N = 1, M = 1, K = 3;
        assertEquals(1, ApartementAllocation.solve(A, B, N, M, K), "Test when a single applicant can match within tolerance.");
    }

    @Test
    void testMultipleExactMatch() {
        int[] A = {40, 50, 60};
        int[] B = {40, 50, 60};
        int N = 3, M = 3, K = 0;
        assertEquals(3, ApartementAllocation.solve(A, B, N, M, K), "Test when multiple applicants match exactly with apartments.");
    }

    @Test
    void testMultipleNoMatch() {
        int[] A = {10, 20, 30};
        int[] B = {100, 200, 300};
        int N = 3, M = 3, K = 10;
        assertEquals(0, ApartementAllocation.solve(A, B, N, M, K), "Test when no applicant matches any apartment due to large differences.");
    }

    @Test
    void testSomeMatches() {
        int[] A = {10, 30, 50, 70};
        int[] B = {20, 35, 60, 80};
        int N = 4, M = 4, K = 10;
        assertEquals(4, ApartementAllocation.solve(A, B, N, M, K), "Test when some applicants match with apartments and others do not.");
    }

    @Test
    void testAllApartmentsMatchMultipleApplicants() {
        int[] A = {40, 50, 60};
        int[] B = {55};
        int N = 3, M = 1, K = 10;
        assertEquals(1, ApartementAllocation.solve(A, B, N, M, K), "Test when a single apartment matches one of many applicants.");
    }

    @Test
    void testAllApplicantsMatchMultipleApartments() {
        int[] A = {50};
        int[] B = {40, 50, 60};
        int N = 1, M = 3, K = 10;
        assertEquals(1, ApartementAllocation.solve(A, B, N, M, K), "Test when a single applicant matches one of many apartments.");
    }

    @Test
    void testNoApplicants() {
        int[] A = {};
        int[] B = {40, 50, 60};
        int N = 0, M = 3, K = 10;
        assertEquals(0, ApartementAllocation.solve(A, B, N, M, K), "Test when there are no applicants.");
    }

    @Test
    void testNoApartments() {
        int[] A = {40, 50, 60};
        int[] B = {};
        int N = 3, M = 0, K = 10;
        assertEquals(0, ApartementAllocation.solve(A, B, N, M, K), "Test when there are no apartments.");
    }

    @Test
    void testZeroTolerance() {
        int[] A = {50, 51, 52};
        int[] B = {50, 51, 52};
        int N = 3, M = 3, K = 0;
        assertEquals(3, ApartementAllocation.solve(A, B, N, M, K), "Test when tolerance is zero but demands match exactly.");
    }

    @Test
    void testLargeTolerance() {
        int[] A = {10, 20, 30};
        int[] B = {100, 200, 300};
        int N = 3, M = 3, K = 1000;
        assertEquals(3, ApartementAllocation.solve(A, B, N, M, K), "Test when tolerance is very large and all match.");
    }

    @Test
    void testDuplicatesInApplicants() {
        int[] A = {50, 50, 50};
        int[] B = {50};
        int N = 3, M = 1, K = 0;
        assertEquals(1, ApartementAllocation.solve(A, B, N, M, K), "Test when applicants have duplicate demands.");
    }

    @Test
    void testDuplicatesInApartments() {
        int[] A = {50};
        int[] B = {50, 50, 50};
        int N = 1, M = 3, K = 0;
        assertEquals(1, ApartementAllocation.solve(A, B, N, M, K), "Test when apartments have duplicate sizes.");
    }

    @Test
    void testAscendingOrder() {
        int[] A = {10, 20, 30};
        int[] B = {15, 25, 35};
        int N = 3, M = 3, K = 5;
        assertEquals(3, ApartementAllocation.solve(A, B, N, M, K), "Test with already sorted arrays.");
    }

    @Test
    void testDescendingOrder() {
        int[] A = {30, 20, 10};
        int[] B = {35, 25, 15};
        int N = 3, M = 3, K = 5;
        assertEquals(3, ApartementAllocation.solve(A, B, N, M, K), "Test with arrays sorted in descending order.");
    }

    @Test
    void testMixedOrder() {
        int[] A = {20, 30, 10};
        int[] B = {25, 15, 35};
        int N = 3, M = 3, K = 5;
        assertEquals(3, ApartementAllocation.solve(A, B, N, M, K), "Test with unsorted arrays.");
    }

    @Test
    void testLargeInput() {
        int N = 1000, M = 1000, K = 10;
        int[] A = new int[N];
        int[] B = new int[M];
        Arrays.fill(A, 50);
        Arrays.fill(B, 55);
        assertEquals(1000, ApartementAllocation.solve(A, B, N, M, K), "Test with large input arrays where all match.");
    }

    @Test
    void testSparseMatches() {
        int[] A = {10, 30, 50, 70};
        int[] B = {15, 35, 55, 85};
        int N = 4, M = 4, K = 2;
        assertEquals(0, ApartementAllocation.solve(A, B, N, M, K), "Test when sparse matches occur due to small tolerance.");
    }

    @Test
    void testEdgeCaseZeroToleranceNoMatch() {
        int[] A = {10, 20, 30};
        int[] B = {15, 25, 35};
        int N = 3, M = 3, K = 0;
        assertEquals(0, ApartementAllocation.solve(A, B, N, M, K), "Test edge case with zero tolerance and no matches.");
    }
}
