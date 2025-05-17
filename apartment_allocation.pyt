def apartment_allocation(n, m, k, applicants, apartments):
    applicants.sort()
    apartments.sort()
    i = j = count = 0

    while i < n and j < m:
        if abs(applicants[i] - apartments[j]) <= k:
            count += 1
            i += 1
            j += 1
        elif apartments[j] < applicants[i] - k:
            j += 1
        else:
            i += 1
    return count

# Contoh penggunaan
n, m, k = 4, 3, 5
applicants = [60, 45, 80, 60]
apartments = [30, 60, 75]
print(apartment_allocation(n, m, k, applicants, apartments))  # Output: 2
