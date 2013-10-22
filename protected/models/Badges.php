<?php

/**
 * This is the model class for table "tbl_badges".
 *
 * The followings are the available columns in table 'tbl_badges':
 * @property integer $whmcs_user_id
 * @property integer $badge
 * @property string $status
 * @property string $email
 * @property string $fullname
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
			array('email, fullname', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('whmcs_user_id, badge, status, email, fullname', 'safe', 'on'=>'search'),
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
	
	public function beforeSave(){
		if ($this->isNewRecord) {
			$this->status = "Pending";
			
			$userResult = WHMCSclients::model()->findByPk($this->whmcs_user_id);
			$this->fullname = $userResult->firstname . " " . $userResult->lastname;
			$this->email = $userResult->email;
			
			// multiple recipients
			$to  = 'admin@dallasmakerspace.org';

			// subject
			$subject = 'Badge Pending Activation';

			// message
			$message = '
			<html>
			<head>
			  <title>Badge Pending Activation</title>
			</head>
			<body>
			  <p>' . $this->fullname . '\'s badge is pending activation. Follow the link below to activate it.</p>
			  <a href="https://dallasmakerspace.org/admin/crm/index.php?r=badges/approve">Approve</a>
			</body>
			</html>
			';

			// To send HTML mail, the Content-type header must be set
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

			// Additional headers
			$headers .= 'From: Maker Manager <makermanager@dallasmakerspace.prg>' . "\r\n";

			// Mail it
			mail($to, $subject, $message, $headers);
		} else {
			Yii::import('ext.EHttpClient.*');
			if ($this->status == "Active") {
				$client = new EHttpClient('https://physical.dallasmakerspace.org/accessControlApi/?apiKey=iQu3Vae5Eb6room3Eeb7IeGhEeNg2fai&action=add&badge=' . $this->badge, array('maxredirects' => 0,'timeout' => 30));
				$response = $client->request();
				 
				if($response->isSuccessful())
					Yii::app()->user->setFlash('success', $response->getBody());				 
				else
					Yii::app()->user->setFlash('error', $response->getRawBody());	
					
				if("User Added Successfully" != $response->getRawBody()) {
					$this->status = "Pending";
					Yii::app()->user->setFlash('error', "Adding User Failed");
				}
			} elseif ($this->status == "Deactivated") {
				$client = new EHttpClient('https://physical.dallasmakerspace.org/accessControlApi/?apiKey=iQu3Vae5Eb6room3Eeb7IeGhEeNg2fai&action=remove&badge=' . $this->badge, array('maxredirects' => 0,'timeout' => 30));
				$response = $client->request();
				 
				if($response->isSuccessful())
					Yii::app()->user->setFlash('success', $response->getBody());				 
				else
					Yii::app()->user->setFlash('error', $response->getRawBody());

				if("User Removed Successfully" != $response->getRawBody()) {
					$this->status = "Pending";
					Yii::app()->user->setFlash('error', "Removing User Failed");
				}
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
			'whmcs_user_id' => 'User ID',
			'badge' => 'Badge Number',
			'status' => 'Status',
			'email' => 'Email',
			'fullname' => 'Full Name',
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

		$criteria->compare('whmcs_user_id',$this->whmcs_user_id);
		$criteria->compare('badge',$this->badge);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('fullname',$this->fullname,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
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
