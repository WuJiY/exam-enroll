{* Smarty *}
{extends file='../layouts/teacher.tpl'}
{block name=nav}
    {include 'components/teacher/nav_student.tpl'}
{/block}
{block name='main'}
<div class="block">
    <div class="navbar navbar-inner block-header">
    </div>
    <div class="block-content collapse in">
         <div class="span6" align="left" style="width="100%""></div>
         <div class="span6" align="right" style="width="100%"">
             <div id="example2_filter" class="dataTables_filter">
                 <label>Search: <input aria-controls="example2" type="text"></label>
             </div>
         </div>

        <div class="span12">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th></th>
                        <th>学号</th>
                        <th>姓名</th>
                        <th>学院</th>
                        <th>专业</th>
                        <th>年级</th>
                        <th>班级</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach $data as $v}
                        <tr>
                            <td>{$v['uid']}</td>
                            <td>{$v['student_number']}</td>
                            <td>{$v['name']}</td>
                            <td>{$v['college']}</td>
                            <td>{$v['major']}</td>
                            <td>{$v['grade']}</td>
                            <td>{$v['class']}</td>
                            <td>
                                <button class="btn btn-primary btn-mini" data-user-id="{$v['uid']}">修改</button>
                                <button class="btn btn-danger btn-mini" data-user-id="{$v['uid']}">删除</button>
                                <button class="btn btn-primary btn-mini" data-user-id="{$v['uid']}">查看</button>
                            </td>
                        </tr>
                    {/foreach}
                </tbody>
            </table>
            {include 'components/pagination.tpl'}
        </div>

        <button type="button" class="btn btn-large btn-block ">新增学生信息</button>

    </div>
</div>

{/block}
