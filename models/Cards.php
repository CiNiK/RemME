<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cards".
 *
 * @property string $id
 * @property string $deck_id
 * @property string $content
 * @property integer $field_id
 * @property string $created
 * @property string $name
 */
class Cards extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cards';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'deck_id', 'field_id'], 'integer'],
            [['deck_id', 'content', 'name'], 'required'],
            [['content'], 'string'],
            [['created'], 'safe'],
            [['name'], 'string', 'max' => 100]
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
            'content' => Yii::t('app', 'Content'),
            'field_id' => Yii::t('app', 'Field ID'),
            'created' => Yii::t('app', 'Created'),
            'name' => Yii::t('app', 'Name'),
        ];
    }
}
