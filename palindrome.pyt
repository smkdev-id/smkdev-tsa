def process_palindrome_queries(n, m, s, operations):
    from bisect import bisect_left

    s = list(s)

    result = []
    for op in operations:
        parts = op.split()
        if parts[0] == '1':
            _, k, x = parts
            s[int(k) - 1] = x
        elif parts[0] == '2':
            _, a, b = parts
            a, b = int(a) - 1, int(b) - 1
            substring = s[a:b+1]
            result.append('1' if substring == substring[::-1] else '0')
    return result

# Contoh penggunaan
n, m = 7, 5
s = "aybabtu"
operations = [
    "2 3 5",
    "1 3 x",
    "2 3 5",
    "1 5 x",
    "2 3 5"
]
results = process_palindrome_queries(n, m, s, operations)
print("\n".join(results))  # Output: 1 0 1
