<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/ApartmentAllocation.php';

class ApartmentAllocationTest extends TestCase
{
    public function testAllApplicantsPerfectlyMatch()
    {
        $this->assertEquals(3, solveApartment([10, 20, 30], [10, 20, 30], 3, 3, 0));
    }

    /**
     * Test when no applicants match any apartment.
     */
    public function testNoMatches()
    {
        $this->assertEquals(0, solveApartment([10, 20, 30], [40, 50, 60], 3, 3, 5));
    }

    /**
     * Test when applicants and apartments overlap with tolerance.
     */
    public function testMatchesWithinTolerance()
    {
        $this->assertEquals(3, solveApartment([10, 20, 30], [15, 25, 35], 3, 3, 5));
    }

    /**
     * Test with more applicants than apartments.
     */
    public function testMoreApplicantsThanApartments()
    {
        $this->assertEquals(2, solveApartment([10, 20, 30, 40], [15, 25], 4, 2, 5));
    }

    /**
     * Test with more apartments than applicants.
     */
    public function testMoreApartmentsThanApplicants()
    {
        $this->assertEquals(2, solveApartment([10, 20], [15, 25, 35, 45], 2, 4, 5));
    }

    /**
     * Test when arrays are empty.
     */
    public function testEmptyArrays()
    {
        $this->assertEquals(0, solveApartment([], [], 0, 0, 5));
    }

    /**
     * Test with zero tolerance.
     */
    public function testZeroTolerance()
    {
        $this->assertEquals(2, solveApartment([10, 20, 30], [20, 30, 40], 3, 3, 0));
    }

    /**
     * Test with large tolerance allowing all matches.
     */
    public function testLargeTolerance()
    {
        $this->assertEquals(3, solveApartment([10, 20, 30], [100, 200, 300], 3, 3, 500));
    }

    /**
     * Test when only one applicant matches one apartment.
     */
    public function testOneMatch()
    {
        $this->assertEquals(3, solveApartment([10, 50, 90], [20, 60, 100], 3, 3, 10));
    }

    /**
     * Test when all apartments are too small.
     */
    public function testApartmentsTooSmall()
    {
        $this->assertEquals(0, solveApartment([50, 60, 70], [10, 20, 30], 3, 3, 5));
    }

    /**
     * Test when all applicants demand larger apartments.
     */
    public function testApplicantsDemandLarger()
    {
        $this->assertEquals(0, solveApartment([100, 200, 300], [50, 60, 70], 3, 3, 10));
    }

    /**
     * Test when multiple matches with varied tolerances.
     */
    public function testMultipleMatchesVariedTolerance()
    {
        $this->assertEquals(2, solveApartment([10, 50, 70], [15, 55, 90], 3, 3, 5));
    }

    /**
     * Test with one applicant and one apartment perfectly matching.
     */
    public function testSinglePerfectMatch()
    {
        $this->assertEquals(1, solveApartment([50], [50], 1, 1, 0));
    }

    /**
     * Test with one applicant and one apartment not matching.
     */
    public function testSingleNoMatch()
    {
        $this->assertEquals(0, solveApartment([50], [60], 1, 1, 5));
    }

    /**
     * Test with repeated values in both arrays.
     */
    public function testRepeatedValues()
    {
        $this->assertEquals(3, solveApartment([20, 20, 20], [20, 20, 20], 3, 3, 0));
    }

    /**
     * Test with descending order arrays.
     */
    public function testDescendingOrderArrays()
    {
        $this->assertEquals(3, solveApartment([30, 20, 10], [25, 15, 5], 3, 3, 5));
    }

    /**
     * Test with mixed values and zero tolerance.
     */
    public function testMixedValuesZeroTolerance()
    {
        $this->assertEquals(1, solveApartment([10, 20, 30], [30, 40, 50], 3, 3, 0));
    }

    /**
     * Test with large arrays and high tolerance.
     */
    public function testLargeArraysHighTolerance()
    {
        $A = range(1, 1000);
        $B = range(500, 1500);
        $this->assertEquals(1000, solveApartment($A, $B, 1000, 1000, 1000));
    }

    /**
     * Test with negative values in arrays.
     */
    public function testNegativeValues()
    {
        $this->assertEquals(3, solveApartment([-10, -20, -30], [-15, -25, -35], 3, 3, 5));
    }

    /**
     * Test when tolerance is negative (invalid case).
     */
    public function testNegativeTolerance()
    {
        $this->assertEquals(0, solveApartment([10, 20, 30], [15, 25, 35], 3, 3, -5));
    }
}

?>
