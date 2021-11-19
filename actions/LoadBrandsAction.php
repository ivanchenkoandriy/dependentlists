<?php

namespace app\actions;

use Yii;
use yii\base\Action;
use app\models\Brand;
use yii\data\ActiveDataProvider;

class LoadBrandsAction extends Action
{
    public function run()
    {
        $request = Yii::$app->request;

        $query = Brand::find();
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

        $brands = array_map(function (Brand $brand) {
            return [
                'id' => $brand->id,
                'text' => $brand->name,
            ];
        }, $models);

        return $this->controller->asJson([
            'results' => $brands,
            'pagination' => [
                'more' => $provider->pagination->pageCount > $provider->pagination->page + 1
            ],
            'term' => $term
        ]);
    }
}
