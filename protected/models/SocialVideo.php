<?php

/**
 * This is the model class for table "social_video".
 *
 * The followings are the available columns in table 'social_video':
 * @property integer $vid_id
 * @property string $vid_title
 * @property string $vid_desc
 * @property string $vid_eventdate
 * @property string $vid_url
 * @property string $vid_date
 * @property string $vid_status
 */
class SocialVideo extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'social_video';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('vid_title, vid_desc, vid_eventdate, vid_url, vid_date, vid_status', 'required'),
            array('vid_title, vid_url', 'length', 'max' => 255),
            array('vid_eventdate', 'length', 'max' => 15),
            array('vid_status', 'length', 'max' => 8),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('vid_id, vid_title, vid_desc, vid_eventdate, vid_url, vid_date, vid_status', 'safe', 'on' => 'search'),
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
            'vid_id' => 'Vid',
            'vid_title' => 'Vid Title',
            'vid_desc' => 'Vid Desc',
            'vid_eventdate' => 'Vid Eventdate',
            'vid_url' => 'Vid Url',
            'vid_date' => 'Vid Date',
            'vid_status' => 'Vid Status',
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

        $criteria->compare('vid_id', $this->vid_id);
        $criteria->compare('vid_title', $this->vid_title, true);
        $criteria->compare('vid_desc', $this->vid_desc, true);
        $criteria->compare('vid_eventdate', $this->vid_eventdate, true);
        $criteria->compare('vid_url', $this->vid_url, true);
        $criteria->compare('vid_date', $this->vid_date, true);
        $criteria->compare('vid_status', $this->vid_status, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return SocialVideo the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
