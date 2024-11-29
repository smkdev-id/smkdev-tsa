## 1. Apartment Allocation (Easy)

You are tasked with allocating apartments to as many applicants as possible. There are **n** applicants and **m** free apartments, each with specific size requirements and constraints. Your objective is to ensure that the maximum possible number of applicants receive an apartment that meets their requirements.

### Task Description
Your task is to implement a solution that achieves the following:

1. **Maximize the number of applicants** who receive an apartment.
2. For each applicant, determine if there is a suitable apartment that matches their requirements, given a **maximum allowed size difference**.
3. Print the **total number of applicants** who receive an apartment.

### Input
The input consists of three lines:

1. The first line has three integers **n**, **m**, and **k**:
   - **n**: the number of applicants.
   - **m**: the number of available apartments.
   - **k**: the maximum allowed difference between the desired apartment size and the actual size.

2. The second line contains **n** integers **a1, a2, ...., a`n`**:
   - **a`i`** represents the desired apartment size of each applicant.
   - Each applicant will accept an apartment whose size is between **a`i` - k** and **a`i` + k** (inclusive).

3. The third line contains **m** integers **b1, b2, ..., b`m`**:
   - **b`i`** represents the size of each available apartment.

### Output
Print one integer: the **number of applicants** who will receive an apartment.

### Rules & Constraints
- **1 ≤ n, m ≤ 2 × 10^5**: The number of applicants and apartments is between 1 and 200,000.
- **0 ≤ k ≤ 10^9**: The maximum allowed difference between desired and actual apartment size is between 0 and 1 billion.
- **1 ≤ a`i`, b`i` ≤ 10^9**: The sizes of apartments and desired sizes are between 1 and 1 billion.
- Each applicant can receive **at most one** apartment, and each apartment can be allocated to **only one** applicant.

### Task Requirements
1. **Optimal Matching Strategy**: Implement an algorithm that finds the optimal way to match apartments with applicants, maximizing the number of successful allocations.
2. **Sorting & Two-Pointer Technique**: Consider using efficient algorithms like sorting and the two-pointer technique to solve the problem within the input constraints.
3. **Efficiency**: The solution must handle the large input sizes efficiently, based on expected output on unit testing.

### Example

**Input**
```
4 3 5
60 45 80 60
30 60 75
```

**Output**
```
2
```

## 2. Tower of Hanoi (Intermediate)

The Tower of Hanoi game consists of three stacks (left, middle, and right) and **n** round disks of different sizes. Initially, the left stack has all the disks arranged in increasing order of size from top to bottom.

The goal is to move all the disks to the right stack using the middle stack while following specific rules and minimizing the number of moves.

### Task Description
Your task is to implement a solution that accomplishes the following:

1. Find a solution that **minimizes the number of moves** required to transfer all disks from the left stack to the right stack.
2. **Print** the minimum number of moves required.
3. **Print the sequence of moves** to achieve the goal.

### Input
The input consists of a single line containing an integer **n**, which represents the number of disks.

- **Input Format**:
  - The only input line has an integer **n**: the number of disks.

### Output
The output should consist of the following:

1. First, print an integer **k**: the minimum number of moves required.
2. After this, print **k** lines, each describing a move. Each line should have two integers **a** and **b**, where you move the uppermost disk from stack **a** to stack **b**.

### Stacks and Moves
- There are three stacks:
  - Stack **1**: Left stack (initial stack)
  - Stack **2**: Middle stack (intermediate stack)
  - Stack **3**: Right stack (destination stack)

- On each move, you may move the uppermost disk from one stack to another stack. Disks must be moved according to the following rules:
  - Only **one disk** may be moved at a time.
  - You cannot place a **larger disk on top of a smaller disk**.

### Rules & Constraints
- **1 ≤ n ≤ 16**: The number of disks is between 1 and 16.
- The output should include:
  - **Minimum number of moves** to solve the Tower of Hanoi.
  - A sequence of **valid moves** that solves the problem.

### Example

**Input**
```
2
```

**Output**
```
3
1 2
1 3
2 3
```

## 3. Palindrome Queries (Hard)

You are given a string consisting of **n** characters from **a** to **z**. The positions of the string are indexed **1, 2, …, n**. You are required to process **m** operations on this string, which can be of two types:

1. Change the character at a specified position.
2. Check if a specific substring is a palindrome.

### Task Description
Your task is to implement a solution that efficiently handles the following operations:

1. **Change Operation**: Update the character at position **k** to a given character **x**.
2. **Palindrome Check**: Determine whether the substring from position **a** to position **b** is a palindrome. A palindrome reads the same forward and backward.

### Input
The input consists of several lines:

1. The first line has two integers **n** and **m**:
   - **n**: the length of the string.
   - **m**: the number of operations to process.

2. The second line contains a string of length **n** consisting of lowercase letters (**a** to **z**).

3. The next **m** lines describe the operations. Each operation is either of the form **"1 k x"** or **"2 a b"**:
   - **1 k x**: Change the character at position **k** to **x** (1-based index).
   - **2 a b**: Check if the substring from position **a** to position **b** is a palindrome (1-based index).

### Output
For each operation of type **2**, print **1** if the substring is a palindrome and **0** otherwise.

### Rules & Constraints
- **1 ≤ n, m ≤ 2 ⋅ 10^5**: The length of the string and the number of operations are both between **1** and **200,000**.
- **1 ≤ k ≤ n**: The position to change is between **1** and **n**.
- **1 ≤ a ≤ b ≤ n**: The substring boundaries are between **1** and **n**.
- The string consists only of lowercase letters from **a** to **z**.

### Task Requirements
1. **Update Operation:** Modify the character at a specific position in the string. This operation must be executed based on expected output on unit testing.
2. **Palindrome Check Operation:** Determine if a substring is a palindrome. This operation must also be completed based on expected output on unit testing.


### Example

**Input**
```
7 5
aybabtu
2 3 5
1 3 x
2 3 5
1 5 x
2 3 5
```

**Output**
```
1
0
1
```
