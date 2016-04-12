{* Smarty *}
{* Smarty *}
{extends file='../layouts/teacher.tpl'}
{block name=nav}
    {include 'components/teacher/nav_diploma.tpl'}
{/block}
{block name='main'}
<div class="block">
    <div class="navbar navbar-inner block-header">
    </div>
    <div class="block-content collapse in">
        <div class="span12">
             <form class="form-horizontal">
              <fieldset>
                  <legend>证书管理</legend>


                 <div class="control-group">
                </div>

               <button class="btn btn-primary"> &nbsp&nbsp&nbsp生成证书&nbsp&nbsp&nbsp </button>
               <button class="btn btn-primary"> &nbsp&nbsp&nbsp下载证书&nbsp&nbsp&nbsp </button>


              </fieldset>
            </form>

        </div>
    </div>
</div>
{/block}
