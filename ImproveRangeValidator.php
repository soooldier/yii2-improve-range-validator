<?php
/**
 * Created by PhpStorm.
 * User: soooldier
 * Date: 1/19/15
 * Time: 21:52
 */
namespace improve\rangeValidator;

use Yii;
use yii\validators\RangeValidator;

/**
 * Class Region
 * @package \improve\rangeValidator
 */
class ImproveRangeValidator extends RangeValidator
{
    /**
     * @var string value默认分隔符
     */
    public $sep = ",";

    /**
     * @var callable
     * 参数为range和model，在这里可以定制range数组
     */
    public $advanceRange;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->allowArray = true;
    }
    /**
     * @inheritdoc
     */
    public function validateAttribute($model, $attribute)
    {
        if($this->advanceRange instanceof Closure) {
            $this->range = call_user_func($this->advanceRange, $this->range, $model);
        }
        $tmp_value = explode($this->sep, $model->$attribute);
        return $this->validateValue($tmp_value);
    }
}