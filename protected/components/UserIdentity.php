<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		/* $users=array(
			// username => password
			'demo'=>'demo',
			'admin'=>'admin',
		);
		if(!isset($users[$this->username]))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif($users[$this->username]!==$this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
			$this->errorCode=self::ERROR_NONE;
		return !$this->errorCode; */
		try
        {
			if ($this->username == "admin") {
				echo "nice try"; // refuse to authenticate user with the name admin
				die();
			}
			
			// get connection info from config
			$options = Yii::app()->params['ldap'];
			$dc_string = "dc=" . implode(",dc=",$options['dc']);
			 
			$connection = ldap_connect($options['host']);
			ldap_set_option($connection, LDAP_OPT_PROTOCOL_VERSION, 3);
			ldap_set_option($connection, LDAP_OPT_REFERRALS, 0);
			 
			if($connection)
			{
				$bind = ldap_bind($connection, "uid={$this->username},ou={$options['ou']},{$dc_string}", $this->password);
			}
				
			if($bind) {
				$this->errorCode = self::ERROR_NONE;
				
				// get user's email
				$accounts_searchResult = ldap_search( $connection, $dc_string, "uid={$this->username}", array('mail') );
				$entry = ldap_first_entry( $connection, $accounts_searchResult );
				$attrs = ldap_get_attributes( $connection, $entry );
				Yii::app()->user->setState('email', $attrs['mail'][0]);
				
				// get members of admin group
				$result = ldap_search( $connection, $dc_string, 'cn=admins', array('memberUid') );
				$entries = ldap_get_entries($connection, $result);

				// set user in administrators group as admin
				if (in_array($this->username,$entries[0]['memberuid'])) {
					$this->username = 'admin';
				}
			}
			else {
				$this->errorCode = self::ERROR_PASSWORD_INVALID;
			}
			
		}
		catch (Exception $e){
				$this->errorCode = self::ERROR_PASSWORD_INVALID;
                echo "Your username/password could not be validated.";
        }
		
		return !$this->errorCode;
	}
}