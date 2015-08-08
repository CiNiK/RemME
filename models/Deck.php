<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "deck".
 *
 * @property integer $id
 * @property string $owner_id
 * @property string $name
 * @property string $created
 * @property string $changed
 * @property string $cardsQty
 */
class Deck extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'deck';
    }

	public function getOwner()
    {
        return $this->hasOne(User::className(), ['id' => 'owner_id']);
    }
	
	public function getCards()
    {
        return $this->hasMany(Card::className(), ['deck_id' => 'id']);
    }
	
	public function getPattern()
	{
        return $this->hasMany(Pattern::className(), ['deck_id' => 'id']);
    }
	
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['id', 'owner_id', 'created', 'cardsQty'], 'integer'],
            [['name'], 'string','min' => 3, 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'owner_id' => Yii::t('app', 'Owner ID'),
            'name' => Yii::t('app', 'Name'),
            'created' => Yii::t('app', 'Created at'),
            'changed' => Yii::t('app', 'Changed at'),
            'cardsQty' => Yii::t('app', 'Cards'),
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
			'owner_id'	=> [       
				'class' => 'yii\behaviors\AttributeBehavior',
				'attributes' => [
					ActiveRecord::EVENT_BEFORE_INSERT => 'owner_id',
              	],
				'value' => function ($event) {
					return Yii::$app->user->getID();
             	},
			],
        ];
    }
}
