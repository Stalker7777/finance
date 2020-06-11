<?php

namespace app\components;

use yii\behaviors\AttributeBehavior;

class DataBehavior extends AttributeBehavior
{
    /**
     * @return int
     */
    public static function getTimestamp()
    {
        return time();
    }
}
