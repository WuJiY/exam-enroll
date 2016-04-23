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
        <legend>考场类型列表</legend>
        <div class="span12">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th></th>
                  <th>考场编号</th>
                  <th>考试地点</th>
                  <th>可容纳人数</th>
                  <th>已容纳人数</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Mark</td>
                  <td>Otto</td>
                  <td>Mark</td>
                  <td>Otto</td>
                </tr>
              </tbody>
            </table>
        </div>

    </div>
</div>
{/block}
