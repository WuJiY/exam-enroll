{* Smarty *}
{extends file='../layouts/teacher.tpl'}
{block name=nav}
    {include '../components/teacher/nav_student.tpl'}
{/block}
{block name='main'}
<div class="block">
    <div class="navbar navbar-inner block-header">

    </div>
    <div class="block-content collapse in">
    <legend>成绩查询</legend>
        <div class="span12">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th></th>
                  <th>考试项目</th>
                  <th>报名时间</th>
                  <th>考试时间</th>
                  <th>分数</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Mark</td>
                  <td>Otto</td>
                  <td>@mdo</td>
                  <td>@mdo</td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>Jacob</td>
                  <td>Thornton</td>
                  <td>@fat</td>
                  <td>@mdo</td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>Larry</td>
                  <td>the Bird</td>
                  <td>@twitter</td>
                  <td>@mdo</td>
                </tr>
              </tbody>
            </table>
        </div>
    </div>
</div>
{/block}
