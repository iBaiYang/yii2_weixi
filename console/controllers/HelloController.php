<?php
namespace console\controllers;

use yii\console\Controller;
use common\models\Post;

class HelloController extends Controller
{
    public $rev;

    public function options()
    {
        return ['rev'];
    }

    public function optionAliases()
    {
        return ['r' => 'rev'];
    }

    /**
     * php ./yii hello/check --rev=1
     * php ./yii hello/check --r=1
     * 参数
     */
    public function actionCheck()
    {
        if ( $this->rev == 1 ) {
            echo strrev("Hello World!")."\n";
        } else {
            echo "Hello World!\n";
        }
    }

    /**
     *
     * php ./yii hello/index
     */
    public function actionIndex()
    {
        echo "Hello World!\n";
    }

    /**
     * 打印文章标题列表
     * php ./yii hello/list
     */
    public function actionList()
    {
        $posts = Post::find()->all();

        foreach ( $posts as $aPost )
        {
            echo ( $aPost['id'] . " - " . $aPost['title'] . "\n" );
        }
    }

    /**
     * php ./yii hello/who weixi
     * @param $name
     */
    public function actionWho( $name )
    {
        echo ("Hello ". $name . "!\n");
    }

    /**
     * php ./yii hello/both you me
     * @param $name
     * @param $another
     */
    public function actionBoth( $name, $another )
    {
        echo ("Hello ".$name." and ". $another ."!\n");
    }

    /**
     * php ./yii hello/all you,me,he
     * @param array $names
     */
    public function actionAll( array $names )
    {
        var_dump($names);
    }

}