<?php

class UserController extends Controller
{
	public function actionIndex()
	{
        $user_model = new LoginForm();
        $user_register = new Users();

        //login
        if(isset($_POST['LoginForm']))
        {
            $user_model->attributes = $_POST['LoginForm'];
            if($user_model->validate() && $user_model->login())
            {
                $this->updatatime($user_model->username);
                $this ->redirect ('index.php');
            }
        }

        //register
        if(isset($_POST['Users']))
        {
            $user_register->attributes = $_POST['Users'];
            $user_register->password = md5($user_register->password);
            if($user_register->save())
            {
                $user_model->attributes = $_POST['Users'];
                if($user_model->validate() && $user_model->login())
                {
                    //echo 'register';
                    $this->updatatime($user_model->username);
                    $this ->redirect ('index.php');
                }
            }
        }

		$this->render('index', array(
            'user_model' => $user_model,
            'user_register'=>$user_register));
	}

    public function updatatime($username)
    {
        $time = time();
        $sql = "update a_users SET updatatime=:username WHERE username=:timea";
        $this->DAO_insert_3($sql,$time,$username);
    }

}