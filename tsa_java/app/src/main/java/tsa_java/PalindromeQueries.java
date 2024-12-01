package tsa_java;

import java.util.*;

public class PalindromeQueries {
    // Define HASH and MOD constants
    static final long HASH = 257;
    static final long MOD = 1000000007;

    // Length of the string and number of operations
    static int n, m;

    // Array to store powers of HASH
    static long[] hashPower = new long[200005];

    // Forward hash table
    static long[] fwdHashTable = new long[400005];

    // Backward hash table
    static long[] bckHashTable = new long[400005];

    // Function to update the hash value at position i in the forward hash table
    static void updatefwd(int i, long v) {
        // YOUR CODE HERE
    }

    // Function to query the hash value from position l to r in the forward hash table
    static long queryfwd(int l, int r) {
        // YOUR CODE HERE
        return res;
    }

    // Function to update the hash value at position i in the backward hash table
    static void updatebck(int i, long v) {
        // YOUR CODE HERE
    }

    // Function to query the hash value from position l to r in the backward hash table
    static long querybck(int l, int r) {
        // YOUR CODE HERE
        return res;
    }

    public static void main(String[] args) {
        n = 7;
        m = 5;
        String s = "aybabtu";

        // YOUR CODE HERE