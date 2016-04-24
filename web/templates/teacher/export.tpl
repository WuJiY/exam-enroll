{* Smarty *}
{extends file='../layouts/teacher.tpl'}
{block name=headaddtion}
<link rel="stylesheet" href="/vendors/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css" >
{/block}
{block name=nav}
    {include 'components/teacher/nav_exam.tpl'}
{/block}
{block name='main'}
<div class="block">
    <div class="navbar navbar-inner block-header">
    </div>
    <div class="block-content collapse in">
        <legend>考试管理</legend>
        <div class="span12">
            <table class="table table-hover">
              <thead>
                  <tr>
                      <th></th>
                      <th>项目</th>
                      <th>考试时间</th>
                      <th>操作</th>
                  </tr>
              </thead>
              <tbody>
                  {foreach $data as $v}
                  <tr>
                      <td>{$v['id']}</td>
                      <td>{$v['name']}</td>
                      <td>{$v['exam_time']}</td>
                      <td>
                          <input class="select" type="checkbox" data-exam-id="{$v['id']}" data-size="mini" data-on-color="success" data-on-text="已选择" data-off-text="未选择">
                      </td>
                  </tr>
                  {/foreach}
              </tbody>
            </table>
        </div>
        <div class="span12">
            <input type="button" class="btn btn-large btn-block" id="btn-export" value="导出学生信息">
        </div>
    </div>
</div>
{/block}
{block name=footeraddtion}
<script src="/vendors/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script src="/vendors/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js"></script>
<script src="/vendors/bootstrap-switch/dist/js/bootstrap-switch.min.js"></script>
<script src="/js/export.js"></script>
{/block}
