<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\SignupForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Cadastrar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Por favor, preencha os seguintes campos para se cadastrar:</p>

    <?php if (Yii::$app->session->hasFlash('signupSuccess')): ?>
        <div class="alert alert-success">
            <?= Yii::$app->session->getFlash('signupSuccess') ?>
        </div>
        <script>
            setTimeout(function () {
                window.location.href = '<?= \yii\helpers\Url::to(['login']) ?>';
            }, 5000);
        </script>
    <?php else: ?>

        <div class="row">
            <div class="col-lg-5">

                <?php $form = ActiveForm::begin([
                    'id' => 'signup-form',
                    'fieldConfig' => [
                        'template' => "{label}\n{input}\n{error}",
                        'labelOptions' => ['class' => 'col-lg-4 col-form-label'],
                        'inputOptions' => ['class' => 'col-lg-8 form-control'],
                        'errorOptions' => ['class' => 'col-lg-12 invalid-feedback'],
                    ],
                ]); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('Usuário') ?>

                <?= $form->field($model, 'email')->textInput(['type' => 'email'])->label('Email') ?>

                <?= $form->field($model, 'password')->passwordInput()->label('Senha') ?>

                <div class="form-group">
                    <div>
                        <?= Html::submitButton('Cadastrar', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>

                <p>Já tem uma conta? <?= Html::a('Faça login aqui', ['/login']) ?>.</p>

            </div>
        </div>
    <?php endif; ?>
</div>