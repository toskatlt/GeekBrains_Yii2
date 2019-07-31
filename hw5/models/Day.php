<?php
namespace app\models;


class Day
{
  public $isWorking;
  public $isWeekend;
  public $activities = [];

  public function rules()
  {
    return [
        ['activities', 'required'],
        [['isWorking', 'isWeekend'], 'boolean']
    ];
  }

  public function attributeLabels()
  {
    return [
        'isWorking' => 'Рабочий день',
        'isWeekend' => 'Выходной день',
        'activities' => 'События'
    ];
  }

  /**
   * @param mixed $model
   */
  public function setActivities(Activity $model): void
  {
    $this->activities[] = $model;
  }


}