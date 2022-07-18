<?php
namespace app\controller;
use think\Exception;
use think\exception\ErrorException;
use think\facade\Db;
use app\BaseController;

Class DataTest extends BaseController
{
    public function index()
    {
        return '看啥';
    }


    public function poly()
    {
//        $result= Db::name('user')->count();//求全部有多少条
//        $result= Db::name('user')->count('uid');//求uid不为NULL的有多少条
//        $result= Db::name('user')->max('price');        //求出价格的最大值
//        $result= Db::name('user')->min('price');        //求出价格的最小值

//        $result= Db::name('user')->min('email',false);//email的值不是数值
//        $result= Db::name('user')->max('email',false);//email的最大值
//        $result= Db::name('user')->avg('price');//计算price的平均值
//        $result= Db::name('user')->sum('price');//计算price的总和
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//      //子查询准备工作
//        $result= Db::name('user')->fetchSql(true)->select();//true的话就不执行Sql语句而返回字符串
//        $result= Db::name('user')->buildSql(true);

        //子查询正式开始，查出one表中男同胞的所有信息
        //1.求出所有男的uid
//        $subQuery=Db::name('two')->field('uid')->where('gender','男')->buildSql(true);
//        //2.把这些uid拿去one中查询，用一个where
//        $result=Db::name('one')->where('id','exp','in '.$subQuery)->select();

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            //闭包查询
//       $result  =   Db::name('one')->where('id','in',function ($query){
//           $query->name('two')->field('uid')->where('gender','男');
//       })->select();

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                //原生查询，当所有的tp框架的Sql语句都没办法达到你想到的结果时，可以使用原生的SQL查询

//        $result =   Db::query('SELECT * FROM tp_user ');//原生的查询
        $result =   Db::execute('UPDATE tp_user SET username ="孙武" where id =25');

        return Db::getLastSql();
        return json($result);
    }   //原生、聚合、子查询

    public function LinkUp()
    {
        //表达式查询
//        $user   =Db::name('user')->where('id','>',70)->select();        //表达式查询

//        //关联数组查询
//        $user   =Db::name('user')->where([
//            'gender'       =>       '男',
//            'price'        =>       100
//        ])->select();        //关联数组查询

        //索引数组查询
//        $user   =Db::name('user')->where([
//            ['gender','=','男'],
//            ['price','>',100]
//        ])->select();        //索引数组查询

        //复杂数组拼装
//        $map[]  =   ['gender','=','男'];
//        $map[]  =   ['price','in',[60,70,80]];
//        $user   =Db::name('user')->where($map)->select();

        //字符串传递
//        $user   =Db::name('user')->where('gender = "男" and price in (60,70,80)')->select();
//        $user   =Db::name('user')->whereRaw('gender = "男" and price in (60,70,80)')->select();

        //预处理模式：

//        $user   =Db::name('user')->where('id=:id',['id' =>19])->select();
//        $user   =Db::name('user')->whereRaw('id=:id',['id' =>19])->select();
//        return json($user);
        //where链式查询结束
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        //field链式查询开始
//        $user   =Db::name('user')->field('id,username,email')->select();    //用字符串的方式指定
//        $user   =Db::name('user')->field(['id','username','email'])->select();    //用数组的方式指定
//
//
//        //用field()方法给指定字段设置别名
//        $user   =Db::name('user')->field(['id','username as name','email'])->select();
//        return Db::getLastSql();

        //使用field()，给字段设置函数
//        $user   =Db::name('user')->field('id,SUM(price)')->select();
        //显示所有字段，但不是用* from
//        $user   =Db::name('user')->field(true)->select();
//
//        //排除某个字段
//        $user   =Db::name('user')->withoutField('password')->select();


        $user   =Db::name('user')->alias('a')->select();
        return Db::getLastSql();
        return json($user);
    }       //链式查询上

    public function LinkDown()
    {
//        //限制显示前五条
//        $user = Db::name('user')->limit(5)->select();

//        //分页模式，从第n+1条开始显示m条          limit(n,m)
//        $user = Db::name('user')->limit(2,5)->select();

        //实现分页，需要计算每一页的起始数值
        //第一页
//        $user = Db::name('user')->limit(0,5)->select();
//        //第二页
//        $user = Db::name('user')->limit(5,5)->select();

        //page()方法实现分页
//        $user   =   Db::name('user')->page(2,5)->select();
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

        //order()方法实现排序
//        $user   =   Db::name('user')->order('id','desc')->select();

        //支持数组的方式，对多个字段进行排序
//        $user   =   Db::name('user')->order(['create_time'=>'desc','price'=>'asc'])->select();


        //支持使用orserRaw()用mysql函数；
//        $user   =   Db::name('user')->orderRaw('FIELD(username,"樱桃小丸子")DESC')->select();

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        //group()方法
//        $user   =   Db::name('user')->field('gender,SUM(price)')->group('gender')->select();


        //group()也支持多字段分组
//        $user   =   Db::name('user')->field('gender,SUM(price)')->group('gender,password')->select();

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//            group分组以后，使用having进行再筛选
        $user   =   Db::name('user')
                                        ->field('gender,SUM(price)')
                                        ->group('gender')
                                        ->having('SUM(price) > 600')
                                        ->select();
//        return Db::getLastsql();
        return json($user);
    }       //链式查询下

    public function advanced()
    {
        //高级查询
//        //可以使用多个where拼接sql语句
//        $user   =   Db::name('user')
//                            ->where('username|email','like','%xiao%')
//                            ->where('price&uid','>',0)
//                            ->select();

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//        //可以使用关联数组惊醒多个字段查询
//        $user   =   Db::name('user')->where([
//            ['id','>',0],
//            ['price','>=',80],
//            ['password','=',123],
//            ['email','like','%xiao%']
//        ])->select();


//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

//        //使用Raw()进行封装
//        $user   =   Db::name('user')->where([
//            ['id','>',0],
//            ['price','exp',Db::Raw('>=80')],
//            ['password','=',123],
//            ['email','like','%xiao%']
//        ])->select();


//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

        //4.如果有多个where，并且where条件是分离的$map，而$map本身有多个条件；
//        $map  = [
//            ['price','exp',Db::Raw('>=80')],
//            ['email','like','%xiao%'],
//            ['id','>',0]
//        ];
//        $user   =     Db::name('user')->where([$map])
//                                            ->where('password','=',123)
//                                            ->select();
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        //5.如果，条件中多次出现一个字段，并且需要OR来左右谁选，可以用whereOr；
//        $map1   =   [
//            ['username','like','%小%'],
//            ['email','like','%163%']
//        ];
//
//        $map2   =   [
//            ['username','like','%孙%'],
//            ['email','like','%.com%']
//        ];
//        $user   =     Db::name('user')->whereOr([$map1,$map2]) ->select();

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//          6.闭包查询可以连缀，会自动加上括号，更清晰，如果是OR，请使用whereOR();
//        //先来个闭包查询的小例子
//        $user   =   Db::name('user')->where(function ($query){
//            $query->where('id','>',0);
//        })->where(function ($query){
//            $query->where('username','like','%小%');
//        })->select();

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    //7.对于比较复杂或者你不知道如何拼装SQL条件，那么就直接使用whereRaw()即可；
//        $user   =   Db::name('user')
//                        ->whereRaw('(username LIKE "%小%" AND password =  123) OR id > 5')
//                        ->select();


//          8.whereRaw()方式也支持参数绑定操作，具体如下；
        $user   =   Db::name('user')
                            ->whereRaw('(username LIKE :username AND password =:password) OR id >:id',
                            ['username'=>'%小%','password'=>123,'id'=>0])
                            ->select();
        return Db::getLastsql();
        return  json($user);
    }       //高级查询

    public function speedy()
    {

        //2. whereColumn()方法，比较两个字段的值，符合的就筛选出来；
//        $user   =   Db::name('user')
//                        ->whereColumn('update_time','>=','create_time')
//                        ->select();


        //4. whereFieldName()方法，查询某个字段的值，注意 FileName 是字段名；
//        $user   =   Db::name('user')->whereemail('xiaoxin@163.com')->select();
        //使用whereUser()查询蜡笔小新
//        $user   =   Db::name('user')->whereUsername('蜡笔小新')->find();


        //5. getByFieldName()方法，查询某个字段的值，注意只能查询一条，不需要 find()；

//        $user   =   Db::name('user')->getbyEmail('xiaoxin@163.com');

        //6. getFieldByFieldName()方法，通过查询得到某个指定字段的单一值；

//        $user   =   Db::name('user')->getFieldByEmail('xiaoxin@163.com','username');


        //其它补充
        //1. when()可以通过条件判断，执行闭包里的分支查询；
        $user   =   Db::name('user')->when(false,function ($query){
           $query->where('id','>',0);
         },function ($query){
           $query->where('username','like','%小%');
            })->select();

        return Db::getLastsql();
        return json($user);
    }           //快捷查询

    public function getter()
    {
        //事务处理

        //事务处理自动模式
//        Db::Transaction(function (){
//            Db::name('user')->where('id',19)->save(['price'=>Db::Raw('price - 3')]);
//            Db::name('user1')->where('id',20)->save(['price'=>Db::Raw('price + 3')]);
//        });

        //事务处理手动模式
//        Db::startTrans();
//        try{
//            Db::name('user')->where('id',19)->save(['price'=>Db::Raw('price - 3')]);
//            Db::name('user1')->where('id',20)->save(['price'=>Db::Raw('price + 3')]);
//        }catch (\Exception $e){
//            echo '执行SQL失败，开始回滚数据';
//            Db::rollback();
//        }

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

        //获取器

        $user   =   Db::name('user')->withAttr('email',function ($value,$data){
//                    return strtoupper($value);
            dump($data);
        })->select();

//        return json($user);

    }           //事务处理和获取器

    public function collection()
    {
        $user   =   Db::name('user')->select();

        dump($user->shuffle());
    }       //数据集







}