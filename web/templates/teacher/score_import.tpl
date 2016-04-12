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
        <div class="span12">
             <form class="form-horizontal">
              <fieldset>
                  <legend>导入成绩</legend>

                <div class="control-group">
                  <label class="control-label" for="fileInput">选择文件</label>
                  <div class="controls">
                    <input class="input-file uniform_on" id="fileInput" type="file">
                  </div>
                </div>
                <div class="form-actions" >

               <button class="btn btn-primary"> &nbsp&nbsp&nbsp导入&nbsp&nbsp&nbsp </button>

                </div>
              </fieldset>
            </form>

        </div>
    </div>
</div>
{/block}
