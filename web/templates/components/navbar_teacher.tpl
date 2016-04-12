{* Smparty *}
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
                    <li class="{if $navbar_active eq 'user'}active{/if}">
                        <a href="/index.php/user">首页</a>
                    </li>
                    <li class="{if $navbar_active eq 'exam'}active{/if}">
                        <a href="/index.php/exam" >考试管理</a>
                    </li>
                    <li class="dropdown {if $navbar_active eq 'student'}active{/if}">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle">学生管理<b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu" id="menu1">
                            <li>
                                <a href="/index.php/import/student_account">导入学生信息</a>
                            </li>
                            <li>
                                <a href="/index.php/student_info">查看学生信息</a>
                            </li>
                            <li>
                                <a href="/index.php/import/pay_info">导入缴费情况</a>
                            </li>
                            <li>
                                <a href="/index.php/pay_info">查看缴费情况</a>
                            </li>
                            <li>
                                <a href="/index.php/import/photos">导入照片</a>
                            </li>
                            <li>
                                <a href="/index.php/photos">导出照片</a>
                            </li>
                            <li>
                                <a href="/index.php/import/score">导入成绩</a>
                            </li>
                            <li>
                                <a href="/index.php/score">查看成绩</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown {if $navbar_active eq 'room'}active{/if}">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle">考场管理<b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu" id="menu1">
                            <li >
                                <a href="/index.php/room">查看当前考场</a>
                            </li>
                            <li>
                                <a href="/index.php/room/add">新增考场</a>
                            </li>
                            <li>
                                <a href="/index.php/room/allot">分配考场</a>
                            </li>
                        </ul>
                    </li>
                    <li class="{if $navbar_active eq 'diploma'}active{/if}">
                        <a href="/index.php/diploma" >证书管理 </a>
                    </li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
</div>
