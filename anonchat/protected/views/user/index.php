

<html>
<head>
    <meta charset = "utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="images/ico.ico"/>
    <title>登陆AnonymousChat</title>
    <link rel="stylesheet" type="text/css" href="css/login.css"/>
</head>

<body>

<div id = "bg"><img src="images/logbg.jpg" height=1080px width=1920px/></div>

<div id="contents">
    <div style="height:18%;width: 100%;"> </div>
    <!--离顶部距离-->

    <div style="height: 50px;font-size: 50px;"><center>Anonymous Chat</center></div>

    <div style="height: 4%;"></div>

    <div id="content">
        <div style="position:absolute;width: 400px;height:250px;z-index: -2">
            <img src="images/black2.png" height=100% width=100%>
        </div>
        <!--半透明黑色背景-->

        <div id="head" style="height: 40px;width: 400px">
            <div id="head_login">

                <div id="MoreBlackOne" style="position:absolute;width: 200px;height:40px;display:none;z-index: -2">
                    <img src="images/black1.png" height=100% width=100%>
                </div>

                <div id="OnColorOne" style="display: none">
                    <img src="images/white2.png" height=100% width=100%>
                </div>
                Login
            </div>
            <div id="head_register">

                <div id="MoreBlackTwo" style="position:absolute;width: 200px;height:40px;z-index: -2">
                    <img src="images/black3.png" height=100% width=100%>
                </div>

                <div id="OnColorTwo" style="display: none">
                    <img src="images/white2.png" height=100% width=100%>
                </div>
                register
            </div>
        </div>
        <!--头部-->

        <div id="log_reg" style="width: 400px;height: 360px;text-align: center;">
            <div id="login" >

                <?php $form = $this->beginWidget('CActiveForm',array(
                    'id'=>'Login',
                    'action'=>'index.php?r=user/index',
                    'enableClientValidation'=>true,
                    'clientOptions'=>array(
                        'validateOnSubmit'=>true,
                    ),
                )); ?>
                <?php echo $form->error($user_model,'username'); ?>
                <?php echo $form->error($user_model,'password'); ?>
                <?php echo $form->error($user_register,'isexist'); ?>


                <div style="width: 400px;height: 20px;"></div>
                    <div>

                        <div id="username"><img src="images/white3.png"/>
                            <?php echo $form->textField($user_model,'username',array(
                                'maxlength'=>'10',
                                'placeholder' => '  Username',
                            )); ?>
                            <!--<input id="User_username" type="text" maxlength="10" placeholder=" Username" name="username" value="" style="width:200px;height:35px;font-size:20px;font-family:Lucida Console;"  />
-->
                        </div>

                        <div style="width: 400px;height: 10px;"></div>

                        <div id="password"><img src="images/white4.png"/>
                           <!-- <input id="User_password" name="password" type="password" placeholder="  Password" maxlength="15" value="" style="width:200px;height:35px;font-size:20px;"  />
-->
                            <?php echo $form->passwordField($user_model,'password',array(
                                'maxlength'=>'15',
                                'placeholder' => '  Password',
                            )); ?>
                            <input type="hidden" name="submit1"/>
                        </div>
                    </div>

                    <div>
                        <a class="but" onclick='judge_log();'>Login
                        </a>
                    </div>

                    <div style="width: 400px;height: 10px"></div>

                <?php $this->endWidget(); ?>
            </div>

            <div id="register" style="display: none">

                    <?php $form = $this->beginWidget('CActiveForm',array(
                        'id'=>'Register',
                        'action'=>'index.php?r=user/index',
                        'enableClientValidation'=>true,
                        'clientOptions'=>array(
                            'validateOnSubmit'=>true,
                        ),

                    )); ?>
                <?php echo $form->error($user_register,'username'); ?>
                <?php echo $form->error($user_register,'isexist'); ?>

                <div id="username"><img src="images/white3.png"/>

                        <!--<input id="reg_username" type="text" maxlength="10" placeholder="  Username" name="username" value="" style="width:200px;height:35px;font-size:20px;font-family:Lucida Console;"  />
                        --><?php echo $form->textField($user_register,'username',array(
                            'placeholder'=>'  Username',
                        )); ?>

                    </div>

                    <div style="width: 400;height: 5px;"></div>

                    <div id="password"><img src="images/white4.png"/>
                        <?php echo $form->passwordField($user_register,'password',array(
                            'placeholder'=>'  password',
                            'id'=>'reg_password_a'

                        )); ?>
                        <!--<input id="reg_password_a" type="password" maxlength="10" placeholder="  Password" name="password" value="" style="width:200px;height:35px;font-size:20px;font-family:Lucida Console;"  />
-->
                    </div>

                    <div id="password"><img src="images/white4.png"/>
                        <!--<input id="reg_password_b" type="password" maxlength="10" placeholder="  Password" name="password" value="" style="width:200px;height:35px;font-size:20px;font-family:Lucida Console;"  />
                        --><?php echo $form->passwordField($user_register,'password',array(
                            'placeholder'=>'  password',
                            'id'=>'reg_password_b',
                            'name'=>'password',

                        )); ?>


                        <input type="hidden" name="submit2"/>
                    </div>

                    <div><a class="but" onClick='judge_reg();'>Register</a>
                    </div>
                <?php $this->endWidget(); ?>

            </div>
        </div>

    </div>
</div>

<script type="text/javascript" rel="script" src="js/login.js">

</script>
</body>
</html>


<!-- <form name="login"   method="post" action="assess.php">
					<table border="0" width="336px" height="350">
                		<tr><td style="font-family:隶书; font-size:30px;  text-align:center; color: #03F">账号密码登陆</td></tr>

                        <tr><td><input type="text" maxlength="10" placeholder="注册或登录的账号" name="username" value="" style="width:300px;height:35px;font-size:20px;font-family:幼圆;"  /></td></tr>
               			<tr><td><input name="password" type="password" placeholder="密码" maxlength="15" value="" style="width:300px;height:35px;font-size:20px;font-family:黑体;"  /></td></tr>

               			<tr><td><input type="submit" name="submit1" value="登陆" style="border:0px; width:300px; height:40px; background-color:#4169E1;color:white; font-size:25px;font-family:隶书;"/></td></tr>


               			 <tr><td style="font-size:30px;"><input type="submit" name="submit3" value="修改密码" style=" border:0px;width:120px; height:50px; color:#903; font-family:隶书; font-size:20px"/> <input type="submit" name="submit2" value="注册" style=" font-size:20px; border:0px;width:180px; height:50px; color:#903;font-family:隶书;"/></td></tr>
               		</table>
                </form>
 -->