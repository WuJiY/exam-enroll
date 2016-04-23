{* Smarty *}
{extends file='../layouts/teacher.tpl'}
{block name=nav}
    {include 'components/teacher/nav_room.tpl'}
{/block}
{block name='main'}
<div class="block">
    <div class="navbar navbar-inner block-header">
    </div>
    <div class="block-content collapse in">
        <legend>教学楼列表</legend>
        <div class="span12">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th></th>
                  <th>编号</th>
                  <th>名称</th>
                  <th>备注</th>
                  <th>操作</th>
                </tr>
              </thead>
              <tbody>
                  {foreach $data as $v}
                  <tr>
                      <td>{$v['id']}</td>
                      <td>{$v['code']}</td>
                      <td>{$v['name']}</td>
                      <td>{$v['title']}</td>
                      <td>
                          <button class="btn btn-primary btn-mini btn-edit" data-building-id="{$v['id']}">修改</button>
                          <button class="btn btn-danger btn-mini btn-delete" data-building-id="{$v['id']}">删除</button>
                      </td>
                  </tr>
                  {/foreach}
              </tbody>
            </table>
            {include 'components/pagination.tpl'}
        </div>
        <div class="span12">
            <a type="button" href="/index.php/building/add" class="btn btn-large btn-block ">新增教学楼</a>
        </div>
    </div>
</div>
{/block}
{block name=footeraddtion}
<script src="/js/building.js"></script>
{/block}
