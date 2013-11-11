<?php

class ApiController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionUserValidate($badge,$isHex = false)
	{
		header('Content-type: application/json');
		
		if($isHex) {
			$badge = hexdec($badge);
		}
		
		// remove leading zeros
		$badge = ltrim($badge, '0');
		
		// query for the user's WHMCS ID by using their Badge
		$connection=Yii::app()->db;
		$sql = "SELECT whmcs_user_id from tbl_badges where badge=:badge AND status='Active'";
		$command=$connection->createCommand($sql);
		$command->bindParam(':badge',$badge,PDO::PARAM_STR);
		$userid=$command->queryScalar();
		
		if ($userid) {
			// success
			$jsonResponse = json_encode(array(
				'authorized' => (bool) 1,
				'rfid' => (int)$badge,
			));
		} else {
			// fail
			$jsonResponse = json_encode(array(
				'authorized' => (bool) 0,
				'rfid' => (int)$badge,
			));
		}
		echo json_encode($jsonResponse);
		Yii::app()->end();	
	}
	
	public function actionToolValidate($badge,$tool,$isHex = false)
	{
		header('Content-type: application/json');
		
		if($isHex) {
			$badge = hexdec($badge);
		}
		
		// remove leading zeros
		$badge = ltrim($badge, '0');
		
		// query for the user's WHMCS ID by using their Badge
		$connection=Yii::app()->db;
		$sql = "SELECT whmcs_user_id from tbl_badges where badge=:badge AND status='Active'";
		$command=$connection->createCommand($sql);
		$command->bindParam(':badge',$badge,PDO::PARAM_STR);
		$userid=$command->queryScalar();
		
		// check if user has badge in the system
		if ($userid) {
			// query for whether the person is trained
			$authSql = "SELECT status from tbl_training_members where whmcs_user_id=:whmcs_user_id AND status='Trained' AND tool_id=:tool";
			$authCommand=$connection->createCommand($authSql);
			$authCommand->bindParam(':whmcs_user_id',$userid,PDO::PARAM_STR);
			$authCommand->bindParam(':tool',$tool,PDO::PARAM_STR);
			$authResult=$authCommand->queryScalar();
			
			// query for the timeout of the tool
			$timeoutSql = "SELECT timeout from tbl_training_tools where id=:tool_id";
			$timeoutCommand=$connection->createCommand($timeoutSql);
			$timeoutCommand->bindParam(':tool_id',$tool,PDO::PARAM_STR);
			$timeoutResult=$timeoutCommand->queryScalar();
			
			if ($authResult == "Trained") {
				// success - user trained
				$jsonResponse = array(
					'authorized' => (bool) 1,
					'rfid' => (int) $badge,
					'machine_id' => (int) $tool,
					'timeout' => (int) $timeoutResult,
				);			
				
				// save tool activity to database
				$toolActivityModel = new ToolActivity;
				$toolActivityModel->whmcs_user_id = $userid;
				$toolActivityModel->tool_id = $tool;
				$toolActivityModel->activity_start = new CDbExpression('NOW()');
				$toolActivityModel->activity_end = NULL;
				$toolActivityModel->save(); 
			} else {
				// fail - user not trained
				$jsonResponse = array(
					'authorized' => (bool) 0,
					'rfid' => (int) $badge,
					'machine_id' => (int) $tool,
					'timeout' => (int) $timeoutResult,
				);
			}
		} else {	
			// fail - no badge
			$jsonResponse = array(
				'authorized' => (bool) 0,
				'rfid' => (int) $badge,
			);
		}
		echo json_encode($jsonResponse);
		
		Yii::app()->end();
	}
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}