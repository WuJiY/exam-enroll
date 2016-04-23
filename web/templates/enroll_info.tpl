{* Smarty *}
{extends file='layouts/student.tpl'}
{block name=nav}
    {include 'components/student/nav_enroll.tpl'}
{/block}
{block name='main'}

<div class="block">
    <div class="navbar navbar-inner block-header">
    </div>

    <div class="block-content collapse in">
        <legend>查看报名信息</legend>
        <div class="span12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th></th>
                        <th>报名项目</th>
                        <th>报名时间</th>
                        <th>考试时间</th>
                        <th>缴费情况</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach $data as $v}
                    <tr>
                        <td>{$v['id']}</td>
                        <td>{$v['name']}</td>
                        <td>{$v['create_time']}</td>
                        <td>{$v['exam_time']}</td>
                        <td>{if $v['pay_status'] eq 1}已缴费{else}未缴费{/if}</td>
                        <td>
                            <button class="btn btn-primary btn-mini btn-cancle-enroll" data-enroll-id="{$v['id']}">取消报名</button>
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
<script src="/js/enroll.js"></script>
{/block}
