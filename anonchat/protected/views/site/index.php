
<html lang="zh-CN">
<head>
    <title>AnonChat</title>
    <meta  charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="ico.ico"/>
    <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.2/css/bootstrap.min.css">

    <style>
        body
        {
            background-color: #f4debf;
            font-family: "Helvetica Neue", Arial, Helvetica, sans-serif;
        }
        #p
        {
            width: 200px;
        }
        #Chat_chat_em_
        {
            width: 200px;
        }
        #say
        {
            width: 200px;
        }
        .form-control
        {
            height: 50px;
        }
    </style>
</head>


<body>

<div class="container">
    <br>
    <br>
    <br>
    <a class="btn btn-default btn-block btn-lg" href="index.php?r=site/logout" style="width: 200px"><?php echo Yii::app()->user->name ?> 要退出</a>


    <br>
    <br>
    <br>


    <p id="p" class="lead list-group-item active">AnonymousChat</p>

    <br>
    <br>
    <br>

    <?php $form = $this->beginWidget('CActiveForm',array(
    'enableClientValidation'=>true,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
    )
    )
); ?>
<?php
    if(isset($chat_model))
    {
        echo $form->textField($chat_model,'chat',array(
            'class'=>'form-control',
            'placeholder'=>'我是输入框……',
        ));

    }
?>





<input type="hidden" value="<?php echo time(); ?>" name="time"/>
<br/>


<?php
if(isset($chat_model))

echo $form->error($chat_model,'chat',array(
    'class'=>'alert alert-warning',
));
?>
    <br/>
<input id="say" type="submit" class="btn btn-info btn-block btn-lg" value="噗噗噗"/>

<br/>
<?php $this->endWidget(); ?>

<div><p id="txtHint"></p></div>

</div>
<script>

    ajax();
    window.setInterval("ajax()",5000);
    function ajax()
    {
        //the matchingtime means it has matched
        var url = 'index.php?r=ajax/ajax&name=<?php echo Yii::app()->user->name;
        if(isset($matchingtime))
        {
           echo '&t='.$matchingtime;
        }
        ?>';
        //alert(url);
        var xmlhttp;

        if (window.XMLHttpRequest)
        {// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
        }
        else
        {// code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function()
        {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET",url,true);
        xmlhttp.send();

    }

</script>
</body>
</html>

