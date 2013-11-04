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
                  <a href="' . Yii::app()->createAbsoluteUrl('/badges/update', array('id'=>$id)) . '">Approve</a>
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

                $whmcsurl = "http://www.dallasmakerspace.org/whmcs/login.php";
                $autoauthkey = "secret";

                $timestamp = time(); # Get current timestamp
                $email = Yii::app()->user->getState('email'); # Clients Email Address to Login
                $goto = "clientarea.php";

                $hash = sha1($email.$timestamp.$autoauthkey); # Generate Hash

                # Generate AutoAuth URL & Redirect
                $url = $whmcsurl."?email=$email&timestamp=$timestamp&hash=$hash&goto=".urlencode($goto);

                return $url;
    }


}
