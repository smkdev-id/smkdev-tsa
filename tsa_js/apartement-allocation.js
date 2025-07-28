function solveApartement(A, B, N, M, K) {
    /**
        * @param {number[]} A - Array of integers representing the minimum apartment sizes each applicant desires.
        * @param {number[]} B - Array of integers representing the sizes of available apartments.
        * @param {number} N - Number of applicants (length of array A).
        * @param {number} M - Number of available apartments (length of array B).
        * @param {number} K - Maximum allowable size difference for a valid match.
        * @returns {number} - Maximum number of apartments that can be allocated to applicants.
    */
    let aplicantIdx = 0;
    let availableIdx = 0;
    let ans = 0;
    while (aplicantIdx < A.length && availableIdx < B.length) {
        if (Math.abs(A[aplicantIdx] - B[availableIdx]) <= K) {
            aplicantIdx++;
            availableIdx++;
            ans++;

        } else if (A[aplicantIdx] < B[availableIdx]) {
            aplicantIdx++;

        } else {
            availableIdx++;

        }

    }
    return ans;
}

module.exports = { solveApartement };
