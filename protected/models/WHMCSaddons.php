<?php

/**
 * This is the model class for table "tblhostingaddons".
 *
 * The followings are the available columns in table 'tblhostingaddons':
 * @property integer $id
 * @property integer $orderid
 * @property integer $hostingid
 * @property integer $addonid
 * @property string $name
 * @property string $setupfee
 * @property string $recurring
 * @property string $billingcycle
 * @property string $tax
 * @property string $status
 * @property string $regdate
 * @property string $nextduedate
 * @property string $nextinvoicedate
 * @property string $paymentmethod
 * @property string $notes
 */
class WHMCSaddons extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tblhostingaddons';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('orderid, hostingid, addonid, name, billingcycle, tax, nextinvoicedate, paymentmethod, notes', 'required'),
			array('orderid, hostingid, addonid', 'numerical', 'integerOnly'=>true),
			array('setupfee, recurring, status', 'length', 'max'=>10),
			array('regdate, nextduedate', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, orderid, hostingid, addonid, name, setupfee, recurring, billingcycle, tax, status, regdate, nextduedate, nextinvoicedate, paymentmethod, notes', 'safe', 'on'=>'search'),
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
			'orderid' => 'Orderid',
			'hostingid' => 'Hostingid',
			'addonid' => 'Addonid',
			'name' => 'Name',
			'setupfee' => 'Setupfee',
			'recurring' => 'Recurring',
			'billingcycle' => 'Billingcycle',
			'tax' => 'Tax',
			'status' => 'Status',
			'regdate' => 'Regdate',
			'nextduedate' => 'Nextduedate',
			'nextinvoicedate' => 'Nextinvoicedate',
			'paymentmethod' => 'Paymentmethod',
			'notes' => 'Notes',
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
		$criteria->compare('orderid',$this->orderid);
		$criteria->compare('hostingid',$this->hostingid);
		$criteria->compare('addonid',$this->addonid);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('setupfee',$this->setupfee,true);
		$criteria->compare('recurring',$this->recurring,true);
		$criteria->compare('billingcycle',$this->billingcycle,true);
		$criteria->compare('tax',$this->tax,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('regdate',$this->regdate,true);
		$criteria->compare('nextduedate',$this->nextduedate,true);
		$criteria->compare('nextinvoicedate',$this->nextinvoicedate,true);
		$criteria->compare('paymentmethod',$this->paymentmethod,true);
		$criteria->compare('notes',$this->notes,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * @return CDbConnection the database connection used for this class
	 */
	public function getDbConnection()
	{
		return Yii::app()->dbwhmcs;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return WHMCSaddons the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
