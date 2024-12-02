import 'package:tsa_dart/tower_of_hanoi.dart';
import 'package:test/test.dart';

void main() {
  group('Tower of Hanoi Tests', () {
    test('Tes1: Tower of Hanoi with 1 disk', () {
      final List<List<int>> moves = [];
      moveDisk(1, moves, 1, 3, 2);
      expect(moves, equals([[1, 3]]));
    });

    test('Tower of Hanoi with 2 disks', () {
      final List<List<int>> moves = [];
      moveDisk(2, moves, 1, 3, 2);
      expect(moves, equals([
        [1, 2],
        [1, 3],
        [2, 3],
      ]));
    });

    test('Tower of Hanoi with 3 disks', () {
      final List<List<int>> moves = [];
      moveDisk(3, moves, 1, 3, 2);
      expect(moves, equals([
        [1, 3],
        [1, 2],
        [3, 2],
        [1, 3],
        [2, 1],
        [2, 3],
        [1, 3],
      ]));
    });

    test('Tower of Hanoi with 4 disks', () {
      final List<List<int>> moves = [];
      moveDisk(4, moves, 1, 3, 2);
      expect(moves.length, equals(15));
    });

    test('Total moves for 1 disk', () {
      final List<List<int>> moves = [];
      moveDisk(1, moves, 1, 3, 2);
      expect(moves.length, equals(1));
    });

    test('Total moves for 2 disks', () {
      final List<List<int>> moves = [];
      moveDisk(2, moves, 1, 3, 2);
      expect(moves.length, equals(3));
    });

    test('Total moves for 3 disks', () {
      final List<List<int>> moves = [];
      moveDisk(3, moves, 1, 3, 2);
      expect(moves.length, equals(7));
    });

    test('Total moves for 4 disks', () {
      final List<List<int>> moves = [];
      moveDisk(4, moves, 1, 3, 2);
      expect(moves.length, equals(15));
    });

    test('Correct destination for 1 disk', () {
      final List<List<int>> moves = [];
      moveDisk(1, moves, 1, 3, 2);
      expect(moves.last, equals([1, 3]));
    });

    test('Correct destination for 2 disks', () {
      final List<List<int>> moves = [];
      moveDisk(2, moves, 1, 3, 2);
      expect(moves.last, equals([2, 3]));
    });

    test('Correct intermediate step for 3 disks', () {
      final List<List<int>> moves = [];
      moveDisk(3, moves, 1, 3, 2);
      expect(moves[3], equals([1, 3]));
    });

    test('Tower of Hanoi with 5 disks', () {
      final List<List<int>> moves = [];
      moveDisk(5, moves, 1, 3, 2);
      expect(moves.length, equals(31));
    });

    test('Verify move ordering for 3 disks', () {
      final List<List<int>> moves = [];
      moveDisk(3, moves, 1, 3, 2);
      expect(moves[0], equals([1, 3]));
      expect(moves[1], equals([1, 2]));
      expect(moves[2], equals([3, 2]));
    });

    test('Verify last move for 3 disks', () {
      final List<List<int>> moves = [];
      moveDisk(3, moves, 1, 3, 2);
      expect(moves.last, equals([1, 3]));
    });

    test('Correct auxiliary usage for 2 disks', () {
      final List<List<int>> moves = [];
      moveDisk(2, moves, 1, 3, 2);
      final usesAuxiliary = moves.any((move) => move.contains(2));
      expect(usesAuxiliary, isTrue);
    });

    test('Correct auxiliary usage for 3 disks', () {
      final List<List<int>> moves = [];
      moveDisk(3, moves, 1, 3, 2);
      final usesAuxiliary = moves.any((move) => move.contains(2));
      expect(usesAuxiliary, isTrue);
    });

    test('Number of steps for 6 disks', () {
      final List<List<int>> moves = [];
      moveDisk(6, moves, 1, 3, 2);
      expect(moves.length, equals(63));
    });

    test('Single disk, no move required', () {
      final List<List<int>> moves = [];
      moveDisk(1, moves, 1, 1, 2); // Source and destination are the same
      expect(moves, isEmpty); // No moves should occur
    });

    test('Verify move structure', () {
      final List<List<int>> moves = [];
      moveDisk(3, moves, 1, 3, 2);
      for (final move in moves) {
        expect(move.length, equals(2));
        expect(move[0], inInclusiveRange(1, 3));
        expect(move[1], inInclusiveRange(1, 3));
      }
    });

    test('Correct behavior with larger disks (7)', () {
      final List<List<int>> moves = [];
      moveDisk(7, moves, 1, 3, 2);
      expect(moves.length, equals(127));
    });
  });
}
