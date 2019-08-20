<?php


namespace app\models\validations;


use yii\validators\Validator;

class TitleValidation extends Validator
{
    public $list;

    public function validateAttribute($model, $attribute)
    {
        if(in_array($model->$attribute,$this->list)){

            $model->addError($attribute,'Запрещенно название события');
        }
    }
}