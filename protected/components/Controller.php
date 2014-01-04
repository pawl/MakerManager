<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

	public function sendActivationEmail($fullname, $id)
    {
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
		  <p>' . $fullname . '\'s badge is pending activation. Follow the link below to activate it.</p>
		  <a href="' . Yii::app()->createAbsoluteUrl('/badges/admin') . '">Approve</a>
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
	}
	
	public function sendActivatedEmail($fullname)
    {
		// multiple recipients
		$to  = 'admin@dallasmakerspace.org';

		// subject
		$subject = 'Badge Activated';

		// message
		$message = '
		<html>
		<head>
		  <title>Badge Pending Activation</title>
		</head>
		<body>
		  <p>' . $fullname . '\'s badge has been activated.</p>
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
	}

    public function whmcsUrl()
    {
		$whmcsurl = "http://www.dallasmakerspace.org/accounts/dologin.php";
		// autoauthkey is secret
		$autoauthkey = "secret";

		$timestamp = time(); # Get current timestamp
		$email = Yii::app()->user->getState('email'); # Clients Email Address to Login
		$goto = "clientarea.php";

		$hash = sha1($email.$timestamp.$autoauthkey); # Generate Hash

		# Generate AutoAuth URL & Redirect
		$url = $whmcsurl."?email=$email&timestamp=$timestamp&hash=$hash&goto=".urlencode($goto);

		return $url;
    }
	
	public function isValidApiKey($apiKey)
	{
		if ($apiKey == "secret") {
			return 1;
		} else {
			return 0;
		}
	}
	
	public function activateOrDeactivateBadge($status, $badge)
	{
		Yii::import('ext.EHttpClient.*');
		// apikey is secret
		$apiURL = 'https://physical.dallasmakerspace.org/accessControlApi/?apiKey=secret&action=';
		if ($status == "Active") {
			$addOrRemove = 'add';			
		} elseif ($status == "Deactivated") {
			$addOrRemove = 'remove';
		} else {
			throw new Exception("Unexpected Status");
		}
		$client = new EHttpClient($apiURL . $addOrRemove . '&badge=' . $badge, array('maxredirects' => 0,'timeout' => 30));
		$response = $client->request();
		
		return $response;
	}

	public function whmcsUserListData($onlyUsersWithBadge = false)
	{
		// get list of user ids with active badges
		$activeBadges = Yii::app()->db->createCommand()
		->select('whmcs_user_id')
		->from('tbl_badges')
		->where('status=:status', array(':status'=>"Active"))
		->queryColumn();	
		
		$criteria = new CDbCriteria;
		
		// only paid members show in dropdown
		$criteria->addCondition("status='Active'");
		
		// no users with active badges are in the email dropdown
		if ($activeBadges) {
			$activeBadges = implode(",", $activeBadges);
			if (!$onlyUsersWithBadge) {
				$criteria->addCondition('id not in (' . $activeBadges . ')');
			} else {
				$criteria->addCondition('id in (' . $activeBadges . ')');
			}
		}
		$criteria->order = 'email ASC';
		
		$activeUsersList = WHMCSclients::model()->findAll($criteria);
		return CHtml::listData($activeUsersList, 'id', 'email');
	}
}
