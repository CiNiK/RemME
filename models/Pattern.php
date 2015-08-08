<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "pattern".
 *
 * @property integer $id
 * @property integer $deck_id
 * @property integer $position
 * @property string $side
 * @property string $name
 * @property boolean $key
 */
class Pattern extends \yii\db\ActiveRecord
{
	private $fullName = null;
	public function __construct()
	{
		parent::__construct();
		$this->on(Pattern::EVENT_AFTER_INSERT,function(){
			foreach(Card::find()->where(['deck_id'=>$this->deck_id])->all() as $card)
			{
				$field = new CardField();
				$field->card_id = $card->id;
				$field->pattern_id = $this->id;
				$field->side = $this->side;
				$field->save(false);
			}
		});
		$this->on(Pattern::EVENT_AFTER_DELETE,function(){
			CardField::deleteAll(['pattern_id'=>$this->id]);
		});
	}
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pattern';
    }
	
	public function getDeck()
    {
        return $this->hasOne(Deck::className(), ['id' => 'deck_id']);
    }
	
	public function getIsFirst()
	{
		return ($this->position === 1);
	}
	
	public function getIsLast()
	{
		return ($this->position == Pattern::find()->where(['deck_id'=>$this->deck_id,'side'=>$this->side])->max('position'));
	}

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['deck_id', 'side', 'name'], 'required'],
            [['id', 'deck_id', 'position'], 'integer'],
            [['side','style'], 'string'],
			[['key'],'boolean'],
            [['name'], 'string', 'min'=>3,'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'deck_id' => Yii::t('app', 'Deck ID'),
            'position' => Yii::t('app', 'Position'),
            'side' => Yii::t('app', 'Side'),
            'name' => Yii::t('app', 'Name'),
			'key'=>Yii::t('app','Key'),
			'style'=>Yii::t('app','Style'),
        ];
    }
	
	/**
     * @inheritdoc
    */
    public function behaviors()
    {
        return [
			[       
				'class' => 'yii\behaviors\AttributeBehavior',
				'attributes' => [
					ActiveRecord::EVENT_BEFORE_INSERT => 'position',
              	],
				'value' => function ($event) {
					return self::find()->where(['deck_id'=>$this->deck_id,'side'=>$this->side])->max('position') + 1;
             	},
			],
			[       
				'class' => 'yii\behaviors\AttributeBehavior',
				'attributes' => [
					ActiveRecord::EVENT_BEFORE_VALIDATE => 'key',
              	],
				'value' => function ($event) {
					if($this->key == 1)
						Pattern::updateAll(['key' => false],['deck_id'=>$this->deck_id]);
					return $this->key;
				},
			],
        ];
    }
}
