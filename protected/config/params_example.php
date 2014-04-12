<?php

// this contains the application parameters that can be maintained via GUI
return array(
		// this is used in contact page
		'adminEmail' => 'admin@yourdomain.org',
		'ldap' => array(
			'host' => 'localhost',
			'ou' => 'people', // such as "people" or "users"
			'dc' => array('yourdomain','org'),
		),
		'autoAuthKey' => "secret",
		'accessControlApiKey' => 'secret',
	);