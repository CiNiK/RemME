<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "card_field".
 *
 * @property integer $id
 * @property integer $card_id
 * @property integer $pattern_id
 * @property string $content
 */
class CardField extends \yii\db\ActiveRecord
{
	public function __construct($pattern = null)
	{
		parent::__construct();
		if($pattern != null)
		{
			$this->pattern_id = $pattern->id;
			$this->side = $pattern->side;
		}
	}

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'card_field';
    }
	
	public function getCard()
    {
        return $this->hasOne(Card::className(), ['id' => 'card_id']);
    }
	
	public function getPattern()
    {
        return $this->hasOne(Pattern::className(), ['id' => 'pattern_id']);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['card_id', 'pattern_id', 'content','side'], 'required'],
            [['card_id', 'pattern_id'], 'integer'],
            [['content'], 'string','max' => 300]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'card_id' => Yii::t('app', 'Card ID'),
            'pattern_field_id' => Yii::t('app', 'Pattern'),
            'content' => Yii::t('app', 'Content'),
			'side' => Yii::t('app', 'Side'),
        ];
    }
}
