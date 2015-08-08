<?php

namespace app\controllers;

use Yii;
use app\models\Deck;
use app\models\Pattern;
use app\models\Card;
use app\models\Cards;
use app\models\CardsSearch;
use app\models\CardField;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * CardController implements the CRUD actions for Card model.
 */
class CardController extends Controller
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
     * Lists all Card models in Deck.
     * @return mixed
     */
    public function actionIndex($deck_id)
    {
		$searchModel = new CardsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());
        /*$dataProvider = new ActiveDataProvider([
            'query' => Cards::find()->where(['deck_id'=>$deck_id]),
			'sort' => [
				'attributes' => ['content']
    ],
        ]);*/

        return $this->render('index', [
            'dataProvider' 	=> $dataProvider,
			'searchModel'	=> $searchModel,
			'deck'			=> Deck::findOne($deck_id),
        ]);
    }

    /**
     * Displays a single Card model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Card model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($deck_id)
    {
        $model = new Card();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			foreach(Yii::$app->request->post('CardField') as $attributes)
			{
				$field = new CardField();
				$field->card_id = $model->id;
				$field->attributes = $attributes;
				$field->save();
			}	
            return $this->redirect(['create', 'deck_id' => $model->deck_id]);
        } else {
			$model = new Card($deck_id);
			return $this->render('create', [
				'model'	=> $model,
			]);
		}
    }
	
	public function actionNext($deck_id)
	{
		$session = Yii::$app->session;
		$session->open();
		if(!$session->has('cards'))
		{
			$cards = Card::find()->select('id')->where(['deck_id'=>$deck_id])->asArray()->all();
			$cards = ArrayHelper::getColumn($cards,'id');
			shuffle($cards);
			$session->set('cards', $cards);
		}
		$cards = $session->get('cards');
		$id = ArrayHelper::remove($cards,key($cards));
		$model = $this->findModel($id);
		count($cards) == 0 ? $session->remove('cards'): $session->set('cards', $cards);
		$session->close();
		return $this->render('_view',[
				'model'=>$model
			]);
	}

    /**
     * Updates an existing Card model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Card model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Card model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Card the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Card::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
