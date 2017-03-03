<?php

namespace app\components;

use app\models\Posts;
use Yii;
use yii\base\Widget;
use yii\helpers\Html;

class LastPostsWidget extends Widget{
    public $posts;

    public function run(){
        $posts = Posts::find()
            ->select('id, title, img, intro_text')
            ->where(['hide' => 0])
            ->orderBy(["id" => SORT_DESC])
            ->limit(6)
            ->all();
        $list = '';
        foreach ($posts as $post){
            $element = Html::tag('a', Html::encode($post->title), ['href' => Yii::$app->urlManager->createUrl(['post/article', 'id' => $post->id]), 'class' => "tenth before after"]);
            $element = Html::tag('span', $element, ['class' => "square"]);
            $list .= Html::tag('p', $element);
        }
        if($list){
            $title =Html::tag('h2', 'Last 6 posts:');
            $list = $title.$list;
        }
        return $list;
    }
}