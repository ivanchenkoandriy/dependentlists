<?php

namespace app\actions;

use Yii;
use yii\base\Action;
use app\models\AddCarForm;

class AddCarAction extends Action
{
    public function run()
    {
        $adder = new AddCarForm();
        $adder->load(Yii::$app->request->post());
        if (!$adder->execute()) {
            Yii::$app->session->setFlash('form-danger', Yii::t('app', 'Can`t add the car. Error: "{error}".', [
                'error' => current($adder->getFirstErrors()),
            ]));

            return $this->controller->redirect(['site/index']);
        }

        Yii::$app->session->setFlash('form-success', Yii::t('app', 'Your car has been added successfully.'));

        return $this->controller->redirect(['site/index']);
    }
}
