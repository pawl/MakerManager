<?php

class TrainingToolsUserController extends Controller
{
	public $gridDataProvider;
	public function actionIndex()
	{
		// find the users
		$email = Yii::app()->user->getState('email');
		$whmcsUser = $this->getWhmcsUserID($email);
		
		// find the tools the user is trained on
		$criteria = new CDbCriteria;
		$criteria->addCondition("whmcs_user_id='{$whmcsUser}' and status='Trained'");
		$trainedRows = TrainingMembers::model()->findAll($criteria);

		$trainedToolIds = array(); // blank array in case no rows are returned in trainedRows
		foreach($trainedRows as $row) {
			$trainedToolIds[] = $row->tool_id;		
		}
		
		// find the tool names and combination lock codes associated with the tool ids
		$criteria = new CDbCriteria();
		$criteria->addInCondition("id", $trainedToolIds);
		$trainedComboRows = TrainingTools::model()->findAll($criteria);
		
		$trainedToolNamesAndCombos = array();
		$count = 1;
		foreach($trainedComboRows as $row) {
			$trainedToolNamesAndCombos[] = array('id' => $count, 'tool_name' => $row->tool_name, 'combination_lock_code' => $row->combination_lock_code);
			$count++;
		}
		
		$gridDataProvider = new CArrayDataProvider($trainedToolNamesAndCombos);
		
		$this->gridDataProvider = $gridDataProvider;
		$this->render('index');
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