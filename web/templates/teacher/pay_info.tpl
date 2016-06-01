{* Smarty *}
{extends file='../layouts/teacher.tpl'}
{block name=nav}
    {include 'components/teacher/nav_student.tpl'}
{/block}
{block name=headaddtion}
    <link rel="stylesheet" href="/vendors/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css" >
{/block}
{block name='main'}
<div class="block">
    <div class="navbar navbar-inner block-header">
    </div>
    <div class="block-content collapse in">
         <div class="span6" align="right" style="width="100%""></div>
       <div class="span6" align="right" style="width="100%""><div id="example2_filter" class="dataTables_filter"><label>Search: <input aria-controls="example2" type="text"></label></div></div>

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
                        <th>缴费情况</th>
                    </tr>
                </thead>
                <tbody>

                        {foreach $data as $v}
                        <tr>
                            <td>{$v['id']}</td>
                            <td>{$v['student_number']}</td>
                            <td>{$v['name']}</td>
                            <td>{$v['college']}</td>
                            <td>{$v['major']}</td>
                            <td>{$v['grade']}</td>
                            <td>{$v['class']}</td>
                            <td>
                                <input class="paystatus" type="checkbox" data-enroll-id="{$v['id']}" data-size="mini" data-on-color="success" data-on-text="已缴费" data-off-text="未缴费" {if $v['pay_status'] eq 1}checked{/if}>
                            </td>
                        </tr>
                        {/foreach}
              </tbody>
            </table>
            {include 'components/pagination.tpl'}
        </div>

    </div>
</div>
{/block}
{block name=footeraddtion}
    <script src="/vendors/bootstrap-switch/dist/js/bootstrap-switch.min.js"></script>
    <script src="/js/pay_info.js"></script>
{/block}