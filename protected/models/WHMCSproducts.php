<?php

/**
 * This is the model class for table "tblhosting".
 *
 * The followings are the available columns in table 'tblhosting':
 * @property integer $id
 * @property integer $userid
 * @property integer $orderid
 * @property integer $packageid
 * @property integer $server
 * @property string $regdate
 * @property string $domain
 * @property string $paymentmethod
 * @property string $firstpaymentamount
 * @property string $amount
 * @property string $billingcycle
 * @property string $nextduedate
 * @property string $nextinvoicedate
 * @property string $domainstatus
 * @property string $username
 * @property string $password
 * @property string $notes
 * @property string $subscriptionid
 * @property integer $promoid
 * @property string $suspendreason
 * @property string $overideautosuspend
 * @property string $overidesuspenduntil
 * @property string $dedicatedip
 * @property string $assignedips
 * @property string $ns1
 * @property string $ns2
 * @property integer $diskusage
 * @property integer $disklimit
 * @property integer $bwusage
 * @property integer $bwlimit
 * @property string $lastupdate
 */
class WHMCSproducts extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tblhosting';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userid, orderid, packageid, server, regdate, domain, paymentmethod, billingcycle, nextinvoicedate, domainstatus, username, password, notes, subscriptionid, promoid, suspendreason, overideautosuspend, overidesuspenduntil, dedicatedip, assignedips, ns1, ns2', 'required'),
			array('userid, orderid, packageid, server, promoid, diskusage, disklimit, bwusage, bwlimit', 'numerical', 'integerOnly'=>true),
			array('firstpaymentamount, amount, domainstatus', 'length', 'max'=>10),
			array('nextduedate, lastupdate', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, userid, orderid, packageid, server, regdate, domain, paymentmethod, firstpaymentamount, amount, billingcycle, nextduedate, nextinvoicedate, domainstatus, username, password, notes, subscriptionid, promoid, suspendreason, overideautosuspend, overidesuspenduntil, dedicatedip, assignedips, ns1, ns2, diskusage, disklimit, bwusage, bwlimit, lastupdate', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array();
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'userid' => 'Userid',
			'orderid' => 'Orderid',
			'packageid' => 'Packageid',
			'server' => 'Server',
			'regdate' => 'Regdate',
			'domain' => 'Domain',
			'paymentmethod' => 'Paymentmethod',
			'firstpaymentamount' => 'Firstpaymentamount',
			'amount' => 'Amount',
			'billingcycle' => 'Billingcycle',
			'nextduedate' => 'Nextduedate',
			'nextinvoicedate' => 'Nextinvoicedate',
			'domainstatus' => 'Domainstatus',
			'username' => 'Username',
			'password' => 'Password',
			'notes' => 'Notes',
			'subscriptionid' => 'Subscriptionid',
			'promoid' => 'Promoid',
			'suspendreason' => 'Suspendreason',
			'overideautosuspend' => 'Overideautosuspend',
			'overidesuspenduntil' => 'Overidesuspenduntil',
			'dedicatedip' => 'Dedicatedip',
			'assignedips' => 'Assignedips',
			'ns1' => 'Ns1',
			'ns2' => 'Ns2',
			'diskusage' => 'Diskusage',
			'disklimit' => 'Disklimit',
			'bwusage' => 'Bwusage',
			'bwlimit' => 'Bwlimit',
			'lastupdate' => 'Lastupdate',
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
		$criteria->compare('userid',$this->userid);
		$criteria->compare('orderid',$this->orderid);
		$criteria->compare('packageid',$this->packageid);
		$criteria->compare('server',$this->server);
		$criteria->compare('regdate',$this->regdate,true);
		$criteria->compare('domain',$this->domain,true);
		$criteria->compare('paymentmethod',$this->paymentmethod,true);
		$criteria->compare('firstpaymentamount',$this->firstpaymentamount,true);
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('billingcycle',$this->billingcycle,true);
		$criteria->compare('nextduedate',$this->nextduedate,true);
		$criteria->compare('nextinvoicedate',$this->nextinvoicedate,true);
		$criteria->compare('domainstatus',$this->domainstatus,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('notes',$this->notes,true);
		$criteria->compare('subscriptionid',$this->subscriptionid,true);
		$criteria->compare('promoid',$this->promoid);
		$criteria->compare('suspendreason',$this->suspendreason,true);
		$criteria->compare('overideautosuspend',$this->overideautosuspend,true);
		$criteria->compare('overidesuspenduntil',$this->overidesuspenduntil,true);
		$criteria->compare('dedicatedip',$this->dedicatedip,true);
		$criteria->compare('assignedips',$this->assignedips,true);
		$criteria->compare('ns1',$this->ns1,true);
		$criteria->compare('ns2',$this->ns2,true);
		$criteria->compare('diskusage',$this->diskusage);
		$criteria->compare('disklimit',$this->disklimit);
		$criteria->compare('bwusage',$this->bwusage);
		$criteria->compare('bwlimit',$this->bwlimit);
		$criteria->compare('lastupdate',$this->lastupdate,true);

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
	 * @return Tblhosting the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
