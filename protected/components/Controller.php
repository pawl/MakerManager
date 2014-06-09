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
		$to  = Yii::app()->params['adminEmail'];

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
		$to  = Yii::app()->params['adminEmail'];

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

	// function to automatically authenticate users for WHMCSclient, so only LDAP login is required to get to WHMCS
	// http://docs.whmcs.com/AutoAuth
    public function whmcsUrl()
    {
		$whmcsurl = "http://www.dallasmakerspace.org/accounts/dologin.php";

		$autoauthkey = Yii::app()->params['autoAuthKey']; 

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
		if ($apiKey == Yii::app()->params['accessControlApiKey']) {
			return 1;
		} else {
			return 0;
		}
	}
	
	public function activateOrDeactivateBadge($status, $badge)
	{
		Yii::import('ext.EHttpClient.*');
		// apikey is secret
		$apiURL = 'https://physical.dallasmakerspace.org/accessControlApi/?apiKey=' . Yii::app()->params['accessControlApiKey'] . '&action=';
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

	public function getWhmcsUserID($email)
	{
		$criteria = new CDbCriteria;
		$criteria->addCondition("email='{$email}'");
		
		$user = WHMCSclients::model()->find($criteria)->id;
		return $user;
	}
	
	public function activeUserList()
	{	
		// TODO: Use ORM instead
		$active_badges_query = '
		SELECT
		  whmcs_user_id
		FROM (select
		  distinct whmcs_user_id,
		  IF(active_badge_count > 0, "Has Badge", "No Badges") as badges_status
		from
		  ( select
			  whmcs_user_id,
			  count(*) as active_badge_count
			from `dms_crm`.`tbl_badges`
			where status = "Active"
			group by whmcs_user_id
		  ) as badges
		  ) as active_badges_query
		where badges_status = "Has Badge"';
		
		$list= Yii::app()->db->createCommand($active_badges_query)->queryAll();
		$activeBadges=array();
		foreach($list as $item){
			//process each item here
			$activeBadges[]=$item['whmcs_user_id'];
		}
		
		// only members with badge show in dropdown
		$criteria = new CDbCriteria;		
		// only users with an active badge
		if ($activeBadges) {
			$activeBadges = implode(",", $activeBadges);
			$criteria->addCondition('id in (' . $activeBadges . ')');
		}
		$criteria->order = 'firstname ASC';
		
		$activeUsersList = WHMCSclients::model()->findAll($criteria);
		return CHtml::listData($activeUsersList, 'id', 'fullNameAndEmail');
	}
	
	public function noBadgeUserList()
	{	
		
		// TODO: simplify this monstrosity of a query
		// get list of user ids with active badges
		// badges returned from this query will not be included in the dropdown
		$active_badges_query = '
		SELECT
	          whmcs_user_id
		FROM (
		  SELECT
			distinct `dms-whmcs`.tblclients.id as whmcs_user_id,
			IF(((IFNULL(active_badge_count,0) >= (IFNULL(s.addon_count,0) + IFNULL(m.product_count,0))) AND ((IFNULL(s.addon_count,0) + IFNULL(m.product_count,0)) >= 0)), "Hit Limit", "Under Limit") as limit_status,
			(IFNULL(s.addon_count,0) + IFNULL(m.product_count,0)) as active_products
		  FROM `dms-whmcs`.tblclients
		  left join ( select
			  whmcs_user_id,
			  count(*) as active_badge_count
			from `dms_crm`.`tbl_badges`
			where status = "Active"
			group by whmcs_user_id
		  ) badges ON `dms-whmcs`.tblclients.id = badges.whmcs_user_id
		  left join (
			select 
			  id,
			  userid, 
			  count(*) as product_count
			from `dms-whmcs`.tblhosting
			where tblhosting.domainstatus = "Active"
			group by userid
		  ) m ON m.userid = `dms-whmcs`.tblclients.id
		  left join (
			select
			  hostingid, 
			  count(*) as addon_count
			from `dms-whmcs`.tblhostingaddons 
			where tblhostingaddons.status = "Active" 
			group by hostingid
		  ) s ON s.hostingid = m.id
		) as limit_query
		where (limit_status = "Hit Limit")';
		
		$list= Yii::app()->db->createCommand($active_badges_query)->queryAll();
		$activeBadges=array();
		foreach($list as $item){
			//process each item here
			$activeBadges[]=$item['whmcs_user_id'];
		}
		// only (members with products) and (active badges below their limit) show in dropdown
		$criteria = new CDbCriteria;
		
		// no users with active badges are in the email dropdown
		if ($activeBadges) {
			$activeBadges = implode(",", $activeBadges);
			$criteria->addCondition('id not in (' . $activeBadges . ')');			
		}
		$criteria->order = 'firstname ASC';
		
		$activeUsersList = WHMCSclients::model()->findAll($criteria);
		return CHtml::listData($activeUsersList, 'id', 'fullNameAndEmail');
	}
	
}
