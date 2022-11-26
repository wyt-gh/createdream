<?php

namespace app\tool;

use PHPMailer\PHPMailer\PHPMailer;
use think\Exception;

class Email
{
    public static function send($data = [])
    {
        $email = new PHPMailer(true); // Passing `true` enables exceptions
        //服务器配置
        $email->CharSet   = "UTF-8";                     //设定邮件编码
        $email->SMTPDebug = 0;                        // 调试模式输出
        $email->isSMTP();                             // 使用SMTP
        $email->Host       = 'smtp.qq.com';                // SMTP服务器
        $email->SMTPAuth   = true;                      // 允许 SMTP 认证
        $email->SMTPSecure = 'ssl';                    // 允许 TLS 或者ssl协议
        $email->Port       = 465;                            // 服务器端口 25 或者465 具体要看邮箱服务器支持
        $address   = isset($data['address']) ? $data['address'] : ''; //SMTP 用户名  即邮箱的用户名
        $password  = isset($data['password']) ? $data['password'] : ''; //SMTP 密码  部分邮箱是授权码(例如163邮箱)
        $from_user = isset($data['from_user']) ? $data['from_user'] : ''; //发件人
        $to_user   = isset($data['to_user']) ? $data['to_user'] : ''; //收件人
        $subject   = isset($data['subject']) ? $data['subject'] : ''; //邮件标题
        $body      = isset($data['body']) ? $data['body'] : ''; //邮件内容
        try {
            $email->Username = $address;
            $email->Password = $password;
            $email->setFrom($address, $from_user);  //发件人
            $email->addAddress($address, $to_user);  // 收件人
            //$email->addAddress('ellen@example.com');  // 可添加多个收件人
//            $email->addReplyTo('xxxx@163.com', 'info'); //回复的时候回复给哪个邮箱 建议和发件人一致
            //$email->addCC('cc@example.com');                    //抄送
            //$email->addBCC('bcc@example.com');                    //密送

            //发送附件
            // $email->addAttachment('../xy.zip');         // 添加附件
            // $email->addAttachment('../thumb-1.jpg', 'new.jpg');    // 发送附件并且重命名

            //Content
            $email->isHTML(true);                                  // 是否以HTML文档格式发送  发送后客户端可直接显示对应HTML内容
            $email->Subject = $subject;
            $email->Body    = $body;
            $email->AltBody = '如果邮件客户端不支持HTML则显示此内容';

            $email->send();
            echo '邮件发送成功';
            return true;
        } catch (Exception $e) {
            echo '邮件发送失败: ', $email->ErrorInfo;
        }
    }
}