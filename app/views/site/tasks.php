<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $table */

/** @var app\models\Tasklist $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Task';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-tasks">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to add a task:</p>

    <div class="row">
        <div class="col-lg-5">

            <?php $table = ActiveForm::begin([
                'id' => 'task-list',
                'fieldConfig' => [
                    'template' => "{label}\n{input}\n{error}",
                    'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
                    'inputOptions' => ['class' => 'col-lg-3 form-control'],
                    'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
                ],
            ]); ?>

            <?= $table->field($model, 'task')->textInput(['autofocus' => true]) ?>

            <?= $table->field($model, 'dueDate')->textInput() ?>

            <?= $table->field($model, 'priority')->textInput() ?>

            <?= $table->field($model, 'status')->textInput() ?>

            <div class="form-group">
                <div>
                    <?= Html::submitButton('Add Task', ['class' => 'btn btn-primary', 'name' => 'add-task-button']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>