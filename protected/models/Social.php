<?php

/**
 * This is the model class for table "social".
 *
 * The followings are the available columns in table 'social':
 * @property integer $soc_id
 * @property string $soc_title
 * @property string $soc_desc
 * @property string $soc_eventdate
 * @property string $soc_date
 * @property string $soc_status
 */
class Social extends CActiveRecord {
    
    public $albums = array();
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'social';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('soc_title, soc_desc, soc_eventdate, soc_date, soc_status', 'required'),
            array('soc_title', 'length', 'max' => 255),
            array('soc_status', 'length', 'max' => 8),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('soc_id, soc_title, soc_desc, soc_eventdate, soc_date, soc_status', 'safe', 'on' => 'search'),
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
            'soc_id' => 'Soc',
            'soc_title' => 'Soc Title',
            'soc_desc' => 'Soc Desc',
            'soc_eventdate' => 'Soc Eventdate',
            'soc_date' => 'Soc Date',
            'soc_status' => 'Soc Status',
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

        $criteria->compare('soc_id', $this->soc_id);
        $criteria->compare('soc_title', $this->soc_title, true);
        $criteria->compare('soc_desc', $this->soc_desc, true);
        $criteria->compare('soc_eventdate', $this->soc_eventdate, true);
        $criteria->compare('soc_date', $this->soc_date, true);
        $criteria->compare('soc_status', $this->soc_status, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Social the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
