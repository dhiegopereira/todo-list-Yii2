<?php

namespace app\models;

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

    public static function findAllTasks()
    {
        return self::find()->all();
    }

    public static function findTaskById($id)
    {
        if (($model = self::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function createTask()
    {
        $task = new Task();
        $task->title = $this->title;
        $task->description = $this->description;
        $task->status = $this->status;
        $task->user_id = $this->user_id;

        return $task->save();
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
