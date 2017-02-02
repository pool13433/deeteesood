<?php

/**
 * This is the model class for table "brand".
 *
 * The followings are the available columns in table 'brand':
 * @property integer $bra_id
 * @property string $bra_name
 * @property string $bra_desc
 * @property string $bra_picture
 * @property string $bra_date
 * @property string $bra_status
 *
 * The followings are the available model relations:
 * @property Product[] $products
 */
class Brand extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'brand';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('bra_name, bra_desc, bra_picture, bra_date, bra_status', 'required'),
			array('bra_name', 'length', 'max'=>150),
			array('bra_picture', 'length', 'max'=>50),
			array('bra_status', 'length', 'max'=>8),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('bra_id, bra_name, bra_desc, bra_picture, bra_date, bra_status', 'safe', 'on'=>'search'),
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
			'products' => array(self::HAS_MANY, 'Product', 'bra_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'bra_id' => 'Bra',
			'bra_name' => 'Bra Name',
			'bra_desc' => 'Bra Desc',
			'bra_picture' => 'Bra Picture',
			'bra_date' => 'Bra Date',
			'bra_status' => 'Bra Status',
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

		$criteria->compare('bra_id',$this->bra_id);
		$criteria->compare('bra_name',$this->bra_name,true);
		$criteria->compare('bra_desc',$this->bra_desc,true);
		$criteria->compare('bra_picture',$this->bra_picture,true);
		$criteria->compare('bra_date',$this->bra_date,true);
		$criteria->compare('bra_status',$this->bra_status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Brand the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
