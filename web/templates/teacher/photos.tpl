{* Smarty *}
{extends file='../layouts/teacher.tpl'}
{block name=nav}
    {include 'components/teacher/nav_student.tpl'}
{/block}
{block name='main'}
<div class="block">
    <div class="navbar navbar-inner block-header">
    </div>
    <div class="block-content collapse in">
        <div class="span12">
             <form class="form-horizontal">
              <fieldset>
                  <legend>导出照片</legend>




               <button class="btn btn-primary"> &nbsp&nbsp&nbsp导出（按学号命名）&nbsp&nbsp&nbsp </button>
               <button class="btn btn-primary"> &nbsp&nbsp&nbsp导出（按姓名命名）&nbsp&nbsp&nbsp </button>

              </fieldset>
            </form>

        </div>
    </div>
</div>
{/block}
