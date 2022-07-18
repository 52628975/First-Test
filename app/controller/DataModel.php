<?php
namespace app\controller;
//use app\model\User;
use app\model\User;
use app\model\User as UserModel;
use app\BaseController;
use think\facade\Db;


//此控制器专门用来测试模型
Class DataModel extends BaseController
{
        public function index()
        {
//          return json(User::select()) ;
          return json(UserModel::find(25));
        }

        public function insert()
        {
            //2.设置要新增的数据，然后使用save()方法写到数据库中
//            $user   = new UserModel();
////            $user   =  new User();
//            $user->username         =           '李a';
//            $user->password         =           '123';
//            $user->gender           =           '男';
//            $user->email            =           'libai@163.com';
//            $user->price            =           100;
//            $user->details          =           '123';
//            $user->uid              =           1001;
//            $user->save();

            //3.也可以通过save()传递数据数组的方式，来新增数据；
//            $user   = new UserModel();
//            $user->allowField(['username','password','details'])->save([                                                       //直接在这边写allowField；
//                'username'         =>           '李c',
//                'password'         =>           '123',
//                'gender'           =>           '男',
//                'email'            =>           'libai@163.com',
//                'price'            =>           100,
//                'details'          =>           '123',
//                'uid'              =>           1001
//            ]);

//            //5.模型新增页提供了replace()方法来实现RELPLACE into新增；
//            $user   = new UserModel();
//            $user->username         =           '李a';
//            $user->password         =           '123';
//            $user->gender           =           '男';
//            $user->email            =           'libai@163.com';
//            $user->price            =           100;
//            $user->details          =           '123';
//            $user->uid              =           1001;
//            $user->replace()->save();
//            return Db::getLastsql();


//        //使用saveAll来批量新增数据；
//            $dataAll    =[
//                [
//                'username'         =>           '李白1',
//                'password'         =>           '123',
//                'gender'           =>           '男',
//                'email'            =>           'libai@163.com',
//                'price'            =>           100,
//                'details'          =>           '123',
//                'uid'              =>           1001
//            ], [
//                    'username'         =>           '李白2',
//                    'password'         =>           '123',
//                    'gender'           =>           '男',
//                    'email'            =>           'libai@163.com',
//                    'price'            =>           100,
//                    'details'          =>           '123',
//                    'uid'              =>           1001
//                ]
//
//            ];
//
//            $user   = new UserModel();
//            dump($user->saveAll($dataAll));


            //使用::create()静态方法，来创建要新增的数据

            $user   =UserModel::create(
                [   'username'         =>           '李白3',
                    'password'         =>           '123',
                    'gender'           =>           '男',
                    'email'            =>           'libai@163.com',
                    'price'            =>           100,
                    'details'          =>           '123',
                    'uid'              =>           1001
                ],['username','password','details'],false);
            echo $user->id;

        }           //数据的新增

        public function delete()
        {
            //直接通过查找id然后进行删除
//            $user =UserModel::find(303);
//            dump($user->delete());

            //.也可以使用静态方法调用destroy()方法，通过主键（id）删除数据；

//            UserModel::destroy(304);


            //destroy()方法也支持批量删除数据
//            UserModel::destroy([305,306,307]);


            //使用条件查询删除
//            UserModel::where('id','>',80)->delete();
//            UserModel::where('username','李白2')->delete();

            //使用闭包进行删除

            UserModel::destroy(function ($query){
                $query->where('username','李白3')->delete();
            });

        }           //数据的删除

        public function update()
        {
//                $user   =UserModel::find(301);
//                $user->username     =   '李黑伯伯';
//                $user->email        ='lizhu@163.com';
//                $user->save();

                //通过where()查询条件获取数据
            $user   =UserModel::where('username','李黑伯伯')->find();
            $user->username     =   '李黑';
            $user->email        =   'lihei@163.com';
            $user->save();
        }
}