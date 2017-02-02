<?php

/**
 * This is the model class for table "slide".
 *
 * The followings are the available columns in table 'slide':
 * @property integer $sli_id
 * @property string $sli_title
 * @property string $sli_desc
 * @property string $sli_picture
 * @property string $sli_date
 * @property string $sli_status
 */
class Slide extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'slide';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sli_title, sli_desc, sli_picture, sli_date, sli_status', 'required'),
			array('sli_title', 'length', 'max'=>255),
			array('sli_picture', 'length', 'max'=>150),
			array('sli_status', 'length', 'max'=>8),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('sli_id, sli_title, sli_desc, sli_picture, sli_date, sli_status', 'safe', 'on'=>'search'),
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
			'sli_id' => 'Sli',
			'sli_title' => 'Sli Title',
			'sli_desc' => 'Sli Desc',
			'sli_picture' => 'Sli Picture',
			'sli_date' => 'Sli Date',
			'sli_status' => 'Sli Status',
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

		$criteria->compare('sli_id',$this->sli_id);
		$criteria->compare('sli_title',$this->sli_title,true);
		$criteria->compare('sli_desc',$this->sli_desc,true);
		$criteria->compare('sli_picture',$this->sli_picture,true);
		$criteria->compare('sli_date',$this->sli_date,true);
		$criteria->compare('sli_status',$this->sli_status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Slide the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
