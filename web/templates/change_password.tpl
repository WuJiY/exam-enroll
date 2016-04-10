{* Smarty *}
{extends file='layouts/student.tpl'}
{block name=nav}
    {include 'components/student/nav_profile.tpl'}
{/block}
{block name='main'}

<div class="block">
    <div class="navbar navbar-inner block-header">
    </div>
    <div class="block-content collapse in">
        <div class="span12">
             <form class="form-horizontal">
              <fieldset>
                  <legend>修改密码</legend>



                <div class="control-group">
                  <label class="control-label" for="focusedInput">输入原密码</label>
                  <div class="controls">
                    <input class="input-xlarge focused" id="focusedInput" type="text" placeholder="当前密码">
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" for="focusedInput">输入新密码</label>
                  <div class="controls">
                    <input class="input-xlarge focused" id="focusedInput" type="text" placeholder="新的密码">
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" for="focusedInput">再次输入</label>
                  <div class="controls">
                    <input class="input-xlarge focused" id="focusedInput" type="text" placeholder="重复新密码">
                  </div>
                </div>
                <div class="form-actions" >

               <button class="btn btn-primary"> &nbsp&nbsp&nbsp保存&nbsp&nbsp&nbsp </button>

                </div>
              </fieldset>
            </form>

        </div>
    </div>
</div>

{/block}
