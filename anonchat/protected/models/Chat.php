<?php

/**
 * This is the model class for table "a_chat".
 *
 * The followings are the available columns in table 'a_chat':
 * @property string $username
 * @property string $chat
 * @property integer $matchingtime
 * @property string $time
 */
class Chat extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Chat the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'a_chat';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('chat', 'required','message'=>'please say something...'),
			array('matchingtime', 'numerical', 'integerOnly'=>true),
			array('username, chat', 'length', 'max'=>60),
			array('chat', 'safe'),
            array('chat','check'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('username, chat, matchingtime, time', 'safe', 'on'=>'search'),
		);
	}

    public function check()
    {
        $this->chat = trim($this->chat);
        $this->chat = stripslashes($this->chat);
        $this->chat = htmlspecialchars($this->chat);
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

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'username' => 'Username',
			'chat' => 'Chat',
			'matchingtime' => 'Matchingtime',
			'time' => 'Time',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('username',$this->username,true);
		$criteria->compare('chat',$this->chat,true);
		$criteria->compare('matchingtime',$this->matchingtime);
		$criteria->compare('time',$this->time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}