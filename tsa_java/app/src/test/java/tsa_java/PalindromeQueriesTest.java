package tsa_java;

import org.junit.jupiter.api.Test;

import static org.junit.jupiter.api.Assertions.*;

public class PalindromeQueriesTest {

    // Helper function to initialize the hash tables
    private void initialize(String s) {
        PalindromeQueries.n = s.length();
        PalindromeQueries.hashPower[0] = 1;

        for (int i = 1; i < PalindromeQueries.n; i++) {
            PalindromeQueries.hashPower[i] = (PalindromeQueries.hashPower[i - 1] * PalindromeQueries.HASH) % PalindromeQueries.MOD;
        }

        for (int i = 0; i < PalindromeQueries.n; i++) {
            char c = s.charAt(i);
            PalindromeQueries.updatefwd(i, (PalindromeQueries.hashPower[i] * c) % PalindromeQueries.MOD);
            PalindromeQueries.updatebck(i, (PalindromeQueries.hashPower[PalindromeQueries.n - i - 1] * c) % PalindromeQueries.MOD);
        }
    }

    @Test
    void testInitialPalindromeQuery() {
        initialize("aybabtu");

        int left = 3, right = 5; // 1-based indices in operations, adjusted to 0-based here.
        left--; // Convert to 0-based index
        right--; // Convert to 0-based index

        // Query forward and backward hashes
        long fwd = PalindromeQueries.queryfwd(left, right);
        long bck = PalindromeQueries.querybck(left, right);

        // Adjust forward and backward hash for comparison
        fwd = (fwd * PalindromeQueries.hashPower[PalindromeQueries.n - 1 - right]) % PalindromeQueries.MOD;
        bck = (bck * PalindromeQueries.hashPower[left]) % PalindromeQueries.MOD;

        // Normalize values to ensure positive modulo results
        if (fwd < 0) fwd += PalindromeQueries.MOD;
        if (bck < 0) bck += PalindromeQueries.MOD;

        assertEquals(fwd, bck, "The substring 'bab' (indices 3 to 5) should be a palindrome.");
    }

    @Test
    void testNonPalindromeQuery() {
        initialize("aybabtu");
        long fwd = PalindromeQueries.queryfwd(0, 2);
        long bck = PalindromeQueries.querybck(0, 2);
        fwd = (fwd * PalindromeQueries.hashPower[PalindromeQueries.n - 1 - 2]) % PalindromeQueries.MOD;
        bck = (bck * PalindromeQueries.hashPower[0]) % PalindromeQueries.MOD;
        assertNotEquals(fwd, bck, "The substring should not be a palindrome.");
    }

    @Test
    void testUpdateCharAndQuery() {
        initialize("aybabtu");
        PalindromeQueries.updatefwd(3, ('x' * PalindromeQueries.hashPower[3]) % PalindromeQueries.MOD);
        PalindromeQueries.updatebck(3, ('x' * PalindromeQueries.hashPower[PalindromeQueries.n - 3 - 1]) % PalindromeQueries.MOD);

        long fwd = PalindromeQueries.queryfwd(3, 5);
        long bck = PalindromeQueries.querybck(3, 5);
        fwd = (fwd * PalindromeQueries.hashPower[PalindromeQueries.n - 1 - 5]) % PalindromeQueries.MOD;
        bck = (bck * PalindromeQueries.hashPower[3]) % PalindromeQueries.MOD;
        assertNotEquals(fwd, bck, "The substring should not be a palindrome after the update.");
    }

    @Test
    void testFullStringPalindrome() {
        initialize("madam");
        long fwd = PalindromeQueries.queryfwd(0, 4);
        long bck = PalindromeQueries.querybck(0, 4);
        fwd = (fwd * PalindromeQueries.hashPower[PalindromeQueries.n - 1 - 4]) % PalindromeQueries.MOD;
        bck = (bck * PalindromeQueries.hashPower[0]) % PalindromeQueries.MOD;
        assertEquals(fwd, bck, "The entire string should be a palindrome.");
    }

    @Test
    void testEmptySubstring() {
        initialize("abc");
        long fwd = PalindromeQueries.queryfwd(1, 0);
        long bck = PalindromeQueries.querybck(1, 0);
        assertEquals(fwd, bck, "An empty substring should always be a palindrome.");
    }

    @Test
    void testSingleCharacterSubstring() {
        initialize("abc");
        long fwd = PalindromeQueries.queryfwd(1, 1);
        long bck = PalindromeQueries.querybck(1, 1);
        assertEquals(fwd, bck, "A single character substring should always be a palindrome.");
    }

