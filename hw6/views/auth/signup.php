<?php

 /* @var $model \app\models\Users */

?>
<div class="row">
    <div class="col-md-6">
        <h2>Регистрация</h2>
        <?php $form=\yii\bootstrap\ActiveForm::begin();?>

            <?=$form->field($model, 'email')?>
            <?=$form->field($model, 'password')?>

            <div class="form-group">
                <button type="submit" class="btn btn-default">Регистрация</button>
            </div>

        <?php \yii\bootstrap\ActiveForm::end();?>
    </div>
</div>
