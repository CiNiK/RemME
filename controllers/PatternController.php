<?php

namespace app\controllers;

use Yii;
use app\models\Pattern;
use app\models\Deck;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PatternController implements the CRUD actions for Pattern model.
 */
class PatternController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Pattern models.
     * @return mixed
     */
    public function actionIndex($deck_id)
    {
        $frontDataProvider = new ActiveDataProvider([
            'query' => Pattern::find()
				->where([
					'deck_id'	=> $deck_id,
					'side'		=> 'front',
				])
				->orderBy('position'),
			'sort'=>[
				'attributes'=>['name']
			],
        ]);
		
		$backDataProvider = new ActiveDataProvider([
            'query' => Pattern::find()
				->where([
					'deck_id'	=> $deck_id,
					'side'		=> 'back',
				])
				->orderBy('position'),
        ]);

        return $this->render('index', [
            'frontDataProvider' => $frontDataProvider,
			'backDataProvider' => $backDataProvider,
			'deck'	=> Deck::findOne($deck_id),
        ]);
    }

    /**
     * Displays a single Pattern model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Pattern model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($deck_id,$side)
    {
        $model = new Pattern();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->render('create',['model' => $model]);//$this->redirect(['index', 'deck_id' => $model->deck_id]);
        } else { 
			$model->side = $side;
			$model->deck_id = $deck_id;
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Pattern model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->render('update',['model' => $model]);//$this->redirect(['index', 'deck_id' => $model->deck_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Pattern model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
		$this->updatePositions($model->deck_id,$model->side,$model->position);
		$model->delete();
        return $this->redirect(['index']);
    }
	
	public function actionUp($id)
	{
		$currentModel = $this->findModel($id);
		$upperModel = Pattern::find()
			->where([
				'deck_id' 	=> $currentModel->deck_id,
				'side' 		=> $currentModel->side, 
				'position'	=> $currentModel->position-1,
				])
			->one()
			->updateCounters(['position'=> 1]);
		$currentModel->updateCounters(['position' => -1]);
		return $this->redirect(['index','deck_id' => $currentModel->deck_id]);
	}
	
	public function actionDown($id)
	{
		$currentModel = $this->findModel($id);
		$downModel = Pattern::find()
			->where([
				'deck_id' 	=> $currentModel->deck_id,
				'side' 		=> $currentModel->side, 
				'position'	=> $currentModel->position+1,
				])
			->one()
			->updateCounters(['position'=> -1]);
		$currentModel->updateCounters(['position' => 1]);
		return $this->redirect(['index','deck_id' => $currentModel->deck_id]);
	}
	
	protected function updatePositions($deck_id,$side,$position)
	{
		$models = Pattern::find()
			->where([
				'deck_id' 	=> $deck_id,
				'side' 		=> $side, 
				])
			->andWhere(['>', 'position', $position])
			->all();
		foreach($models as $model)
			$model->updateCounters(['position' => -1]);
	}

    /**
     * Finds the Pattern model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pattern the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pattern::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