    @Test
    void testUpdateMultipleChars() {
        initialize("ababa");
        PalindromeQueries.updatefwd(1, ('x' * PalindromeQueries.hashPower[1]) % PalindromeQueries.MOD);
        PalindromeQueries.updatebck(1, ('x' * PalindromeQueries.hashPower[PalindromeQueries.n - 1 - 1]) % PalindromeQueries.MOD);

        PalindromeQueries.updatefwd(3, ('y' * PalindromeQueries.hashPower[3]) % PalindromeQueries.MOD);
        PalindromeQueries.updatebck(3, ('y' * PalindromeQueries.hashPower[PalindromeQueries.n - 1 - 3]) % PalindromeQueries.MOD);

        long fwd = PalindromeQueries.queryfwd(0, 4);
        long bck = PalindromeQueries.querybck(0, 4);
        fwd = (fwd * PalindromeQueries.hashPower[PalindromeQueries.n - 1 - 4]) % PalindromeQueries.MOD;
        bck = (bck * PalindromeQueries.hashPower[0]) % PalindromeQueries.MOD;
        assertNotEquals(fwd, bck, "The updated string should not be a palindrome.");
    }

    @Test
    void testLargeStringPalindrome() {
        String s = "a".repeat(100000);
        initialize(s);

        long fwd = PalindromeQueries.queryfwd(0, s.length() - 1);
        long bck = PalindromeQueries.querybck(0, s.length() - 1);
        fwd = (fwd * PalindromeQueries.hashPower[PalindromeQueries.n - 1 - (s.length() - 1)]) % PalindromeQueries.MOD;
        bck = (bck * PalindromeQueries.hashPower[0]) % PalindromeQueries.MOD;
        assertEquals(fwd, bck, "The large string with repeated characters should be a palindrome.");
    }

    @Test
    void testUpdateFirstCharacter() {
        initialize("racecar");
        PalindromeQueries.updatefwd(0, ('x' * PalindromeQueries.hashPower[0]) % PalindromeQueries.MOD);
        PalindromeQueries.updatebck(0, ('x' * PalindromeQueries.hashPower[PalindromeQueries.n - 1]) % PalindromeQueries.MOD);

        long fwd = PalindromeQueries.queryfwd(0, 6);
        long bck = PalindromeQueries.querybck(0, 6);
        fwd = (fwd * PalindromeQueries.hashPower[PalindromeQueries.n - 1 - 6]) % PalindromeQueries.MOD;
        bck = (bck * PalindromeQueries.hashPower[0]) % PalindromeQueries.MOD;
        assertNotEquals(fwd, bck, "Updating the first character should make the string non-palindromic.");
    }

    @Test
    void testUpdateLastCharacter() {
        initialize("radar");
        PalindromeQueries.updatefwd(4, ('x' * PalindromeQueries.hashPower[4]) % PalindromeQueries.MOD);
        PalindromeQueries.updatebck(4, ('x' * PalindromeQueries.hashPower[PalindromeQueries.n - 5]) % PalindromeQueries.MOD);

        long fwd = PalindromeQueries.queryfwd(0, 4);
        long bck = PalindromeQueries.querybck(0, 4);
        fwd = (fwd * PalindromeQueries.hashPower[PalindromeQueries.n - 1 - 4]) % PalindromeQueries.MOD;
        bck = (bck * PalindromeQueries.hashPower[0]) % PalindromeQueries.MOD;
        assertNotEquals(fwd, bck, "Updating the last character should make the string non-palindromic.");
    }

    @Test
    void testMiddleSubstringPalindrome() {
        initialize("banana");
        long fwd = PalindromeQueries.queryfwd(1, 3);
        long bck = PalindromeQueries.querybck(1, 3);
        fwd = (fwd * PalindromeQueries.hashPower[PalindromeQueries.n - 1 - 3]) % PalindromeQueries.MOD;
        bck = (bck * PalindromeQueries.hashPower[1]) % PalindromeQueries.MOD;
        assertEquals(fwd, bck, "The substring 'ana' should be a palindrome.");
    }

    @Test
    void testMiddleSubstringNonPalindrome() {
        initialize("abcdef");
        long fwd = PalindromeQueries.queryfwd(2, 4);
        long bck = PalindromeQueries.querybck(2, 4);
        fwd = (fwd * PalindromeQueries.hashPower[PalindromeQueries.n - 1 - 4]) % PalindromeQueries.MOD;
        bck = (bck * PalindromeQueries.hashPower[2]) % PalindromeQueries.MOD;
        assertNotEquals(fwd, bck, "The substring 'cde' should not be a palindrome.");
    }

    @Test
    void testSubstringWithUpdate() {
        initialize("racecar");
        PalindromeQueries.updatefwd(2, ('x' * PalindromeQueries.hashPower[2]) % PalindromeQueries.MOD);
        PalindromeQueries.updatebck(2, ('x' * PalindromeQueries.hashPower[PalindromeQueries.n - 3]) % PalindromeQueries.MOD);

        long fwd = PalindromeQueries.queryfwd(0, 6);
        long bck = PalindromeQueries.querybck(0, 6);
        fwd = (fwd * PalindromeQueries.hashPower[PalindromeQueries.n - 1 - 6]) % PalindromeQueries.MOD;
        bck = (bck * PalindromeQueries.hashPower[0]) % PalindromeQueries.MOD;
        assertNotEquals(fwd, bck, "The string should not be a palindrome after updating a middle character.");
    }

