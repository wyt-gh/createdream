<?php

namespace app\controller;

use app\BaseController;

use common\service\Email;
use think\Exception;
use think\facade\Cache;
use think\facade\Db;
use think\Queue\Job;

class Jobs extends BaseController
{
    public function fire(Job $job, $data)
    {
        //删除
        $job->delete();
        //执行失败3次
//        if ($job->attempts() >= 2) {
//            $job->delete();
//            return false;
//        }

        Db::startTrans(); //开启事务
        try {
            Db::table('user')->where(['id' => 1])->inc('age', 7)->update();
//            throw new Exception('1111');
            // 提交事务
            Db::commit();
        } catch (Exception $e) {
            // 回滚事务
            Db::rollback();
            //执行失败10S后重试
            $job->release(2);
        }
    }

    public function sendEmail(Job $job, $data)
    {
        //执行失败3次
        if ($job->attempts() >= 4) {
            $job->delete();
            return false;
        }
        $send_result = Email::send($data);

        if ($send_result) {
            $job->delete();
            return true;
        } else {
            //执行失败10S后重试
            $job->release(2);
        }
    }
}