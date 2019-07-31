<?php

namespace app\models;

use app\models\validations\TitleValidation;
use yii\base\Model;

class Activity extends Model
{
    public $title;
    public $description;
    public $creator;
    public $responsible;
    public $deadline;
    public $isIterated;
    public $iteratedType;

    public $email;
    public $emailRepeat;

    public $image;

    public $useNotification;

    public $isBlocked;

    const REPEAT_TYPE=[
        0=>'Каждый день',
        1=>'Каждую неделю'
    ];

    public function beforeValidate()
    {
        $date = \DateTime::createFromFormat('d.m.Y', $this->deadline);
        if ($date) {
            $this->deadline = $date->format('Y-m-d');
        }
        return parent::beforeValidate();
    }

    public function rules()
    {
        return [
            [['title', 'email'], 'trim'],
            ['image','file','extensions' => ['jpg','png']],
            [['title', 'deadline'], 'required','message' => 'Обязательно!!!'],
            ['deadline', 'date', 'format' => 'php:Y-m-d'],
//        ['phone','string','length' => 10],
            ['description', 'string', 'min' => 5, 'max' => 300],
            [['creator', 'responsible', 'deadline'], 'string'],
            [['isIterated', 'isBlocked', 'useNotification'], 'boolean'],
            ['email', 'email'],
//            ['title','match','pattern' => '/^[a-z]{0,}/ig'],
            ['email', 'required', 'when' => function (Activity $model) {
                return $model->useNotification ? true : false;
            }],
            ['iteratedType','in','range' => array_keys(self::REPEAT_TYPE)],
            ['emailRepeat','compare','compareAttribute' => 'email'],
//            ['title','titleValidate']
            ['title',TitleValidation::class,'list' => ['admin','Шаурма']]

        ];
    }

    public function titleValidate($attr){
        if($this->title=='admin'){
            $this->addError('title','Запрещенно название события');
        }
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Заголовок',
            'description' => 'Описание',
            'creator' => 'Создатель',
            'responsible' => 'Ответственный',
            'deadline' => 'Дедлайн',
            'email'=>'email',
            'isIterated' => 'Повторяется',
            'isBlocked' => 'Блокирующее событие (единственное в день)',
        ];
    }
}