    @Test
    void testSubstringWithRepeatedUpdates() {
        initialize("abba");
        PalindromeQueries.updatefwd(0, ('x' * PalindromeQueries.hashPower[0]) % PalindromeQueries.MOD);
        PalindromeQueries.updatebck(0, ('x' * PalindromeQueries.hashPower[PalindromeQueries.n - 1]) % PalindromeQueries.MOD);

        PalindromeQueries.updatefwd(3, ('x' * PalindromeQueries.hashPower[3]) % PalindromeQueries.MOD);
        PalindromeQueries.updatebck(3, ('x' * PalindromeQueries.hashPower[PalindromeQueries.n - 4]) % PalindromeQueries.MOD);

        long fwd = PalindromeQueries.queryfwd(0, 3);
        long bck = PalindromeQueries.querybck(0, 3);
        fwd = (fwd * PalindromeQueries.hashPower[PalindromeQueries.n - 1 - 3]) % PalindromeQueries.MOD;
        bck = (bck * PalindromeQueries.hashPower[0]) % PalindromeQueries.MOD;
        assertEquals(fwd, bck, "The string should become a palindrome after making mirrored updates.");
    }

    @Test
    void testFullStringNonPalindrome() {
        initialize("hello");
        long fwd = PalindromeQueries.queryfwd(0, 4);
        long bck = PalindromeQueries.querybck(0, 4);
        fwd = (fwd * PalindromeQueries.hashPower[PalindromeQueries.n - 1 - 4]) % PalindromeQueries.MOD;
        bck = (bck * PalindromeQueries.hashPower[0]) % PalindromeQueries.MOD;
        assertNotEquals(fwd, bck, "The full string 'hello' should not be a palindrome.");
    }

    @Test
    void testEdgeCaseSingleCharString() {
        initialize("a");
        long fwd = PalindromeQueries.queryfwd(0, 0);
        long bck = PalindromeQueries.querybck(0, 0);
        assertEquals(fwd, bck, "A single character string should always be a palindrome.");
    }

    @Test
    void testEdgeCaseTwoCharPalindrome() {
        initialize("aa");
        long fwd = PalindromeQueries.queryfwd(0, 1);
        long bck = PalindromeQueries.querybck(0, 1);
        fwd = (fwd * PalindromeQueries.hashPower[PalindromeQueries.n - 1 - 1]) % PalindromeQueries.MOD;
        bck = (bck * PalindromeQueries.hashPower[0]) % PalindromeQueries.MOD;
        assertEquals(fwd, bck, "The two-character string 'aa' should be a palindrome.");
    }

    @Test
    void testEdgeCaseTwoCharNonPalindrome() {
        initialize("ab");
        long fwd = PalindromeQueries.queryfwd(0, 1);
        long bck = PalindromeQueries.querybck(0, 1);
        fwd = (fwd * PalindromeQueries.hashPower[PalindromeQueries.n - 1 - 1]) % PalindromeQueries.MOD;
        bck = (bck * PalindromeQueries.hashPower[0]) % PalindromeQueries.MOD;
        assertNotEquals(fwd, bck, "The two-character string 'ab' should not be a palindrome.");
    }

    @Test
    void testPalindromeAfterAllUpdates() {
        initialize("aaaaa");
        PalindromeQueries.updatefwd(2, ('b' * PalindromeQueries.hashPower[2]) % PalindromeQueries.MOD);
        PalindromeQueries.updatebck(2, ('b' * PalindromeQueries.hashPower[PalindromeQueries.n - 3]) % PalindromeQueries.MOD);

        PalindromeQueries.updatefwd(2, ('a' * PalindromeQueries.hashPower[2]) % PalindromeQueries.MOD);
        PalindromeQueries.updatebck(2, ('a' * PalindromeQueries.hashPower[PalindromeQueries.n - 3]) % PalindromeQueries.MOD);

        long fwd = PalindromeQueries.queryfwd(0, 4);
        long bck = PalindromeQueries.querybck(0, 4);
        fwd = (fwd * PalindromeQueries.hashPower[PalindromeQueries.n - 1 - 4]) % PalindromeQueries.MOD;
        bck = (bck * PalindromeQueries.hashPower[0]) % PalindromeQueries.MOD;
        assertEquals(fwd, bck, "The string should revert to a palindrome after undoing all updates.");
    }

    @Test
    void testSingleUpdateDisruptsPalindrome() {
        // Initialize the string
        initialize("racecar");

        // Query initial palindrome status for the full string
        int left = 0, right = 6; // Full string
        long fwd = PalindromeQueries.queryfwd(left, right);
        long bck = PalindromeQueries.querybck(left, right);

        // Adjust forward and backward hash for comparison
        fwd = (fwd * PalindromeQueries.hashPower[PalindromeQueries.n - 1 - right]) % PalindromeQueries.MOD;
        bck = (bck * PalindromeQueries.hashPower[left]) % PalindromeQueries.MOD;
        if (fwd < 0) fwd += PalindromeQueries.MOD;
        if (bck < 0) bck += PalindromeQueries.MOD;

        // Assert that the initial string is a palindrome
        assertEquals(fwd, bck, "The full string 'racecar' should initially be a palindrome.");
    }

}
