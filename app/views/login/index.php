<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\web\YiiAsset;

$this->title = 'Entrar';
$this->params['breadcrumbs'][] = $this->title;

YiiAsset::register($this);

if (Yii::$app->session->hasFlash('loginSuccess')) {
    $this->registerJs("window.location.href = '" . Yii::$app->urlManager->createUrl('task/index') . "';");
}
?>

<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Por favor, preencha os seguintes campos para fazer o login:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'fieldConfig' => [
                    'template' => "{label}\n{input}\n{error}",
                    'labelOptions' => ['class' => 'col-lg-4 col-form-label'],
                    'inputOptions' => ['class' => 'col-lg-8 form-control'],
                    'errorOptions' => ['class' => 'col-lg-12 invalid-feedback'],
                ],
            ]); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('Usuário') ?>

            <?= $form->field($model, 'password')->passwordInput()->label('Senha') ?>

            <div class="form-group">
                <?= Html::submitButton('Entrar', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>

            <div class="mt-3">
                <p>Não tem uma conta? <?= Html::a('Inscreva-se aqui', ['/signup']) ?>.</p>
            </div>
        </div>
    </div>
</div>
