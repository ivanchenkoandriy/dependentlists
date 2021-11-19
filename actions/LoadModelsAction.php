<?php

namespace app\actions;

use Yii;
use yii\base\Action;
use app\models\Model;
use yii\data\ActiveDataProvider;

class LoadModelsAction extends Action
{
    public function run(int $brandId)
    {
        $request = Yii::$app->request;

        $query = Model::find()->where(['brand_id' => $brandId]);
        $term = $request->get('term');
        if ($term) {
            $query->andFilterWhere(['like', 'name', $term]);
        }

        $provider = new ActiveDataProvider([
            'query' => $query
        ]);

        $page = $request->get('page');
        if (!is_null($page)) {
            $provider->pagination->setPage($page - 1);
        }

        $models = $provider->getModels();

        $carModels = array_map(function (Model $model) {
            return [
                'id' => $model->id,
                'text' => $model->name,
            ];
        }, $models);

        return $this->controller->asJson([
            'results' => $carModels,
            'pagination' => [
                'more' => $provider->pagination->pageCount > $provider->pagination->page + 1
            ],
            'term' => $term
        ]);
    }
}
