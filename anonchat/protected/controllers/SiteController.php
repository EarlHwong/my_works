<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'

        if(Yii::app()->user->getIsGuest())
        {
            //if the user is a guest.
            $this->redirect('index.php?r=user/index');
        }
        else
        {
            $time = time();//set time
            $username = Yii::app()->user->name;//the user

            $users_model = Users::model();
            $chat_model = new Chat();

            //judge if it has matched
            $user = $users_model->find('matchingID=:ID',array(':ID'=>$username));
            if(isset($user))//matched
            {

                //get match time, so as to get chat record from this time on
                $sql = "select * from a_users WHERE username=:username ORDER BY matchingtime DESC ";
                $matchingtime = $chat_model->findBySql($sql, array(':username'=>$username))->matchingtime;

                //if it submitted?
                if(isset($_POST['Chat']) && time()-$_POST['time']>1)
                {
                    //insert the information into mysql
                    $this->submit($username,$_POST['Chat']['chat'],$matchingtime,$chat_model);
                    $this->redirect('index.php',array(
                        'matchingtime'=>$matchingtime,
                        'chat_model'=>$chat_model,
                    ));
                    return;
                }

                //用redirect是为了防止刷新重复提交表单
                $this->render('index',array(
                    'matchingtime'=>$matchingtime,
                    'chat_model'=>$chat_model,
                ));
                return;

            }
            else
            {
                //找没匹配的进行匹配
                $sql = "select * from a_users WHERE matchingID is NULL AND username != :username AND :timea-updatatime<20";
                $user = $users_model->findBySql($sql,array(
                    ':timea'=>$time,
                    ':username'=>$username
                ));
                if(isset($user))
                {
                    //找到了，匹配
                    $sql = "update a_users set matchingID =:ausername, matchingtime=:timea WHERE username=:usera";
                    $u = $user->username;
                    $this->DAO_insert_4($sql,$u,$time,$username);
                    $this->DAO_insert_4($sql,$username,$time,$u);

                    //友好的提示
                    $sql = "INSERT INTO a_chat(username, chat, matchingtime) VALUES (:username, '你好！',:timea)";
                    $this->DAO_insert_3($sql,$username,$time);
                    $this->DAO_insert_3($sql,$u,$time);

                    $this->redirect('index.php');
                }
                else
                {
                    //没找着，留给Ajax提示吧~
                }

            }
        }



		$this->render('index');
	}

    private function submit($username,$chat,$matchingtime, $chat_model)
    {
        $chat_model->username = $username;
        $chat_model->matchingtime = $matchingtime;
        $chat_model->chat = $chat;
        $chat_model->save();
    }

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}


    /**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
    {
        $name = Yii::app()->user->name;
        //
        $user_model = Users::model();
        $matchingID = $user_model->find('matchingID=:ID', array(':ID' => $name));
        if (isset($matchingID))
        {
            $matchingID = $matchingID->username;
            $sql = "update a_users SET matchingID=NULL, updatatime=-1 WHERE username=:matchingID";
            $this->DAO_insert_2($sql,$matchingID);
        }

        $sql = "update a_users SET matchingID=NULL, updatatime=-1 WHERE username=:matchingID";
        $this->DAO_insert_2($sql,$name);

		Yii::app()->user->logout();
		$this->redirect('index.php?r=user/index');
	}

}