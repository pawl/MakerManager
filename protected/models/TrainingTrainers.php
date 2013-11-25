<?php

/**
 * This is the model class for table "tbl_training_trainers".
 *
 * The followings are the available columns in table 'tbl_training_trainers':
 * @property integer $id
 * @property integer $whmcs_user_id
 * @property string $trainer_name
 * @property integer $tool_id
 * @property string $status
 */
class TrainingTrainers extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_training_trainers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('whmcs_user_id, tool_id', 'numerical', 'integerOnly'=>true),
			array('trainer_name', 'length', 'max'=>255),
			array('status', 'length', 'max'=>60),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, whmcs_user_id, trainer_name, tool_id, status', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'whmcs_user_id' => 'Whmcs User',
			'trainer_name' => 'Trainer Name',
			'tool_id' => 'Tool',
			'status' => 'Status',
		);
	}

	// new requests get saved as pending
	public function beforeSave(){
		if ($this->isNewRecord) {
			$this->status = "Pending";
		}
		return parent::beforeSave();
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

		$criteria->compare('id',$this->id);
		$criteria->compare('whmcs_user_id',$this->whmcs_user_id);
		$criteria->compare('trainer_name',$this->trainer_name,true);
		$criteria->compare('tool_id',$this->tool_id);
		$criteria->compare('status',$this->status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TrainingTrainers the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
