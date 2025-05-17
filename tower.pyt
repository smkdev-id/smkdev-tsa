def tower_of_hanoi(n, source=1, target=3, auxiliary=2, moves=None):
    if moves is None:
        moves = []
    if n == 1:
        moves.append((source, target))
    else:
        tower_of_hanoi(n-1, source, auxiliary, target, moves)
        moves.append((source, target))
        tower_of_hanoi(n-1, auxiliary, target, source, moves)
    return moves

# Contoh penggunaan
n = 2
moves = tower_of_hanoi(n)
print(len(moves))
for move in moves:
    print(move[0], move[1])
