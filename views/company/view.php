<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Company */
/* @var $Arr */
/* @var $categoryModel common\models\CompanyCategory */

// $this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Companies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="company-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if (Yii::$app->user->id == $model->createdBy->id) { ?>
        <p>
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    <?php } ?>
    <table  class="table table-striped table-bordered detail-view">
        <tr>
            <th>Name</th>
            <td colspan="2"><?= $model->name ?></td>
        </tr>
        <tr>
            <th>Address</th>
            <td colspan="2"><?= $model->address ?></td>
        </tr>
        <tr>
            <th>Phone</th>
            <td colspan="2" ><?= $model->phone ?></td>
        </tr>
        <tr>
            <th>Created by</th>
            <td colspan="2"><?= $model->createdBy->username ?></td>
        </tr>
        <tr>
            <th>Created At</th>
            <td colspan="2"><?= $model->created_at ?></td>
        </tr>
        <tr>
            <th>Updated At</th>
            <td colspan="2"><?= $model->updated_at ?></td>
        </tr>
        <tr>
            <th>Category</th>
            <?php
            foreach ($Arr as $category) {
                ?>
            <td><?= $category[1] ?> </td>
                <?php
            }
            ?>
        </tr>

    </table>






