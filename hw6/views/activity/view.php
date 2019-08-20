<?php
/**
 * @var \app\models\Activity $model
 */

?>
<p>Заголовок <strong><?=$model->title; ?></strong></p>

<p><?=$model->description;?></p>
<p>Принадлежит: <?=$model->user->email;?></p>