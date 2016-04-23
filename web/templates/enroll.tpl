{* Smarty *}
{extends file='layouts/student.tpl'}
{block name=nav}
    {include 'components/student/nav_enroll.tpl'}
{/block}
{block name=headaddtion}
<link rel="stylesheet" href="/vendors/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css" >
{/block}
{block name='main'}

<div class="block">
    <div class="navbar navbar-inner block-header">
    </div>
    <div class="block-content collapse in">
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h4>注意</h4>
            <p>
                在报名期间，你可以任意选择报名和不报名，最终的报名情况将按照报名截止日期计算。
            </p>
        </div>
        <div class="span12">
            <form class="form-horizontal">
              <fieldset>
                <legend>请选择报名项目</legend>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>名称</th>
                            <th>类型</th>
                            <th>考试时间</th>
                            <th>说明</th>
                            <th>报名</th>
                        </tr>
                    </thead>
                    <tbody>
                        {foreach $data as $v}
                        <tr>
                            <td>{$v['name']}</td>
                            <td>{$v['type_name']}</td>
                            <td>{$v['exam_time']}</td>
                            <td>{$v['title']}</td>
                            <td>
                                <input class="enroll" type="checkbox" data-exam-id="{$v['id']}" data-size="mini" data-on-color="success" data-on-text="已选择" data-off-text="未选择" {if $v['enroll_status'] eq 1}checked{/if}>
                            </td>
                        </tr>
                        {/foreach}
                    </tbody>
                </table>
              </fieldset>
            </form>

        </div>
    </div>
</div>

{/block}
{block name=footeraddtion}
<script src="/vendors/bootstrap-switch/dist/js/bootstrap-switch.min.js"></script>
<script src="/js/enroll.js"></script>
{/block}
