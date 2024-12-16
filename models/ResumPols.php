<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "resum_pols".
 *
 * @property int $id
 * @property string $name
 * @property string $photo
 * @property string $experience
 * @property string $email
 * @property string $phone
 * @property string $description
 * @property string $drug_spec_discrip
 * @property int $specialization
 * @property int $user_id
 * @property string $status
 *
 * @property Special $specialization0
 * @property User $user
 */
class ResumPols extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'resum_pols';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'photo', 'experience', 'email', 'phone', 'description', 'specialization'], 'required'],
            [['specialization', 'user_id'], 'integer'],
            [['status'], 'string'],
            [['name', 'experience', 'email', 'phone', 'description', 'drug_spec_discrip'], 'string', 'max' => 255],
            ['photo', 'file', 'extensions' => 'png, jpg, jpeg'],
            [['specialization'], 'exist', 'skipOnError' => true, 'targetClass' => Special::class, 'targetAttribute' => ['specialization' => 'id_spec']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'photo' => 'Photo',
            'experience' => 'Experience',
            'email' => 'Email',
            'phone' => 'Phone',
            'description' => 'Description',
            'drug_spec_discrip' => 'Drug Spec Discrip',
            'specialization' => 'Specialization',
            'user_id' => 'User ID',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Specialization0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpecialization0()
    {
        return $this->hasOne(Special::class, ['id_spec' => 'specialization']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
