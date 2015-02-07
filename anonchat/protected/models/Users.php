<?php

/**
 * This is the model class for table "a_users".
 *
 * The followings are the available columns in table 'a_users':
 * @property integer $personID
 * @property string $username
 * @property string $password
 * @property string $Time
 * @property integer $updatatime
 * @property integer $matchingtime
 * @property string $matchingID
 */
class Users extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Users the static model class
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
		return 'a_users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password', 'required'),
            array('username, password', 'check'),
            array('updatatime, matchingtime', 'numerical', 'integerOnly'=>true),
            array('username','isexist'),

            // The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('personID, username, password, Time, updatatime, matchingtime, matchingID', 'safe', 'on'=>'search'),
		);
	}


    public function check()
    {
        $this->username = trim($this->username);
        $this->username = stripslashes($this->username);
        $this->username = htmlspecialchars($this->username);

        $this->password = trim($this->password);
        $this->password = stripslashes($this->password);
        $this->password = htmlspecialchars($this->password);

    }


    public function isexist()//校验规则，检验是否存在……额，yii有封装好了的unique..算了，不改了
    {
        $infos = $this->find('username=:name',array(':name'=>$this->username));
        if($infos != NULL)
        {
            $this->password = '';//这个是清空输入框
            $this->addError('isexist', 'user exists');
        }
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
			'personID' => 'Person',
			'username' => 'Username',
			'password' => 'Password',
			'Time' => 'Time',
			'updatatime' => 'Updatatime',
			'matchingtime' => 'Matchingtime',
			'matchingID' => 'Matching',
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

		$criteria->compare('personID',$this->personID);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('Time',$this->Time,true);
		$criteria->compare('updatatime',$this->updatatime);
		$criteria->compare('matchingtime',$this->matchingtime);
		$criteria->compare('matchingID',$this->matchingID,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}