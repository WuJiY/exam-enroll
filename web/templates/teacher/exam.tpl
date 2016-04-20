{* Smarty *}
{extends file='../layouts/teacher.tpl'}
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
                  <th>编辑</th>
                  <th>开启报名</th>
                  <th>关闭报名</th>
                  <th>开启成绩查询</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Mark</td>
                  <td>Otto</td>
                  <td><a href="#">编辑</a></td>
                  <td>
                      <button class="btn btn-primary btn-mini">开启</button>
                  </td>
                  <td>
                      <button class="btn btn-danger btn-mini">关闭</button>
                  </td>
                  <td>
                      <button class="btn btn-primary btn-mini">开启</button>
                  </td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>Jacob</td>
                  <td>Thornton</td>
                  <td><a href="#">编辑</a></td>
                  <td>
                      <button class="btn btn-primary btn-mini">开启</button>
                  </td>
                  <td>
                      <button class="btn btn-danger btn-mini">关闭</button>
                  </td>
                  <td>
                      <button class="btn btn-primary btn-mini">开启</button>
                  </td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>Larry</td>
                  <td>the Bird</td>
                  <td><a href="#">编辑</a></td>
                  <td>
                      <button class="btn btn-primary btn-mini">开启</button>
                  </td>
                  <td>
                      <button class="btn btn-danger btn-mini">关闭</button>
                  </td>
                  <td>
                      <button class="btn btn-primary btn-mini">开启</button>
                  </td>
                </tr>
              </tbody>
            </table>
        </div>
        <div class="span12">
            <a type="button" href="/index.php/exam/add" class="btn btn-large btn-block ">新增考试项目</a>
        </div>
    </div>
</div>
{/block}
