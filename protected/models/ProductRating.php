<?php

/**
 * This is the model class for table "product_rating".
 *
 * The followings are the available columns in table 'product_rating':
 * @property integer $rat_id
 * @property integer $rat_level
 * @property string $rat_type
 * @property integer $prod_id
 * @property string $rat_ip
 * @property string $rat_date
 */
class ProductRating extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'product_rating';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('rat_type, prod_id, rat_ip, rat_date', 'required'),
            array('rat_level, prod_id', 'numerical', 'integerOnly' => true),
            array('rat_type', 'length', 'max' => 4),
            array('rat_ip', 'length', 'max' => 40),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('rat_id, rat_level, rat_type, prod_id, rat_ip, rat_date', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'rat_id' => 'Rat',
            'rat_level' => 'Rat Level',
            'rat_type' => 'Rat Type',
            'prod_id' => 'Prod',
            'rat_ip' => 'Rat Ip',
            'rat_date' => 'Rat Date',
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

        $criteria->compare('rat_id', $this->rat_id);
        $criteria->compare('rat_level', $this->rat_level);
        $criteria->compare('rat_type', $this->rat_type, true);
        $criteria->compare('prod_id', $this->prod_id);
        $criteria->compare('rat_ip', $this->rat_ip, true);
        $criteria->compare('rat_date', $this->rat_date, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ProductRating the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
