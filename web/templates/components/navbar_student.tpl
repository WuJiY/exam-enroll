{* Smarty *}
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
            </a>
            <a class="brand" href="/index.php">“三字一话”</a>
            <div class="nav-collapse collapse">
                <ul class="nav pull-right">
                    <li class="dropdown">
                        <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i>个人中心<i class="caret"></i>

                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a tabindex="-1" href="/index.php/profile">个人信息</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a tabindex="-1" href="/index.php/modify_photo">修改照片</a>
                            </li>
                            <li>
                                <a tabindex="-1" href="/index.php/change_password">修改密码</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a tabindex="-1" href="/index.php/auth/out">退出</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav">
                    <li class="{if $navbar_active eq 'index'}active{/if}">
                        <a href="/index.php/user">首页</a>
                    </li>
                    <li class="dropdown {if $navbar_active eq 'enroll'}active{/if}">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle">考试报名<b class="caret"></b>

                        </a>
                        <ul class="dropdown-menu" id="menu1">

                            <li>
                                <a href="/index.php/enroll">报名</a>
                            </li>
                            <li>
                                <a href="/index.php/enroll_info">查看报名情况</a>
                            </li>
                        </ul>
                    </li>
                    <li class="{if $navbar_active eq 'score'}active{/if}">
                        <a href="/index.php/score">成绩查询</a>
                    </li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
</div>
