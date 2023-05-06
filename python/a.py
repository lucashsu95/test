import sys


lines = sys.stdin.read().splitlines()
for line in lines:
    ary = list(map(int, line.split(', ')))
    n = len(ary)
    record = []
    for i in range(n):
        if len(record) == 2:
            break
        for j in range(n - i - 1):
            if ary[j] > ary[j + 1]:
                ary[j], ary[j+1] = ary[j+1], ary[j]
                if i not in record:
                    record.append(i) 

    print(ary)
