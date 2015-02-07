var head_login = document.getElementById("head_login");
var head_register = document.getElementById("head_register");
var login = document.getElementById("login");
var register = document.getElementById("register");
var one = document.getElementById("MoreBlackOne");
var two = document.getElementById("MoreBlackTwo");
var loginWhite = document.getElementById("OnColorOne");
var registerWhite = document.getElementById("OnColorTwo");

head_login.onclick=function()
{
    register.style.display = "none";
    login.style.display = "";
    one.style.display = "none";
    two.style.display = "";
    head_login.style.color="white";
    head_register.style.color="#ccc";
}

head_login.onmouseover=function()
{
    loginWhite.style.display="";
}

head_login.onmouseout=function()
{
    loginWhite.style.display="none";
}

head_register.onclick=function()
{
    register.style.display = "";
    login.style.display = "none";
    two.style.display = "none";
    one.style.display = "";
    head_login.style.color="#ccc";
    head_register.style.color="white";
}

head_register.onmouseover = function()
{
    registerWhite.style.display="";
}

head_register.onmouseout=function()
{
    registerWhite.style.display="none";
}

function judge_log()
{
    // alert('df');
    var inf="";
    var sta=true;
    if(document.getElementById("LoginForm_username").value=="")
    {
        inf+="账号不能为空\n";
        sta=false;
    }
    if(document.getElementById("LoginForm_password").value=="" )
    {
        inf+="密码不能为空\n";
        sta=false;
    }
    if(!sta)
        alert(inf);
    else
        document.getElementById("Login").submit();
    return sta;
}
function judge_reg()
{
    // alert('df');
    var inf="";
    var sta=true;
    if(document.getElementById("Users_username").value=="")
    {
        inf+="账号不能为空\n\n";
        sta=false;
    }
    if(document.getElementById("reg_password_a").value=="" || document.getElementById("reg_password_b").value=="")
    {
        inf+="密码不能为空\n\n";
        sta=false;
    }
    if(document.getElementById("reg_password_a").value != document.getElementById("reg_password_b").value)
    {
        inf+="两次密码不一致\n\n";
        sta=false;
    }
    if(!sta)
        alert(inf);
    else
        document.getElementById("Register").submit();
    return sta;
}