Anonymous Chat
==
****
>这是我第一个yii应用。匿名聊天包含了yii很多基本的功能：注册，登陆，表单提交，验证，数据逻辑处理等等……  
>做完之后，我对yii框架有了更深的了解，同时在打码过程中，谷歌了很多东西，积累了很多有用的经验  

* 效果：[http:1.earlhwong.sinaapp.com/anonchat/](http:1.earlhwong.sinaapp.com/anonchat/)  

* 原理：
	1. UserController处理注册登陆
	2. SiteController进行匹配，聊天，没登陆重定向到登陆页面
	3. 利用Ajax进行判断是否匹配，进行匹配，输出聊天信息，判断依据为是否带有参数时间 t ，t为匹配的时间，输出聊天信息从t开始输出
	4. 判断用户匹配，数据表中设matchID，没匹配为NULL
	5. 判断用户是否在线的方法是存用户操作时间，Ajax请求一次，数据表更新在线时间，若在线时间与当前时间相差20s，用户关闭浏览器非法退出，此时匹配时就要忽略这些用户，