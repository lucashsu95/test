# 最小成本生成樹
def tree(title,url,prev):
    # print('title:',title,'url:',url,'prev:',prev)

    if(title in url):
        return True
    # for i in range(len(ary2)):
    #     if title == ary2[i][0] and prev != ary2[i][1]:
    #         # print(f'ary2:{ary2[i]},url:{url},prev:{prev}')
    #         tree(ary2[i][1],url + [title],title)
    return any([tree(ary2[i][1],url + [title],title) for i in range(len(ary2)) if title == ary2[i][0] and prev != ary2[i][1]])

n = int(input())
for _ in range(n):
    ary = input().split()
    ary = sorted(ary,key=lambda x : int(x.split(',')[-1]))
    ary2 = []
    total = 0
    for item in ary:
        
        start,end,num = item.split(',')
        
        ary2.append([start,end,num])
        ary2.append([end,start,num])

        if(tree(ary2[0][0],[],None)):
            ary2.pop()
            ary2.pop()
        else:
            total += int(num)
        
    print(total)
