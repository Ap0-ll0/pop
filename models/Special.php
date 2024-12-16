<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "special".
 *
 * @property int $id_spec
 * @property string $name_spec
 *
 * @property ResumPols[] $resumPols
 */
class Special extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'special';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_spec'], 'required'],
            [['name_spec'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_spec' => 'Id Spec',
            'name_spec' => 'Name Spec',
        ];
    }

    /**
     * Gets query for [[ResumPols]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResumPols()
    {
        return $this->hasMany(ResumPols::class, ['specialization' => 'id_spec']);
    }
}
