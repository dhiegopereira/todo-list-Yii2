<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\Task $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Task';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-task">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to add a task:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'task-form']); ?>

            <?= $form->field($model, 'task')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'dueDate')->input('datetime-local') ?>
            <?= $form->field($model, 'priority')->input('number') ?>
            <?= $form->field($model, 'status')->dropDownList([
                'pending' => 'Pending',
                'in_progress' => 'In Progress',
                'completed' => 'Completed',
            ]) ?>

            <div class="form-group">
                <?= Html::submitButton('Add Task', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
