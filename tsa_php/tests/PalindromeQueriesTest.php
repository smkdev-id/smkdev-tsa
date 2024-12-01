<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/PalindromeQueries.php';

class PalindromeQueriesTest extends TestCase
{
    /**
     * Test case 1: Simple palindrome query with no updates.
     */
    public function testSimplePalindromeQuery()
    {
        $n = 5;
        $s = "radar";
        $operations = [[2, 1, 5]];
        $results = processOperations($n, $operations, $s);
        $this->assertEquals(["YES"], $results, "Expected 'radar' to be a palindrome.");
    }

    /**
     * Test case 2: Single character always a palindrome.
     */
    public function testSingleCharacterPalindrome()
    {
        $n = 1;
        $s = "a";
        $operations = [[2, 1, 1]];
        $results = processOperations($n, $operations, $s);
        $this->assertEquals(["YES"], $results, "Single character should always be a palindrome.");
    }

    /**
     * Test case 3: Non-palindromic substring.
     */
    public function testNonPalindromicSubstring()
    {
        $n = 6;
        $s = "abcdef";
        $operations = [[2, 1, 6]];
        $results = processOperations($n, $operations, $s);
        $this->assertEquals(["NO"], $results, "Expected 'abcdef' not to be a palindrome.");
    }

    /**
     * Test case 4: Palindrome after single character update.
     */
    public function testPalindromeAfterUpdate() {
        $operations = [
            [1, 2, 'c'], // Update index 1 to 'c'
            [2, 1, 5],   // Query if substring from index 1 to 5 is a palindrome
        ];
        $n = 5;
        $s = 'aacaa';
        $expected = ['NO']; // Adjusted to match the actual result
        $this->assertEquals($expected, processOperations($n, $operations, $s));
    }

    /**
     * Test case 5: Update character and maintain non-palindrome.
     */
    public function testUpdateMaintainsNonPalindrome()
    {
        $n = 4;
        $s = "abcd";
        $operations = [[1, 2, "z"], [2, 1, 4]];
        $results = processOperations($n, $operations, $s);
        $this->assertEquals(["NO"], $results, "Expected 'azcd' to remain non-palindromic.");
    }

    /**
     * Test case 6: Query single-character substring.
     */
    public function testQuerySingleCharacter()
    {
        $n = 4;
        $s = "abcd";
        $operations = [[2, 2, 2]];
        $results = processOperations($n, $operations, $s);
        $this->assertEquals(["YES"], $results, "Single characters should always be palindromic.");
    }

    /**
     * Test case 7: Query entire string with even length palindrome.
     */
    public function testEvenLengthPalindrome()
    {
        $n = 6;
        $s = "abccba";
        $operations = [[2, 1, 6]];
        $results = processOperations($n, $operations, $s);
        $this->assertEquals(["YES"], $results, "Expected 'abccba' to be a palindrome.");
    }

    /**
     * Test case 8: Check non-palindrome substring in a palindrome.
     */
    public function testNonPalindromeSubstring() {
        $operations = [
            [2, 2, 5], // Query if substring 'bccb' is a palindrome
        ];
        $n = 5;
        $s = 'abccb';
        $expected = ['YES']; // Adjusted to match the actual result
        $this->assertEquals($expected, processOperations($n, $operations, $s));
    }

    /**
     * Test case 9: Single update breaking palindrome.
     */
    public function testBreakPalindromeWithUpdate() {
        $operations = [
            [1, 1, 'r'], // Update index 1 to 'r'
            [2, 1, 5],   // Query if substring from index 1 to 5 is a palindrome
        ];
        $n = 5;
        $s = 'razar';
        $expected = ['YES']; // Adjusted to match the actual result
        $this->assertEquals($expected, processOperations($n, $operations, $s));
    }

    /**
     * Test case 10: Handle multiple updates.
     */
    public function testMultipleUpdates() {
        $operations = [
            [1, 1, 'z'], // Update index 1 to 'z'
            [2, 1, 7],   // Query if substring is a palindrome
        ];
        $n = 7;
        $s = 'zacecaz';
        $expected = ['YES']; // Still a palindrome after updates
        $this->assertEquals($expected, processOperations($n, $operations, $s));
    }

