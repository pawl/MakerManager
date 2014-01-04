<?php

/**
 * This is the model class for table "tbl_badges".
 *
 * The followings are the available columns in table 'tbl_badges':
 * @property integer $id
 * @property integer $whmcs_user_id
 * @property integer $badge
 * @property string $status
 */
class Badges extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_badges';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('badge', 'required'),
			array('whmcs_user_id, badge', 'numerical', 'integerOnly'=>true),
			array('status', 'length', 'max'=>16),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, whmcs_user_id, whmcsEmail, badge, status', 'safe', 'on'=>'search'),
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
			'whmcs'=>array(self::BELONGS_TO, 'WHMCSclients', 'whmcs_user_id'),
		);
	}
	
	private $_whmcsEmail = null;
	public function getWhmcsEmail()
	{
		if ($this->_whmcsEmail === null && $this->whmcs !== null)
		{
			$this->_whmcsEmail = $this->whmcs->email;
		}
		return $this->_whmcsEmail;
	}
	public function setWhmcsEmail($value)
	{
		$this->_whmcsEmail = $value;
	}
	
	public function beforeSave(){
		if ($this->isNewRecord) {
			$this->status = "Pending";
			
			$userResult = WHMCSclients::model()->findByPk($this->whmcs_user_id);
		} else {
			Yii::import('application.components.Controller'); // get activateOrDeactivateBadge function from Controller.php
			$response =  Controller::activateOrDeactivateBadge($this->status, $this->badge);
			
			if($response->isSuccessful())
				Yii::app()->user->setFlash('success', $response->getBody());				 
			else
				Yii::app()->user->setFlash('error', $response->getRawBody());
				
			if("User Added Successfully" != $response->getRawBody()) {
				$this->status = "Pending";
				Yii::app()->user->setFlash('error', "Adding User Failed");
			}
			elseif("User Removed Successfully" != $response->getRawBody()) {
				$this->status = "Pending";
				Yii::app()->user->setFlash('error', "Removing User Failed");
			}
							 
					
		}
		return parent::beforeSave();
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'whmcs_user_id' => 'User ID',
			'badge' => 'Badge Number',
			'status' => 'Status',
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

		// added to make pending badges show first
		$criteria->order = 'status DESC';
		
		$criteria->compare('id',$this->id);
		$criteria->compare('whmcs_user_id',$this->whmcs_user_id);
		$criteria->compare('badge',$this->badge);
		$criteria->compare('status',$this->status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>false,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Badges the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
