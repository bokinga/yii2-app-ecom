<?php

namespace app\models\ar;

/**
 * This is the model class for table "eco_payment".
 *
 */
class Payment extends base\Payment
{
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            // add additional translations
        ]);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            // add additional rules
        ]);
    }
}
