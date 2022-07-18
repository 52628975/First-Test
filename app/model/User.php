<?php
namespace app\model;
use think\Model;

Class User extends Model
{
    //设置一下表名称，你是哪张表就写哪个
    protected $name ='user';

    //设置主键
//    protected $pk   ='id';

    //设置表
    protected  $table   ='tp_user';

    //操作初始化
    protected static function init()
    {
        parent::init();
//        echo '初始化操作！';
    }


}