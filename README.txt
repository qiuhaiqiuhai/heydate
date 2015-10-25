差不多了，你可以直接在我php文件上改了。
主要5个php file：
1)index.php
2)registration.php
	register.php是用来handle form的。
3)search_result.php
4)profile.php
	profile_action.php用来handle form当你改个人信息的时候
5)browse_profile.php
	browse_action.php.php用来handle form当你like或者dislike别人


dbconnect.php是连sql server用的(有一些php我自定义的function在里面)
members_only.php是检测登陆的
display_smallprofile.php就是当需要打出来一大堆带人头像的小方块时候include进来的
right_second_bar.php也是单独出来做profile右边一溜你喜欢的人喜欢你的人什么的
logout.php就是结束你登录session

搜索我现在只把age作为条件query，别的都比较直接，还没弄，要不搜不出东西，你做好了自己加吧。
heydatedb.sql是我直接从phpmyadmin上export出来的，
createheydatedb.sql是最开始建的，好多entry没有
密码要不跟人名儿一样就是test

加油！