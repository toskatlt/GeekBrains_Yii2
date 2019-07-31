<?php
/**
 * @var \app\models\Activity $model
 */

use yii\bootstrap\ActiveForm;

?>
<h2>Create activity</h2>

<?php $form = ActiveForm::begin([]) ?>
<? //= Yii::getAlias('@app'); ?><!--<br>-->
<? //= Yii::getAlias('@webroot'); ?><!--<br>-->
<?= $form->field($model, 'title'); ?>
<?= $form->field($model, 'description')->textarea(); ?>
<?= $form->field($model, 'creator')->textarea(); ?>
<?= $form->field($model, 'responsible')->textarea(); ?>
<!--/ В формате HTML5 нежелательно, т.к. отправка в разных форматах м.б., лучше любой виджет js-->
<?= $form->field($model, 'deadline')->input('text'); ?>
<?= $form->field($model, 'isIterated')->checkbox(); ?>
<?=$form->field($model,'iteratedType')->dropDownList($model::REPEAT_TYPE)?>
<?= $form->field($model, 'isBlocked')->checkbox(); ?>

<?= $form->field($model, 'useNotification')->checkbox(); ?>
<?= $form->field($model, 'email', ['enableAjaxValidation' => true, 'enableClientValidation' => false]); ?>
<?= $form->field($model, 'emailRepeat'); ?>

<?= $form->field($model,'image')->fileInput()?>

<div class="form-group">
    <button class="btn btn-default" type="submit">Создать</button>
</div>
<?php ActiveForm::end(); ?>
