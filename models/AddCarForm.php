<?php

namespace app\models;

use Yii;

class AddCarForm extends Model implements CommandInterface
{
    public $brand;
    public $model;

    public function rules()
    {
        return [
            [['brand', 'model'], 'required'],
            [['brand', 'model'], 'integer'],
        ];
    }

    public function execute(): bool
    {
        if (!$this->validate()) {
            return false;
        }

        $car = new Car([
            'brand_id' => $this->brand,
            'model_id' => $this->model,
        ]);

        if (!$car->insert()) {
            $this->addError('', Yii::t('app', 'Can`t create the car. Error: "{error}".', [
                'error' => current($car->getFirstErrors()),
            ]));

            return false;
        }

        return true;
    }
}
