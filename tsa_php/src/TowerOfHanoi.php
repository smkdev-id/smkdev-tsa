<?php

define('HASH', 257);
define('MOD', 1000000007);

class HashSegmentTree {
    private $n;
    private $tree;

    /**
     * Initializes a segment tree for storing hash values.
     * @param int $n The size of the input string.
     */
    public function __construct($n) {
        $this->n = $n;
        $this->tree = array_fill(0, 2 * $n, 0);
    }

    /**
     * Updates the segment tree at a specific index with a new value.
     * @param int $index The index in the original array (0-based).
     * @param int $value The value to update at the specified index.
     */
    public function update($index, $value) {
        $index += $this->n;
        $this->tree[$index] = $value;
        while ($index > 1) {
            $index >>= 1;
            $this->tree[$index] = ($this->tree[$index * 2] + $this->tree[$index * 2 + 1]) % MOD;
        }
    }

    /**
     * Queries the segment tree for the sum of values in a given range.
     * @param int $l The starting index of the range (0-based).
     * @param int $r The ending index of the range (0-based).
     * @return int The sum of values in the range [l, r].
     */
    public function query($l, $r) {
        $l += $this->n;
        $r += $this->n + 1;
        $result = 0;
        while ($l < $r) {
            if ($l % 2 == 1) $result = ($result + $this->tree[$l++]) % MOD;
            if ($r % 2 == 1) $result = ($result + $this->tree[--$r]) % MOD;
            $l >>= 1;
            $r >>= 1;
        }
        return $result;
    }
}

/**
 * Initializes hash powers for a given string length.
 * @param int $length The length of the input string.
 * @return array An array where hashPower[i] = HASH^i % MOD.
 */
function initializeHashPowers($length) {
    $hashPower = [1];
    for ($i = 1; $i <= $length; $i++) {
        $hashPower[$i] = ($hashPower[$i - 1] * HASH) % MOD;
    }
    return $hashPower;
}

/**
 * Initializes the forward and backward hash segment trees for a given string.
 * @param int $n The length of the input string.
 * @param string $s The input string.
 * @param array $hashPower Precomputed hash powers for the string.
 * @return array An associative array containing the forward and backward hash segment trees.
 */
function initializeHashTables($n, $s, $hashPower) {
    $fwdHash = new HashSegmentTree($n);
    $bckHash = new HashSegmentTree($n);

    for ($i = 0; $i < $n; $i++) {
        $val = (ord($s[$i]) * $hashPower[$i]) % MOD;
        $fwdHash->update($i, $val);

        $revVal = (ord($s[$i]) * $hashPower[$n - 1 - $i]) % MOD;
        $bckHash->update($n - 1 - $i, $revVal);
    }

    return ['fwdHash' => $fwdHash, 'bckHash' => $bckHash];
}

/**
 * Processes a list of operations on the input string and returns the results.
 * @param int $n The length of the input string.
 * @param array $operations A list of operations to perform.
 * @param string $s The input string.
 * @return array An array of results for palindrome queries ("YES" or "NO").
 */
function processOperations($n, $operations, $s) {
    $hashPower = initializeHashPowers($n);
    $trees = initializeHashTables($n, $s, $hashPower);
    $fwd = $trees['fwdHash'];
    $bck = $trees['bckHash'];
    $sArr = str_split($s);
    $results = [];

    foreach ($operations as $op) {
        if ($op[0] == 1) {
            // Update operation
            $k = $op[1] - 1;
            $x = $op[2];
            $sArr[$k] = $x;
            $fwd->update($k, (ord($x) * $hashPower[$k]) % MOD);
            $bck->update($n - 1 - $k, (ord($x) * $hashPower[$n - 1 - $k]) % MOD);
        } else if ($op[0] == 2) {
            // Query operation
            $a = $op[1] - 1;
            $b = $op[2] - 1;
            $fwdHash = $fwd->query($a, $b);
            $bckHash = $bck->query($n - 1 - $b, $n - 1 - $a);

            if ($a <= $b) {
                $leftShift = $n - 1 - $b - $a;
                $fwdHash = ($fwdHash * $hashPower[$leftShift]) % MOD;
            }

            $results[] = ($fwdHash == $bckHash) ? "YES" : "NO";
        }
    }

    return $results;
}

// Read input
fscanf(STDIN, "%d %d", $n, $m);
$s = trim(fgets(STDIN));

// Read m operations
$operations = [];
for ($i = 0; $i < $m; $i++) {
    $line = explode(' ', trim(fgets(STDIN)));
    $type = (int)$line[0];
    if ($type == 1) {
        $operations[] = [1, (int)$line[1], $line[2]];
    } else {
        $operations[] = [2, (int)$line[1], (int)$line[2]];
    }
}

// Process and print results
$results = processOperations($n, $operations, $s);
foreach ($results as $res) {
    echo $res . "\n";
}
?>