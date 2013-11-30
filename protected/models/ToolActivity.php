<?php

/**
 * This is the model class for table "tbl_tool_activity".
 *
 * The followings are the available columns in table 'tbl_tool_activity':
 * @property integer $id
 * @property string $whmcs_user_id
 * @property string $tool_id
 * @property string $activity_start
 * @property string $activity_end
 */
class ToolActivity extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_tool_activity';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('whmcs_user_id, tool_id', 'length', 'max'=>255),
			array('activity_start, activity_end', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, whmcs_user_id, tool_id, activity_start, activity_end', 'safe', 'on'=>'search'),
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
			'whmcs'=>array(self::BELONGS_TO, 'WHMCSclients', 'whmcs_user_id'),
			'tools'=>array(self::BELONGS_TO, 'TrainingTools', 'tool_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'whmcs_user_id' => 'Whmcs User',
			'tool_id' => 'Tool',
			'activity_start' => 'Activity Start',
			'activity_end' => 'Activity End',
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
		$criteria->compare('whmcs_user_id',$this->whmcs_user_id,true);
		$criteria->compare('tool_id',$this->tool_id,true);
		$criteria->compare('activity_start',$this->activity_start,true);
		$criteria->compare('activity_end',$this->activity_end,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ToolActivity the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
