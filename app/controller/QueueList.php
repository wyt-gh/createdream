<?php

namespace app\controller;

use app\BaseController;
use think\facade\Queue;


class QueueList extends BaseController
{
    public function queuePush()
    {
        $jobHandlerClassName = 'app\controller\Jobs';

        //当前任务归属的队列名称，如果为新队列，会自动创建
        //php think queue:work --queue orderJobQueue
        //php think queue:work --queue orderJobQueue --daemon
        $jobQueueName = "orderJobQueue";

        //数组数据
        $orderData = [
            'id' => uniqid(),
            'time' => time(),
        ];

        //将该任务推送到消息队列，等待对应的消费者去执行
        //这里只是负责将数据添加到相应的队列名称的队列里，消费者与生产者并无联系
//        $isPushed = Queue::push($jobHandlerClassName , $orderData, $jobQueueName);
        $isPushed = Queue::later(2, $jobHandlerClassName, $orderData, $jobQueueName);

        if ($isPushed !== false) {
            echo date('Y-m-d H:i:s') . " 队列添加成功";
        } else {
            echo '队列添加失败';
        }
    }

    //发送邮件
    public function hello()
    {
        //调用类
        $jobHandlerClassName = 'app\controller\Jobs@sendEmail';

        //数组数据
        $data = [
            'address' => '1422256366@qq.com',
            'password' => 'vlwjdjahedhpgeji',
            'subject' => '公鸡你太美--' . time(),
            'body' => '<h1>这是使用think-queue发送的email消息</h1>' . date('Y-m-d H:i:s'),
            'from_user' => '王一涛',
            'to_user' => '王一涛',
        ];

        //当前任务归属的队列名称，如果为新队列，会自动创建
        //php think queue:work --queue helloQueue
        //php think queue:work --queue helloQueue --daemon
//        $jobQueueName = "helloQueue";
        $jobQueueName = "orderJobQueue";

        //将该任务推送到消息队列，等待对应的消费者去执行
        //这里只是负责将数据添加到相应的队列名称的队列里，消费者与生产者并无联系
//        $isPushed = Queue::push($jobHandlerClassName , $orderData, $jobQueueName);
        $isPushed = Queue::later(3, $jobHandlerClassName, $data, $jobQueueName);

        if ($isPushed !== false) {
            echo date('Y-m-d H:i:s') . " 队列添加成功";
        } else {
            echo '队列添加失败';
        }
    }
}