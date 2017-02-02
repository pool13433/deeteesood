<?php

/**
 * This is the model class for table "car_model".
 *
 * The followings are the available columns in table 'car_model':
 * @property integer $mod_id
 * @property string $mod_name
 * @property string $mod_desc
 * @property string $mod_date
 * @property string $mod_status
 * @property integer $bra_id
 */
class CarModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'car_model';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mod_name, mod_desc, mod_date, mod_status, bra_id', 'required'),
			array('bra_id', 'numerical', 'integerOnly'=>true),
			array('mod_name', 'length', 'max'=>100),
			array('mod_status', 'length', 'max'=>8),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('mod_id, mod_name, mod_desc, mod_date, mod_status, bra_id', 'safe', 'on'=>'search'),
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
			'mod_id' => 'Mod',
			'mod_name' => 'Mod Name',
			'mod_desc' => 'Mod Desc',
			'mod_date' => 'Mod Date',
			'mod_status' => 'Mod Status',
			'bra_id' => 'Bra',
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

		$criteria->compare('mod_id',$this->mod_id);
		$criteria->compare('mod_name',$this->mod_name,true);
		$criteria->compare('mod_desc',$this->mod_desc,true);
		$criteria->compare('mod_date',$this->mod_date,true);
		$criteria->compare('mod_status',$this->mod_status,true);
		$criteria->compare('bra_id',$this->bra_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CarModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
