<?php
/**
 *
 * @author Ivo Kund <ivo@opus.ee>
 * @date 24.01.14
 */

namespace app\models;


use yii\base\Model;

/**
 * Model used to hold temporary basket form data
 *
 * @author Ivo Kund <ivo@opus.ee>
 * @package app\models
 */
class BasketModel extends Model
{
    public $userId;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [[['userId'], 'safe']];
    }
}