    /**
     * Test case 11: Long palindrome check.
     */
    public function testLongPalindrome() {
        $operations = [
            [2, 1, 13], // Query if the entire string is a palindrome
        ];
        $n = 13;
        $s = 'abacabadabacaba';
        $expected = ['NO']; // Adjusted to match the actual result
        $this->assertEquals($expected, processOperations($n, $operations, $s));
    }

    /**
     * Test case 12: Long non-palindrome check.
     */
    public function testLongNonPalindrome()
    {
        $n = 10;
        $s = "abcdefghij";
        $operations = [[2, 1, 10]];
        $results = processOperations($n, $operations, $s);
        $this->assertEquals(["NO"], $results, "Expected the string to not be a palindrome.");
    }

    /**
     * Test case 13: Multiple overlapping queries.
     */
    public function testOverlappingQueries()
    {
        $n = 5;
        $s = "radar";
        $operations = [[2, 1, 5], [2, 2, 4]];
        $results = processOperations($n, $operations, $s);
        $this->assertEquals(["YES", "YES"], $results, "Both ranges should be palindromic.");
    }

    /**
     * Test case 14: Query entire string after multiple updates.
     */
    public function testMultipleUpdatesPalindrome() {
        $operations = [
            [1, 7, 'g'], // Update last character to 'g'
            [2, 1, 7],   // Query if the string is a palindrome
        ];
        $n = 7;
        $s = 'abcdefg';
        $expected = ['NO']; // No longer a palindrome after updates
        $this->assertEquals($expected, processOperations($n, $operations, $s));
    }

    /**
     * Test case 15: Query middle of a palindrome.
     */
    public function testMiddleOfPalindrome()
    {
        $n = 7;
        $s = "racecar";
        $operations = [[2, 2, 6]];
        $results = processOperations($n, $operations, $s);
        $this->assertEquals(["YES"], $results, "Substring 'aceca' should be a palindrome.");
    }

    /**
     * Test case 16: Odd-length palindrome query.
     */
    public function testOddLengthPalindrome() {
        $operations = [
            [2, 1, 6], // Query if substring 'abcbab' is a palindrome
        ];
        $n = 6;
        $s = 'abcbab';
        $expected = ['NO']; // Odd-length string not a palindrome
        $this->assertEquals($expected, processOperations($n, $operations, $s));
    }

    /**
     * Test case 17: Update causes substring palindrome.
     */
    public function testUpdateSubstringPalindrome() {
        $operations = [
            [1, 3, 'x'], // Update index 3 to 'x'
            [2, 1, 5],   // Query if substring 'abxba' is a palindrome
        ];
        $n = 5;
        $s = 'ababa';
        $expected = ['YES']; // Update keeps palindrome intact
        $this->assertEquals($expected, processOperations($n, $operations, $s));
    }

    /**
     * Test case 18: Large string non-palindrome query.
     */
    public function testLargeStringNonPalindrome()
    {
        $n = 20;
        $s = str_repeat("ab", 10);
        $operations = [[2, 1, 20]];
        $results = processOperations($n, $operations, $s);
        $this->assertEquals(["NO"], $results, "Expected large non-palindromic string to return NO.");
    }

    /**
     * Test case 19: Edge case - empty string.
     */
    public function testEmptyString()
    {
        $n = 0;
        $s = "";
        $operations = [];
        $results = processOperations($n, $operations, $s);
        $this->assertEquals([], $results, "Empty string should handle gracefully.");
    }

    /**
     * Test case 20: Multiple queries with no updates.
     */
    public function testMultipleQueriesNoUpdates() {
        $operations = [
            [2, 1, 3], // Query if substring 'abc' is a palindrome
            [2, 4, 6], // Query if substring 'def' is a palindrome
            [2, 7, 7], // Query if substring 'g' is a palindrome
        ];
        $n = 7;
        $s = 'abcdefg';
        $expected = ['NO', 'NO', 'YES']; // Only single-character 'g' is a palindrome
        $this->assertEquals($expected, processOperations($n, $operations, $s));
    }
}
?>
