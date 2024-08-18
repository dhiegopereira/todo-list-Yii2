<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\Task $model */
/** @var app\models\Task[] $tasks */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Gerenciamento de Tarefas';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-task">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Por favor, preencha os seguintes campos para <?= $model->isNewRecord ? 'adicionar' : 'atualizar' ?> uma tarefa:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'task-form', 'action' => $model->isNewRecord ? ['task/create'] : ['task/update', 'id' => $model->id]]); ?>
            <?= $form->field($model, 'title')->textInput(['autofocus' => true])->label('Título') ?>
            <?= $form->field($model, 'description')->textarea(['rows' => 4])->label('Descrição') ?>
            <?= $form->field($model, 'status')->dropDownList([
                'pending' => 'Pendente',
                'in_progress' => 'Em Andamento',
                'completed' => 'Concluída',
            ])->label('Status') ?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Adicionar Tarefa' : 'Atualizar Tarefa', ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Cancelar', ['index'], ['class' => 'btn btn-secondary']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>

    <h2>Lista de Tarefas</h2>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Título</th>
                <th>Descrição</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($tasks)): ?>
                <?php foreach ($tasks as $task): ?>
                    <tr>
                        <td><?= Html::encode($task->title) ?></td>
                        <td><?= Html::encode($task->description) ?></td>
                        <td><?= Html::encode($task->status) ?></td>
                        <td>
                            <?= Html::a('Editar', ['task/update', 'id' => $task->id], ['class' => 'btn btn-secondary']) ?>
                            <?= Html::a('Excluir', ['task/delete', 'id' => $task->id], [
                                'class' => 'btn btn-danger',
                                'data-method' => 'post',
                                'data-confirm' => 'Tem certeza de que deseja excluir esta tarefa?',
                                'data-pjax' => '0',
                            ]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">Nenhuma tarefa encontrada.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php if (Yii::$app->session->hasFlash('taskSuccess')): ?>
    <div class="alert alert-success">
        <?= Yii::$app->session->getFlash('taskSuccess') ?>
    </div>
<?php endif; ?>

<?php if (Yii::$app->session->hasFlash('taskError')): ?>
    <div class="alert alert-danger">
        <?= Yii::$app->session->getFlash('taskError') ?>
    </div>
<?php endif; ?>
