<?php

/**
 * This is the model class for table "member".
 *
 * The followings are the available columns in table 'member':
 * @property integer $mem_id
 * @property string $mem_username
 * @property string $mem_password
 * @property string $mem_fname
 * @property string $mem_lname
 * @property string $mem_mobile
 * @property string $mem_email
 * @property string $mem_date
 * @property string $mem_status
 * @property string $mem_authen
 */
class Member extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'member';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mem_username, mem_password, mem_fname, mem_lname, mem_mobile, mem_email, mem_date, mem_status, mem_authen', 'required'),
			array('mem_username, mem_password, mem_fname, mem_lname, mem_email', 'length', 'max'=>50),
			array('mem_mobile', 'length', 'max'=>15),
			array('mem_status, mem_authen', 'length', 'max'=>8),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('mem_id, mem_username, mem_password, mem_fname, mem_lname, mem_mobile, mem_email, mem_date, mem_status, mem_authen', 'safe', 'on'=>'search'),
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
			'mem_id' => 'Mem',
			'mem_username' => 'Mem Username',
			'mem_password' => 'Mem Password',
			'mem_fname' => 'Mem Fname',
			'mem_lname' => 'Mem Lname',
			'mem_mobile' => 'Mem Mobile',
			'mem_email' => 'Mem Email',
			'mem_date' => 'Mem Date',
			'mem_status' => 'Mem Status',
			'mem_authen' => 'Mem Authen',
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

		$criteria->compare('mem_id',$this->mem_id);
		$criteria->compare('mem_username',$this->mem_username,true);
		$criteria->compare('mem_password',$this->mem_password,true);
		$criteria->compare('mem_fname',$this->mem_fname,true);
		$criteria->compare('mem_lname',$this->mem_lname,true);
		$criteria->compare('mem_mobile',$this->mem_mobile,true);
		$criteria->compare('mem_email',$this->mem_email,true);
		$criteria->compare('mem_date',$this->mem_date,true);
		$criteria->compare('mem_status',$this->mem_status,true);
		$criteria->compare('mem_authen',$this->mem_authen,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Member the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
