<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\NotFoundHttpException;

class Task extends ActiveRecord
{

    public static function tableName()
    {
        return 'task';
    }

    public function rules()
    {
        return [
            [['title', 'description', 'status', 'user_id'], 'required'],
            [['description'], 'string'],
            [['status'], 'string'],
            [['user_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    public static function findAllTasksByUser()
    {
        return self::find()->where(['user_id' => Yii::$app->user->id])->all();
    }

    public static function findTaskById($id)
    {
        if (($model = self::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('A página solicitada não existe.');
    }

    public function createTask()
    {
        $this->user_id = Yii::$app->user->id;

        if ($this->save()) {
            return true;
        } else {
            Yii::error('Erro ao criar tarefa: ' . json_encode($this->errors));
            return false;
        }
    }

    public function updateTask()
    {
        $model = self::findOne($this->id);
        if ($model !== null) {
            $model->title = $this->title;
            $model->description = $this->description;
            $model->status = $this->status;
            return $model->save();
        }
        return false;
    }


    public static function deleteTaskById($id)
    {
        $model = self::findTaskById($id);
        if ($model) {
            $model->delete();
        }
    }
}
