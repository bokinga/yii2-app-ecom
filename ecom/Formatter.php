<?php
/**
 *
 * @author Ivo Kund <ivo@opus.ee>
 * @date 23.01.14
 */

namespace opus\ecom;

/**
 * Class Formatter
 *
 * @author Ivo Kund <ivo@opus.ee>
 * @package opus\ecom
 */
class Formatter extends \yii\i18n\Formatter
{
    public function asPrice($value)
    {
        return $this->format($value / 100, 'currency');
    }
} 