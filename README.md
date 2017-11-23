

# PHP 依赖注入 类 写个例子研究一下

[依赖注入那些事儿](https://www.cnblogs.com/leoo2sk/archive/2009/06/17/1504693.html)


## v1.0
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
> 
> attack in weapon class->function attack by recursive

## v2.0

```
<?php

require_once 'role.php';
require_once 'weapon.php';
require_once 'woodenSword.php';
require_once 'magicSword.php';
require_once 'monster.php';

$wooden = new WoodenSword;
$magic = new MagicSword;
$role = new Role("yibo",$wooden);
$monsterBoss = new Monster("boss",100,3);
$role->weapon->attackTarget($monsterBoss);
$role->weapon = $magic;
$role->weapon->attackTarget($monsterBoss);

```

- Tip：OCP原则，即开放关闭原则，指设计应该对扩展开放，对修改关闭。
- Tip：策略模式，英文名Strategy Pattern，指定义算法族，分别封装起来，让他们之间可以相互替换，此模式使得算法的变化独立于客户。

- hp change && die ... something is duty for monster class rather than weapon 
- add attackTarget.php and each weapon class, but this not goods readable rather than v1.0
- no to study deep in this . Go on to v3.0
- 这里，测试代码实例化一个具体的武器，并赋给Role的Weapon成员的过程，就是依赖注入！这里要清楚，依赖注入其实是一个过程的称谓
- 随着面向对象分析与设计的发展，一个良好的设计，核心原则之一就是将变化隔离

#### 依赖注入的正式定义：
> 依赖注入（Dependency Injection），是这样一个过程：由于某客户类只依赖于服务类的一个接口，而不依赖于具体服务类，所以客户类只定义一个注入点。在程序运行过程中，客户类不直接实例化具体服务类实例，而是客户类的运行上下文环境或专门组件负责实例化服务类，然后将其注入到客户类中，保证客户类的正常运行。

### 依赖注入的类别

#### Setter注入
Setter注入（Setter Injection）是指在客户类中，设置一个服务类接口类型的数据成员，并设置一个Set方法作为注入点，这个Set方法接受一个具体的服务类实例为参数，并将它赋给服务类接口类型的数据成员。
> this is clear !
> back to code v1.0 2.0 

#### 构造注入
另外一种依赖注入方式，是通过客户类的构造函数，向客户类注入服务类实例。

构造注入（Constructor Injection）是指在客户类中，设置一个服务类接口类型的数据成员，并以构造函数为注入点，这个构造函数接受一个具体的服务类实例为参数，并将它赋给服务类接口类型的数据成员

可以看出，与Setter注入很类似，只是注入点由Setter方法变成了构造方法。这里要注意，由于构造注入只能在实例化客户类时注入一次，所以一点注入，程序运行期间是没法改变一个客户类对象内的服务类实例的                    **some question: in php this is could change **

#### 依赖获取
上面提到的注入方式，都是客户类被动接受所依赖的服务类，这也符合"注入"这个词。不过还有一种方法，可以和依赖注入达到相同的目的，就是依赖获取。

依赖获取（Dependency Locate）是指在系统中提供一个获取点，客户类仍然依赖服务类的接口。当客户类需要服务类时，从获取点主动取得指定的服务类，具体的服务类类型由获取点的配置决定。

Abstract Factory模式
factory pattern ..... feel not so magic just class overlay simple

##### 反射与依赖注入

我们虽然使用了多态性和Abstract Factory，但对OCP贯彻的不够彻底。在理解这点前，朋友们一定要注意潜在扩展在哪里，潜在会出现扩展的地方是"新的组件系列"而不是"组件种类"，也就是说，这里我们假设组件就三种，不会增加新的组件，但可能出现新的外观系列，如需要加一套Ubuntu风格的组件，我们可以新增UbuntuWindow、UbuntuButton、UbuntuTextBox和UbuntuFactory，并分别实现相应接口，这是符合OCP的，因为这是扩展。但我们除了修改配置文件，还要无可避免的修改FactoryContainer，需要加一个分支条件，这个地方破坏了OCP。依赖注入本身是没有能力解决这个问题的，但如果语言支持反射机制（Reflection），则这个问题就迎刃而解。

我们想想，现在的难点是出在这里：对象最终还是要通过"new"来实例化，而"new"只能实例化当前已有的类，如果未来有新类添加进来，必须修改代码。如果，我们能有一种方法，不是通过"new"，而是通过类的名字来实例化对象，那么我们只要将类的名字作为配置项，就可以实现在不修改代码的情况下，加载未来才出现的类。所以，反射给了语言"预见未来"的能力，使得多态性和依赖注入的威力大增。

> read two paragraph above . That thing is that I always pursue thing !
> but this part I cant understand 

##### 多态的活性与依赖注入
以上三种多态性，比较好的例子就是上文提到的武器多态性（高活）、角色多态性（中活）和数据访问层多态性（低活）

一般来说，高活多态性适合使用Setter注入。因为Setter注入最灵活，也是唯一允许在同一客户类实例运行期间更改服务类的注入方式。并且这种注入一般由上下文环境通过Setter的参数指定服务类类型，方便灵活，适合频繁变化的高活多态性。

对于中活多态性，则适合使用Constructor注入。因为Constructor注入也是由上下文环境通过Construtor的参数指定服务类类型，但一点客户类实例化后，就不能进行再次注入，保证了其时间稳定性。

而对于低活多态性，则适合使用Dependency Locate并配合文件配置进行依赖注入，或Setter、Constructor配合配置文件注入，因为依赖源来自文件，如果要更改服务类，则需要更改配置文件，一则确保了低活多态性的时间和空间稳定性，二是更改配置文件的方式方便于大规模服务类替换。（因为低活多态性一旦改变行为，往往规模很大，如替换整个数据访问层，如果使用Setter和Construtor传参，程序中需要改变的地方不计其数）

本质上，这种选择是因为不同的依赖注入类型有着不同的稳定性，大家可以细细体会"活性"、"稳定性"和"依赖注入类型"之间密切的关系。

> three model use in different locate 

### IoC Container

#### IoC Container出现的必然性

随着面向对象分析与设计的发展和成熟，OOA&D被越来越广泛应用于各种项目中，然而，我们知道，用OO就不可能不用多态性，用多态性就不可能不用依赖注入，所以，依赖注入变成了非常频繁的需求，而如果全部手工完成，不但负担太重，而且还容易出错。再加上反射机制的发明，于是，自然有人开始设计开发各种用于依赖注入的专用框架。这些专门用于实现依赖注入功能的组件或框架，就是IoC Container。

从这点看，IoC Container的出现有其历史必然性。目前，最著名的IoC也许就是Java平台上的Spring框架的IoC组件，而.NET平台上也有Spring.NET和Unity等。

#### IoC Container的分类

##### 重量级IoC Container

所谓重量级IoC Container，是指一般用外部配置文件（一般是XML）作为依赖源，并托管整个系统各个类的实例化的IoC Container。
Spring和Spring.NET是重量级IoC Container的例子。

##### 轻量级IoC Container

还有一种IoC Container，一般不依赖外部配置文件，而主要使用传参的Setter或Construtor注入，这种IoC Container叫做轻量级IoC Container。这种框架很灵活，使用方便，但往往不稳定，而且依赖点都是程序中的字符串参数，所以，不适合需要大规模替换和相对稳定的低活多态性，而对于高活多态性，有很好的效果。
Unity是一个典型的轻量级IoC Container。































