<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Company */

$this->title = 'Update Company: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Companies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="company-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if(Yii::$app->user->id == $model->createdBy->id) { ?>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    <?php } else { echo "You have no access to update this company's data";} ?>
</div>
