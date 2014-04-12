<?php

/**
 * This is the model class for table "tbl_training_tools".
 *
 * The followings are the available columns in table 'tbl_training_tools':
 * @property integer $id
 * @property string $tool_mac_address
 * @property string $tool_name
 * @property integer $timeout
 * @property string $combination_lock_code
 * @property integer $combination_lock_code_length
 */
class TrainingTools extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_training_tools';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('timeout, combination_lock_code_length', 'numerical', 'integerOnly'=>true),
			array('tool_mac_address', 'length', 'max'=>12),
			array('tool_name, combination_lock_code', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, tool_mac_address, tool_name, timeout, combination_lock_code, combination_lock_code_length', 'safe', 'on'=>'search'),
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
			'tool_mac_address' => 'Tool Mac Address',
			'tool_name' => 'Tool Name',
			'timeout' => 'Timeout',
			'combination_lock_code' => 'Combination Lock Code',
			'combination_lock_code_length' => 'Combination Lock Code Length',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('tool_mac_address',$this->tool_mac_address,true);
		$criteria->compare('tool_name',$this->tool_name,true);
		$criteria->compare('timeout',$this->timeout);
		$criteria->compare('combination_lock_code',$this->combination_lock_code,true);
		$criteria->compare('combination_lock_code_length',$this->combination_lock_code_length);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TrainingTools the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
