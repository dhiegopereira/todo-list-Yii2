<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\SignupForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <?php if (Yii::$app->session->hasFlash('signupSuccess')): ?>
        <div class="alert alert-success">
            <?= Yii::$app->session->getFlash('signupSuccess') ?>
        </div>
        <script>
            setTimeout(function () {
                window.location.href = '<?= \yii\helpers\Url::to(['login']) ?>';
            }, 5000); // 5000 milliseconds = 5 seconds
        </script>
    <?php else: ?>

        <div class="row">
            <div class="col-lg-5">

                <?php $form = ActiveForm::begin([
                    'id' => 'signup-form',
                    'fieldConfig' => [
                        'template' => "{label}\n{input}\n{error}",
                        'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
                        'inputOptions' => ['class' => 'col-lg-3 form-control'],
                        'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
                    ],
                ]); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email')->textInput(['type' => 'email']) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <div class="form-group">
                    <div>
                        <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    <?php endif; ?>
</div>