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
                  <th>成绩</th>
                  <th>修改</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Mark</td>
                  <td>Otto</td>
                  <td>Otto</td>
                  <td>Otto</td>
                  <td>Otto</td>
                  <td>Otto</td>
                  <td>Otto</td>
                  <td><button class="btn btn-primary btn-mini">修改</button>
                 </td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>Mark</td>
                  <td>Otto</td>
                  <td>Otto</td>
                  <td>Otto</td>
                  <td>Otto</td>
                  <td>Otto</td>
                  <td>Otto</td>
                  <td><button class="btn btn-primary btn-mini">修改</button>
                 </td>
                </tr>
                <tr>
                   <td>3</td>
                  <td>Mark</td>
                  <td>Otto</td>
                  <td>Otto</td>
                  <td>Otto</td>
                  <td>Otto</td>
                  <td>Otto</td>
                  <td>Otto</td>
                  <td><button class="btn btn-primary btn-mini">修改</button>
                 </td>
                </tr>
              </tbody>
            </table>
        </div>

    </div>
</div>
{/block}
