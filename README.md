

# PHP 依赖注入 类 写个例子研究一下

[依赖注入那些事儿](https://www.cnblogs.com/leoo2sk/archive/2009/06/17/1504693.html)


##v1.0
- class : monter,weapon,role
```
木剑 attack 20
boss remaind 80
occur crit
木剑 attack 40
boss remaind 40
occur crit
木剑 attack 40
boss is Dead !
```

- plan : 
> monster array -[x]
> attack in weapon class->function attack by recursive
