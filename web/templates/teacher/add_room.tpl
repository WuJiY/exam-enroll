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
     <form class="form-horizontal">
              <fieldset>
        <legend>新增考场</legend>

        <div class="control-group">
                  <label class="control-label" for="focusedInput">考场编号</label>
                  <div class="controls">
                    <input class="input-xlarge focused" id="focusedInput" type="text" value="This is focused...">
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" for="focusedInput">可容纳人数</label>
                  <div class="controls">
                    <input class="input-xlarge focused" id="focusedInput" type="text" value="This is focused...">
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" for="focusedInput">考试地址</label>
                  <div class="controls">
                    <input class="input-xlarge focused" id="focusedInput" type="text" value="This is focused...">
                  </div>
                </div>

                <div class="form-actions" >

               <button class="btn btn-primary"> &nbsp&nbsp&nbsp添加&nbsp&nbsp&nbsp </button>

                </div>
       </fieldset>
       </form>
    </div>
</div>
{/block}
