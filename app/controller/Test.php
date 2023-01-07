<?php

namespace app\controller;

use app\BaseController;
use think\facade\Cache;
use think\facade\Db;

class Test extends BaseController
{
    public function createTable()
    {
//        $create_database_sql = "CREATE DATABASE [IF NOT EXISTS] `test`
//                                CHARACTER SET 'utf8mb4'
//                                COLLATE 'utf8mb4_general_ci';";
//        $res = Db::execute($create_database_sql);
//        halt($res);
        $create_table_sql = "CREATE TABLE IF NOT EXISTS `user` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `name` varchar(255) NOT NULL,
            `age` int(10) NOT NULL,
            `create_time` int(10) unsigned NOT NULL,
            `update_time` int(10) unsigned NOT NULL,
            `delete_time` int(10) unsigned DEFAULT NULL,
            PRIMARY KEY (`id`)
        )ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        $res = Db::execute($create_table_sql);
        dump($res);

        $data = [
            [
                'name' => '张三',
                'age' => 18,
                'create_time' => time(),
                'update_time' => time(),
            ],
            [
                'name' => '李四',
                'age' => 30,
                'create_time' => time(),
                'update_time' => time(),
            ],
        ];

        $res = Db::name('user')->insertAll($data);
        dump($res);
    }

    public function selectTable()
    {
        $data = Db::name('user')->select();
        halt($data);
    }

    public function setRedis()
    {
        Cache::set('name', 111);
    }

    public function getRedis()
    {
        echo Cache::get('name');
    }
}