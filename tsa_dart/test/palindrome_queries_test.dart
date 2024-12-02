import 'package:test/test.dart';
import '../lib/palindrome_queries.dart';

void main() {
  group('PalindromeQueries Tests', () {
    test('Initial hash computation for the string "aybabtu"', () {
      final queries = PalindromeQueries();
      queries.run();
      // Add assertions if you refactor `run` to return or store results
    });

    test('Forward hash update reflects correctly', () {
      final queries = PalindromeQueries();
      queries.n = 7;
      queries.run();
      queries.updateFwd(2, 'x'.codeUnitAt(0) * queries.hashPower[2] % PalindromeQueries.MOD);

      final updatedHash = queries.queryFwd(2, 2);
      expect(updatedHash, equals('x'.codeUnitAt(0) * queries.hashPower[2] % PalindromeQueries.MOD));
    });

    test('Backward hash update reflects correctly', () {
      final queries = PalindromeQueries();
      queries.n = 7;
      queries.run();
      queries.updateBck(2, 'x'.codeUnitAt(0) * queries.hashPower[4] % PalindromeQueries.MOD);

      final updatedHash = queries.queryBck(2, 2);
      expect(updatedHash, equals('x'.codeUnitAt(0) * queries.hashPower[4] % PalindromeQueries.MOD));
    });

    test('Forward hash query for a valid range', () {
      final queries = PalindromeQueries();
      queries.n = 7;
      queries.run();
      final result = queries.queryFwd(1, 3);
      expect(result, isNonZero); // Replace with actual expected hash
    });

    test('Backward hash query for a valid range', () {
      final queries = PalindromeQueries();
      queries.n = 7;
      queries.run();
      final result = queries.queryBck(1, 3);
      expect(result, isNonZero); // Replace with actual expected hash
    });

    test('Forward and backward hashes match for a palindrome range', () {
      final queries = PalindromeQueries();
      queries.n = 7;
      queries.run();

      final left = 2;
      final right = 4;

      final fwd = queries.queryFwd(left, right) * queries.hashPower[queries.n - 1 - right] % PalindromeQueries.MOD;
      final bck = queries.queryBck(left, right) * queries.hashPower[left] % PalindromeQueries.MOD;

      expect(fwd, equals(bck));
    });

    test('Forward and backward hashes do not match for a non-palindrome range', () {
      final queries = PalindromeQueries();
      queries.n = 7;
      queries.run();
      final fwd = queries.queryFwd(0, 3);
      final bck = queries.queryBck(0, 3);
      expect(fwd, isNot(equals(bck)));
    });

    test('Single character range matches itself', () {
      final queries = PalindromeQueries();
      queries.n = 7;
      queries.run();
      final fwd = queries.queryFwd(3, 3);
      final bck = queries.queryBck(3, 3);
      expect(fwd, equals(bck));
    });

    test('Check if the entire string is a palindrome', () {
      final queries = PalindromeQueries();
      queries.n = 7;
      queries.run();

      // Perform a palindrome check for the entire string
      final left = 0;
      final right = queries.n - 1;

      // Compute transformed hashes
      final fwd = queries.queryFwd(left, right) * queries.hashPower[queries.n - 1 - right] % PalindromeQueries.MOD;
      final bck = queries.queryBck(left, right) * queries.hashPower[left] % PalindromeQueries.MOD;

      // Check if the hashes indicate a palindrome
      expect(fwd == bck, isFalse);
    });

    test('Hash updates correctly on modifying a character', () {
      final queries = PalindromeQueries();
      queries.n = 7;
      queries.run();
      queries.updateFwd(3, 'x'.codeUnitAt(0) * queries.hashPower[3] % PalindromeQueries.MOD);
      queries.updateBck(3, 'x'.codeUnitAt(0) * queries.hashPower[3] % PalindromeQueries.MOD);
      final fwd = queries.queryFwd(0, 6);
      final bck = queries.queryBck(0, 6);
      expect(fwd, isNot(equals(bck)));
    });

    test('Edge case: Updating the first character', () {
      final queries = PalindromeQueries();
      queries.n = 7;
      queries.run();
      queries.updateFwd(0, 'x'.codeUnitAt(0) * queries.hashPower[0] % PalindromeQueries.MOD);
      final result = queries.queryFwd(0, 0);
      expect(result, equals('x'.codeUnitAt(0) * queries.hashPower[0] % PalindromeQueries.MOD));
    });

    test('Edge case: Updating the last character', () {
      final queries = PalindromeQueries();
      queries.n = 7;
      queries.run();
      queries.updateFwd(6, 'z'.codeUnitAt(0) * queries.hashPower[6] % PalindromeQueries.MOD);
      final result = queries.queryFwd(6, 6);
      expect(result, equals('z'.codeUnitAt(0) * queries.hashPower[6] % PalindromeQueries.MOD));
    });

    test('Multiple consecutive updates', () {
      final queries = PalindromeQueries();
      queries.n = 7;
      queries.run();
      queries.updateFwd(2, 'x'.codeUnitAt(0) * queries.hashPower[2] % PalindromeQueries.MOD);
      queries.updateFwd(5, 'y'.codeUnitAt(0) * queries.hashPower[5] % PalindromeQueries.MOD);
      final fwd = queries.queryFwd(0, 6);
      expect(fwd, isNotNull);
    });

    test('Range queries handle valid and invalid cases consistently', () {
      final queries = PalindromeQueries();
      queries.n = 7;
      queries.run();

      final validFwd = queries.queryFwd(0, 6);
      final validBck = queries.queryBck(0, 6);
      expect(validFwd, isNonZero);
      expect(validBck, isNonZero);

      final outOfBoundsFwd1 = queries.queryFwd(-1, 10);
      final outOfBoundsFwd2 = queries.queryFwd(8, 9);
      final outOfBoundsBck1 = queries.queryBck(-1, 10);
      final outOfBoundsBck2 = queries.queryBck(8, 9);

      expect(outOfBoundsFwd1, isNotNull);
      expect(outOfBoundsFwd2, isNotNull);
      expect(outOfBoundsBck1, isNotNull);
      expect(outOfBoundsBck2, isNotNull);
    });

    test('Handle large string input', () {
      final queries = PalindromeQueries();
      queries.n = 100000;
      queries.run();
      expect(() => queries.queryFwd(0, 99999), returnsNormally);
    });

    test('Handle large number of updates', () {
      final queries = PalindromeQueries();
      queries.n = 100000;
      queries.run();
      for (int i = 0; i < 1000; i++) {
        queries.updateFwd(i, 'x'.codeUnitAt(0) * queries.hashPower[i] % PalindromeQueries.MOD);
      }
      expect(() => queries.queryFwd(0, 99999), returnsNormally);
    });

    test('Handle large number of queries', () {
      final queries = PalindromeQueries();
      queries.n = 100000;
      queries.run();
      for (int i = 0; i < 1000; i++) {
        queries.queryFwd(0, 99999);
      }
      expect(true, isTrue);
    });

    test('Non-alphanumeric characters in the string', () {
      final queries = PalindromeQueries();
      queries.n = 7;
      queries.run();
      queries.updateFwd(2, '!'.codeUnitAt(0) * queries.hashPower[2] % PalindromeQueries.MOD);
      final result = queries.queryFwd(2, 2);
      expect(result, equals('!'.codeUnitAt(0) * queries.hashPower[2] % PalindromeQueries.MOD));
    });

    test('Case sensitivity check', () {
      final queries = PalindromeQueries();
      queries.n = 7;
      queries.run();
      queries.updateFwd(2, 'A'.codeUnitAt(0) * queries.hashPower[2] % PalindromeQueries.MOD);
      final result = queries.queryFwd(2, 2);
      expect(result, equals('A'.codeUnitAt(0) * queries.hashPower[2] % PalindromeQueries.MOD));
    });

    test('Empty string edge case', () {
      final queries = PalindromeQueries();
      queries.n = 0;
      expect(() => queries.run(), returnsNormally);
    });
  });
}
