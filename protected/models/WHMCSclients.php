<?php

/**
 * This is the model class for table "tblclients".
 *
 * The followings are the available columns in table 'tblclients':
 * @property integer $id
 * @property string $firstname
 * @property string $lastname
 * @property string $companyname
 * @property string $email
 * @property string $address1
 * @property string $address2
 * @property string $city
 * @property string $state
 * @property string $postcode
 * @property string $country
 * @property string $phonenumber
 * @property string $password
 * @property string $authmodule
 * @property string $authdata
 * @property integer $currency
 * @property string $defaultgateway
 * @property string $credit
 * @property string $taxexempt
 * @property string $latefeeoveride
 * @property string $overideduenotices
 * @property string $separateinvoices
 * @property string $disableautocc
 * @property string $datecreated
 * @property string $notes
 * @property integer $billingcid
 * @property integer $securityqid
 * @property string $securityqans
 * @property integer $groupid
 * @property string $cardtype
 * @property string $cardlastfour
 * @property string $cardnum
 * @property string $startdate
 * @property string $expdate
 * @property string $issuenumber
 * @property string $bankname
 * @property string $banktype
 * @property string $bankcode
 * @property string $bankacct
 * @property string $gatewayid
 * @property string $lastlogin
 * @property string $ip
 * @property string $host
 * @property string $status
 * @property string $language
 * @property string $pwresetkey
 * @property integer $pwresetexpiry
 * @property integer $emailoptout
 * @property integer $overrideautoclose
 */
class WHMCSclients extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tblclients';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('firstname, lastname, companyname, email, address1, address2, city, state, postcode, country, phonenumber, password, authmodule, authdata, currency, defaultgateway, credit, taxexempt, latefeeoveride, overideduenotices, separateinvoices, disableautocc, datecreated, notes, billingcid, securityqid, securityqans, groupid, cardlastfour, cardnum, startdate, expdate, issuenumber, bankname, banktype, bankcode, bankacct, gatewayid, ip, host, language, pwresetkey, pwresetexpiry, emailoptout, overrideautoclose', 'required'),
			array('currency, billingcid, securityqid, groupid, pwresetexpiry, emailoptout, overrideautoclose', 'numerical', 'integerOnly'=>true),
			array('credit', 'length', 'max'=>10),
			array('cardtype', 'length', 'max'=>255),
			array('status', 'length', 'max'=>8),
			array('lastlogin', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, firstname, lastname, companyname, email, address1, address2, city, state, postcode, country, phonenumber, password, authmodule, authdata, currency, defaultgateway, credit, taxexempt, latefeeoveride, overideduenotices, separateinvoices, disableautocc, datecreated, notes, billingcid, securityqid, securityqans, groupid, cardtype, cardlastfour, cardnum, startdate, expdate, issuenumber, bankname, banktype, bankcode, bankacct, gatewayid, lastlogin, ip, host, status, language, pwresetkey, pwresetexpiry, emailoptout, overrideautoclose', 'safe', 'on'=>'search'),
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
	
	function getFullName()
	{
		return $this->firstname . " " . $this->lastname;
	}
	
	function getFullNameAndEmail()
	{
		return $this->firstname . " " . $this->lastname . " - " . $this->email;
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'firstname' => 'Firstname',
			'lastname' => 'Lastname',
			'companyname' => 'Companyname',
			'email' => 'Email',
			'address1' => 'Address1',
			'address2' => 'Address2',
			'city' => 'City',
			'state' => 'State',
			'postcode' => 'Postcode',
			'country' => 'Country',
			'phonenumber' => 'Phonenumber',
			'password' => 'Password',
			'authmodule' => 'Authmodule',
			'authdata' => 'Authdata',
			'currency' => 'Currency',
			'defaultgateway' => 'Defaultgateway',
			'credit' => 'Credit',
			'taxexempt' => 'Taxexempt',
			'latefeeoveride' => 'Latefeeoveride',
			'overideduenotices' => 'Overideduenotices',
			'separateinvoices' => 'Separateinvoices',
			'disableautocc' => 'Disableautocc',
			'datecreated' => 'Datecreated',
			'notes' => 'Notes',
			'billingcid' => 'Billingcid',
			'securityqid' => 'Securityqid',
			'securityqans' => 'Securityqans',
			'groupid' => 'Groupid',
			'cardtype' => 'Cardtype',
			'cardlastfour' => 'Cardlastfour',
			'cardnum' => 'Cardnum',
			'startdate' => 'Startdate',
			'expdate' => 'Expdate',
			'issuenumber' => 'Issuenumber',
			'bankname' => 'Bankname',
			'banktype' => 'Banktype',
			'bankcode' => 'Bankcode',
			'bankacct' => 'Bankacct',
			'gatewayid' => 'Gatewayid',
			'lastlogin' => 'Lastlogin',
			'ip' => 'Ip',
			'host' => 'Host',
			'status' => 'Status',
			'language' => 'Language',
			'pwresetkey' => 'Pwresetkey',
			'pwresetexpiry' => 'Pwresetexpiry',
			'emailoptout' => 'Emailoptout',
			'overrideautoclose' => 'Overrideautoclose',
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
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('companyname',$this->companyname,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('address1',$this->address1,true);
		$criteria->compare('address2',$this->address2,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('postcode',$this->postcode,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('phonenumber',$this->phonenumber,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('authmodule',$this->authmodule,true);
		$criteria->compare('authdata',$this->authdata,true);
		$criteria->compare('currency',$this->currency);
		$criteria->compare('defaultgateway',$this->defaultgateway,true);
		$criteria->compare('credit',$this->credit,true);
		$criteria->compare('taxexempt',$this->taxexempt,true);
		$criteria->compare('latefeeoveride',$this->latefeeoveride,true);
		$criteria->compare('overideduenotices',$this->overideduenotices,true);
		$criteria->compare('separateinvoices',$this->separateinvoices,true);
		$criteria->compare('disableautocc',$this->disableautocc,true);
		$criteria->compare('datecreated',$this->datecreated,true);
		$criteria->compare('notes',$this->notes,true);
		$criteria->compare('billingcid',$this->billingcid);
		$criteria->compare('securityqid',$this->securityqid);
		$criteria->compare('securityqans',$this->securityqans,true);
		$criteria->compare('groupid',$this->groupid);
		$criteria->compare('cardtype',$this->cardtype,true);
		$criteria->compare('cardlastfour',$this->cardlastfour,true);
		$criteria->compare('cardnum',$this->cardnum,true);
		$criteria->compare('startdate',$this->startdate,true);
		$criteria->compare('expdate',$this->expdate,true);
		$criteria->compare('issuenumber',$this->issuenumber,true);
		$criteria->compare('bankname',$this->bankname,true);
		$criteria->compare('banktype',$this->banktype,true);
		$criteria->compare('bankcode',$this->bankcode,true);
		$criteria->compare('bankacct',$this->bankacct,true);
		$criteria->compare('gatewayid',$this->gatewayid,true);
		$criteria->compare('lastlogin',$this->lastlogin,true);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('host',$this->host,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('language',$this->language,true);
		$criteria->compare('pwresetkey',$this->pwresetkey,true);
		$criteria->compare('pwresetexpiry',$this->pwresetexpiry);
		$criteria->compare('emailoptout',$this->emailoptout);
		$criteria->compare('overrideautoclose',$this->overrideautoclose);

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
	 * @return WHMCSclients the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
