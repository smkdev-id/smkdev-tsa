class PalindromeQueries {
  static const int HASH = 257;
  static const int MOD = 1000000007;

  late int n, m;
  List<int> hashPower = List.filled(200005, 0);
  List<int> fwdHashTable = List.filled(400005, 0);
  List<int> bckHashTable = List.filled(400005, 0);

  void updateFwd(int i, int v) {
    // YOUR CODE HERE
  }

  int queryFwd(int l, int r) {
    // YOUR CODE HERE
    return res;
  }

  void updateBck(int i, int v) {
    // YOUR CODE HERE
  }

  int queryBck(int l, int r) {
    // YOUR CODE HERE
    return res;
  }

  void run() {
    n = 7;
    m = 5;
    String s = "aybabtu";
    List<List<int>> operations = [
      [2, 3, 5],
      [1, 3, 'x'.codeUnitAt(0)],
      [2, 3, 5],
      [1, 5, 'x'.codeUnitAt(0)],
      [2, 3, 5]
    ];

    // YOUR CODE HERE
  }
}