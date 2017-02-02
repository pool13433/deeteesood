<?php

/**
 * This is the model class for table "product".
 *
 * The followings are the available columns in table 'product':
 * @property integer $prod_id
 * @property string $prod_code
 * @property string $prod_name
 * @property string $prod_desc
 * @property integer $prod_price
 * @property string $prod_color
 * @property string $prod_engine
 * @property string $prod_gear
 * @property integer $mod_id
 * @property string $prod_year
 * @property integer $type_id
 * @property string $prod_picture
 * @property string $prod_date
 * @property string $prod_status
 * @property integer $cat_id
 * @property integer $bra_id
 *
 * The followings are the available model relations:
 * @property Category $cat
 * @property Brand $bra
 */
class Product extends CActiveRecord {

    public $albums = array();

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'product';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('prod_code, prod_name, prod_desc, prod_price, prod_color, prod_engine, prod_gear, prod_year, type_id, prod_picture, prod_date, prod_status, cat_id, bra_id', 'required'),
            array('prod_price, mod_id, type_id, cat_id, bra_id', 'numerical', 'integerOnly' => true),
            array('prod_code, prod_engine, prod_gear', 'length', 'max' => 30),
            array('prod_name', 'length', 'max' => 255),
            array('prod_color', 'length', 'max' => 50),
            array('prod_year', 'length', 'max' => 4),
            array('prod_picture', 'length', 'max' => 150),
            array('prod_status', 'length', 'max' => 8),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('prod_id, prod_code, prod_name, prod_desc, prod_price, prod_color, prod_engine, prod_gear, mod_id, prod_year, type_id, prod_picture, prod_date, prod_status, cat_id, bra_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'cat' => array(self::BELONGS_TO, 'Category', 'cat_id'),
            'bra' => array(self::BELONGS_TO, 'Brand', 'bra_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'prod_id' => 'Prod',
            'prod_code' => 'Prod Code',
            'prod_name' => 'Prod Name',
            'prod_desc' => 'Prod Desc',
            'prod_price' => 'Prod Price',
            'prod_color' => 'Prod Color',
            'prod_engine' => 'Prod Engine',
            'prod_gear' => 'Prod Gear',
            'mod_id' => 'Mod',
            'prod_year' => 'Prod Year',
            'type_id' => 'Type',
            'prod_picture' => 'Prod Picture',
            'prod_date' => 'Prod Date',
            'prod_status' => 'Prod Status',
            'cat_id' => 'Cat',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('prod_id', $this->prod_id);
        $criteria->compare('prod_code', $this->prod_code, true);
        $criteria->compare('prod_name', $this->prod_name, true);
        $criteria->compare('prod_desc', $this->prod_desc, true);
        $criteria->compare('prod_price', $this->prod_price);
        $criteria->compare('prod_color', $this->prod_color, true);
        $criteria->compare('prod_engine', $this->prod_engine, true);
        $criteria->compare('prod_gear', $this->prod_gear, true);
        $criteria->compare('mod_id', $this->mod_id);
        $criteria->compare('prod_year', $this->prod_year, true);
        $criteria->compare('type_id', $this->type_id);
        $criteria->compare('prod_picture', $this->prod_picture, true);
        $criteria->compare('prod_date', $this->prod_date, true);
        $criteria->compare('prod_status', $this->prod_status, true);
        $criteria->compare('cat_id', $this->cat_id);
        $criteria->compare('bra_id', $this->bra_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Product the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
