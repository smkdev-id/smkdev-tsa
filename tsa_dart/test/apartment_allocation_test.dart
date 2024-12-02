import 'package:test/test.dart';
import '../lib/apartment_allocation.dart';

void main() {
  group('Apartment Allotment Tests', () {
    test('Basic functionality with small arrays', () {
      expect(solve([60, 45], [30, 60], 2, 2, 5), 1);
    });

    test('Exact match for all applicants and apartments', () {
      expect(solve([40, 50, 60], [40, 50, 60], 3, 3, 0), 3);
    });

    test('No possible matches', () {
      expect(solve([10, 20, 30], [40, 50, 60], 3, 3, 5), 0);
    });

    test('All applicants have larger demands than apartments', () {
      expect(solve([70, 80, 90], [10, 20, 30], 3, 3, 10), 0);
    });

    test('All apartments are smaller but within tolerance', () {
      expect(solve([70, 80, 90], [60, 70, 80], 3, 3, 10), 3);
    });

    test('Single applicant and apartment, within tolerance', () {
      expect(solve([50], [55], 1, 1, 5), 1);
    });

    test('Single applicant and apartment, out of tolerance', () {
      expect(solve([50], [70], 1, 1, 5), 0);
    });

    test('Large arrays with no matches', () {
      expect(solve(
          List.generate(1000, (i) => i * 2),
          List.generate(1000, (i) => i * 2 + 1),
          1000, 1000, 0), 0);
    });

    test('Large arrays with all matches', () {
      expect(solve(
          List.generate(1000, (i) => i * 2),
          List.generate(1000, (i) => i * 2),
          1000, 1000, 0), 1000);
    });

    test('Random numbers, some matches within tolerance', () {
      expect(solve([30, 40, 60], [35, 45, 50], 3, 3, 10), 3);
    });

    test('Unequal array sizes, fewer applicants', () {
      expect(solve([30, 40], [35, 45, 50], 2, 3, 10), 2);
    });

    test('Unequal array sizes, fewer apartments', () {
      expect(solve([30, 40, 50], [35, 45], 3, 2, 10), 2);
    });

    test('Tolerance is zero', () {
      expect(solve([30, 40, 50], [30, 40, 50], 3, 3, 0), 3);
    });

    test('Tolerance is very high', () {
      expect(solve([10, 20, 30], [70, 80, 90], 3, 3, 100), 3);
    });

    test('Duplicates in applicant and apartment arrays', () {
      expect(solve([30, 30, 40], [30, 30, 40], 3, 3, 0), 3);
    });

    test('Single match in a larger dataset', () {
      expect(solve([10, 20, 30, 40], [100, 200, 30], 4, 3, 0), 1);
    });

    test('Empty applicant array', () {
      expect(solve([], [10, 20, 30], 0, 3, 5), 0);
    });

    test('Empty apartment array', () {
      expect(solve([10, 20, 30], [], 3, 0, 5), 0);
    });

    test('Both arrays empty', () {
      expect(solve([], [], 0, 0, 5), 0);
    });

    test('Negative numbers with positive tolerance', () {
      expect(solve([-10, -20, -30], [-15, -25, -35], 3, 3, 5), 3);
    });
  });
}
