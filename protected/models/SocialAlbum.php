<?php

/**
 * This is the model class for table "social_album".
 *
 * The followings are the available columns in table 'social_album':
 * @property integer $alb_id
 * @property string $alb_picture
 * @property string $alb_date
 * @property integer $soc_id
 */
class SocialAlbum extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'social_album';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('alb_picture, alb_date, soc_id', 'required'),
			array('soc_id', 'numerical', 'integerOnly'=>true),
			array('alb_picture', 'length', 'max'=>150),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('alb_id, alb_picture, alb_date, soc_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'alb_id' => 'Alb',
			'alb_picture' => 'Alb Picture',
			'alb_date' => 'Alb Date',
			'soc_id' => 'Soc',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('alb_id',$this->alb_id);
		$criteria->compare('alb_picture',$this->alb_picture,true);
		$criteria->compare('alb_date',$this->alb_date,true);
		$criteria->compare('soc_id',$this->soc_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SocialAlbum the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
