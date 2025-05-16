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


     function solveApartment(array $A, array $B, int $N, int $M, int $K): int {
         if ($K < 0) return 0;
     
         sort($A);
         sort($B);
     
         $i = 0;
         $j = 0;
         $count = 0;
     
         while ($i < $N && $j < $M) {
             if (abs($A[$i] - $B[$j]) <= $K) {
                 $count++;
                 $i++;
                 $j++;
             } elseif ($B[$j] < $A[$i] - $K) {
                 $j++;
             } else {
                 $i++;
             }
         }
         return $count;
     }
     
     function allocateApartmentsInteractive() {
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
     
         $matches = solveApartment($a, $b, $n, $m, $k);
     
         echo "Number of applicants who got an apartment: $matches\n";
     }
     
     if (php_sapi_name() === 'cli' && basename(__FILE__) === basename($_SERVER['PHP_SELF'])) {
         allocateApartmentsInteractive();
     }
     

}