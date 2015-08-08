<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\models\CardField;

/**
 * This is the model class for table "card".
 *
 * @property string $id
 * @property string $deck_id
 * @property string $created
 * @property string $changed
 * @property array $fields
 */
class Card extends \yii\db\ActiveRecord
{
	private $frontFields = null;
	private $backFields = null;
	private $keyField = null;
	
	public function __construct($deck_id = null)
	{
		parent::__construct();
		if($deck_id != null)
		{
			$this->deck_id = $deck_id;
			foreach(Pattern::find()->select(['id','side'])->where(['deck_id'=>$deck_id])->limit(100)->all() as $pattern)
			{
				if($pattern->side === 'front')
					$this->frontFields[] = new CardField($pattern);
				else
					$this->backFields[] = new CardField($pattern);
			}
		}
	}
		
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'card';
    }
	
	public function getFrontFields()
    {
		if($this->frontFields == null)
			$this->frontFields = CardField::find()->joinWith('pattern')->where(['card_field.card_id' => $this->id,'card_field.side' => 'front'])->orderBy(['pattern.position'=> 'ASC'])->all();
		return $this->frontFields;
    }
	
	public function getBackFields()
    {
		if($this->backFields == null)
			$this->backFields = CardField::find()->joinWith('pattern')->where(['card_field.card_id' => $this->id,'card_field.side' => 'back'])->orderBy(['pattern.position'=> 'ASC'])->all();
		return $this->backFields;
    }

	public function getDeck()
    {
        return $this->hasOne(Deck::className(), ['id' => 'deck_id']);
    }
	
	public function getKeyField()
	{
		if($this->keyField == null)
			$this->keyField = Cards::find()->where(['id' => $this->id])->one();
		return $this->keyField;
	}
	
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'deck_id'], 'required'],
            [['id', 'deck_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
			'keyField'=> $this->keyField,
            'deck_id' => Yii::t('app', 'Deck ID'),
            'created' => Yii::t('app', 'Created at'),
            'changed' => Yii::t('app', 'Changed at'),
        ];
    }
	
	/**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class'      => 'yii\behaviors\TimestampBehavior',
                'value'      => function () { return date("Y-m-d H:i:s"); },
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'created',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'changed',
                ],
			],
        ];
    }

}
