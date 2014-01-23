<?php

namespace app\models;

/**
 * This is the model class for table "eco_invoice_line".
 *
 */
class InvoiceLine extends base\InvoiceLine
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
