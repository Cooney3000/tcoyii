<?php

namespace frontend\components;

use yii\base\Widget;

class CmSwitchWidget extends Widget
{
    public $content;

    public function run()
    {
        return $this->render('cmSwitchView', [
            'contentId' => $this->content->id,
            'title' => $this->content->title,
            'body' => $this->content->body,
        ]);

    }
}

