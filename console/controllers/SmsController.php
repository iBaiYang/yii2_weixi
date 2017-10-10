<?php
namespace console\controllers;

use yii\console\Controller;
use common\models\Comment;

class SmsController extends Controller
{
    /**
     * 未审核评论提醒
     * php ./yii sms/send
     * @return int
     */
    public function actionSend()
    {
        // 操作系统上的执行命令：输出重定向，写入sms.log日志
        // /var/www/yii2_weixi/yii sms/send >> /var/www/yii2_weixi/sms.log
        // more sms.log
        // sudo crontab -e 定时执行，具体不展开，自己搜索crontab
        // 看看有没有未提醒的新评论
        $newCommentCount = Comment::find()->where(['remind'=>0, 'status'=>1])->count();

        if ( $newCommentCount > 0 ) {
            $content = '有'.$newCommentCount.'条新评论待审核。';

            $result = $this->vendorSmsService( $content );
//            $result = ['status' => 'success', 'dt' => time(), 'length' => 103];  // 模拟返回

            if ( $result['status'] == 'success' ) {
                Comment::updateAll(['remind'=>1]);  // 把提醒标志全部设为已提醒
                echo '['.date("Y-m-d H:i:s", $result['dt']).'] '.$content.'['.$result['length'].']'."\r\n";  // 记录日志

            }

            return 0;  // 成功返回0，退出；失败，返回具体数字代码
        }
    }

    /**
     * 模拟发送
     * @param $content
     * @return array
     */
    protected function vendorSmsService( $content )
    {
        // 实现第三方短信供应商提供的短信发送接口。

        /*$username = 'companyname';		//用户账号
        $password = 'pwdforsendsms';	//密码
        $apikey = '577d265efafd2d9a0a8c2ed2a3155ded7e01';	//密码
        $mobile	 = $adminuser->mobile;	//号手机码

        $url = 'http://sms.vendor.com/api/send/?';
        $data = array
        (
                'username'=>$username,				//用户账号
                'password'=>$password,				//密码
                'mobile'=>$mobile,					//号码
                'content'=>$content,				//内容
                'apikey'=>$apikey,				    //apikey
        );
        $result= $this->curlSend($url,$data);			//POST方式提交
        return $result;    //返回发送状态，发送时间，字节数等数据
        }*/

        $result = array( "status" => "success", "dt" => time(), "length" => 43);  // 模拟数据
        return $result;
    }
}