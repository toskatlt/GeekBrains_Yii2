<?php
/**
 * @var \app\models\Activity $model
 */

?>
<p>Заголовок <strong><?=$model->title?></strong></p>

<?=\yii\helpers\Html::tag('span','');?>

<?=\yii\helpers\Html::img('/images/'.$model->image, ['width'=>150]);?>
