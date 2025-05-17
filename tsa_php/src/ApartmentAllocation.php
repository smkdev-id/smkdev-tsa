<?php

function solveApartment($A, $B, $N, $M, $K) {
    /**
     * @param array $A - Array of integers representing the minimum apartment sizes each applicant desires.
     * @param array $B - Array of integers representing the sizes of available apartments.
     * @param int $N - Number of applicants (length of array A).
     * @param int $M - Number of available apartments (length of array B).
     * @param int $K - Maximum allowable size difference for a valid match.
     * @return int - Maximum number of apartments that can be allocated to applicants.
     */

    // YOUR CODE HERE
    <?php

function allocateApartments() {
    // Prompt user for inputs
    echo "Enter number of applicants (n): ";
    $n = (int)trim(fgets(STDIN));

    echo "Enter number of apartments (m): ";
    $m = (int)trim(fgets(STDIN));

    echo "Enter maximum allowed difference (k): ";
    $k = (int)trim(fgets(STDIN));

    echo "Enter desired apartment sizes for $n applicants (space-separated):\n";
    $a = array_map('intval', explode(' ', trim(fgets(STDIN))));

    echo "Enter available apartment sizes for $m apartments (space-separated):\n";
    $b = array_map('intval', explode(' ', trim(fgets(STDIN))));

    // Sort both arrays
    sort($a);
    sort($b);

    $i = 0;
    $j = 0;
    $count = 0;

    while ($i < $n && $j < $m) {
        if (abs($a[$i] - $b[$j]) <= $k) {
            $count++;
            $i++;
            $j++;
        } elseif ($b[$j] < $a[$i] - $k) {
            $j++;
        } else {
            $i++;
        }
    }

    echo "Number of applicants who got an apartment: $count\n";
}

allocateApartments();

    return $matches;
}