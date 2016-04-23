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
                      <th>报名</th>
                      <th>成绩查询</th>
                  </tr>
              </thead>
              <tbody>
                  {foreach $data as $v}
                  <tr>
                      <td>{$v['id']}</td>
                      <td>{$v['name']}</td>
                      <td>{$v['exam_time']}</td>
                      <td>
                          <button class="btn btn-primary btn-mini btn-edit" data-exam-id="{$v['id']}">修改</button>
                          <button class="btn btn-danger btn-mini btn-delete" data-exam-id="{$v['id']}">删除</button>
                          <button class="btn btn-primary btn-mini btn-show" data-exam-id="{$v['id']}">查看</button>
                      </td>
                      <td>
                          <input class="enroll" type="checkbox" data-exam-id="{$v['id']}" data-size="mini" data-on-color="success" data-on-text="已开启" data-off-text="已关闭" {if $v['enroll_status'] eq 1}checked{/if}>
                      </td>
                      <td>
                          <input class="score" type="checkbox" data-exam-id="{$v['id']}" data-size="mini" data-on-color="success" data-on-text="已开启" data-off-text="已关闭" {if $v['score_status'] eq 1}checked{/if}>
                      </td>
                  </tr>
                  {/foreach}
              </tbody>
            </table>
            {include 'components/pagination.tpl'}
        </div>
        <div class="span12">
            <a type="button" href="/index.php/exam/add" class="btn btn-large btn-block ">新增考试项目</a>
        </div>
    </div>
</div>
{/block}
{block name=footeraddtion}
<script src="/vendors/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script src="/vendors/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js"></script>
<script src="/vendors/bootstrap-switch/dist/js/bootstrap-switch.min.js"></script>
<script src="/js/exam.js"></script>
{/block}
