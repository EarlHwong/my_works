<?php

class AjaxController extends Controller
{
	public function actionAjax()
	{
        if(isset($_GET['name']))
        {

            $time = time();
            $name = $this->check($_GET['name']);
            $sql = "update a_users SET updatatime=:username WHERE username=:timea";
            $this->DAO_insert_3($sql,$time,$name);

            if(isset($_GET['t']))//the matchingtime means it has matched
            {
                $users_model = new Users();

                $sql = "select * from a_users WHERE username=:name";
                $ID = $users_model->findBySql($sql,array(':name'=>$name))->matchingID;
                if(!isset($ID))//有人中途跑了
                {
                    echo '<div id="tip">对方跑了，F5刷新网页重新匹配吧~~~</div>';
                    return;
                }

                $t = $this->check($_GET['t']);

                $this->searchchat($name,$t);

            }
            else//还没有匹配，所以帮帮忙吧~
            {

                //找没匹配的进行匹配
                $username = Yii::app()->user->name;
                $users_model = new Users();

                $sql = "select * from a_users WHERE username=:username";
                $ID = $users_model->findBySql($sql,array(':username'=>$username))->matchingID;
                if(isset($ID))//可能对方匹配到你了
                {
                    echo '<div id="tip">匹配成功，F5刷新网页愉快的聊天吧~~~</div>';
                    return;
                }


                $sql = "select * from a_users WHERE matchingID is NULL AND username != :username AND :timea-updatatime<20";
                $user = $users_model->findBySql($sql,array(
                    ':timea'=>$time,
                    ':username'=>$username
                ));
                if(isset($user))
                {
                    //找到了，匹配
                    $sql = "update a_users set matchingID =:ausername, matchingtime=:timea WHERE username = :usera";
                    $command = Yii::app()->db->createCommand($sql);
                    $u = $user->username;

                    $this->DAO_insert_4($sql,$u,$time,$username);
                    $this->DAO_insert_4($sql,$username,$time,$u);

                    //友好的提示
                    $sql = "INSERT INTO a_chat(username, chat, matchingtime) VALUES (:username, '你好，傻逼！',:timea)";
                    $this->DAO_insert_3($sql,$username,$time);
                    $this->DAO_insert_3($sql,$u,$time);

                    $this->redirect('index.php');
                    //$my = $users_model->find('username=:name',array(':name'=>Yii::app()->user->name));
                    //$user->username;//匹配的鬼
                }
                else
                {
                    echo '<div id="tip">暂时还没有人和你匹配捏，等等吧~</div>';
                }

                return;
            }
        }
        else
            $this->redirect('index.php?r=user/index');

	}

    private function searchchat($get, $t)
    {
        //找匹配丧病
        $user_model = Users::model();
        $user = $user_model->find('matchingID=:ID',array(':ID'=>$get))->username;

        $chat_model = Chat::model();

        $sql = "select * from a_chat WHERE matchingtime = :t AND (username=:geta OR username=:user) ORDER BY time DESC limit 20";
        $infos = $chat_model->findAllBySql($sql,array(
            ':t'=>$t,
            ':geta'=>$get,
            ':user'=>$user,
        ));

        $this->render('ajax',array('infos'=>$infos));

    }

    private  function check($get)
    {
        $get = trim($get);
        $get = stripslashes($get);
        $get = htmlspecialchars($get);

        return $get;
    }


}