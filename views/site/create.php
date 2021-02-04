<?php

/* @var $tagsModel common\models\Category */

$this->title = 'Company';
use yii\helpers\Html;
?>

<form method="post">
    <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>">
    <div class=" form-group">
        <label for="name">Company Name</label>
        <input type="text" class="form-control" id="name"  name="Company[name]"
               maxlength="200" aria-required="true">
    </div>

    <div class="form-group">
        <label for="address"> Address</label>
        <input type="text" class="form-control" id="email" name="Company[address]" maxlength="200"
               aria-required="true" >
    </div>

    <div class="form-group">
        <label for="phone">Phone number</label>
        <input type="text" class="form-control" id="phone" name="Company[phone]" maxlength="200"
               aria-required="true" >
    </div>


    <div class="form-group">
        <label for="category">Select Category</label>
        <select multiple class="form-control" name="category[]" id="category">
            <?php
            foreach ( $category as $categoryData) {
                echo '<option value="' . $categoryData->id . '">' . $categoryData->name . '</option>';
            }
            ?>
        </select>
    </div>

    <div class="alert">
       <a href="/category/create" class="link">Create Another Category</a>
    </div>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>


</form>
