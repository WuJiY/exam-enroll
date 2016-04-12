{* Smarty *}
{extends file='layouts/teacher.tpl'}
{block name=nav}
    {include 'components/teacher/nav_profile.tpl'}
{/block}
{block name='main'}

<div class="block">
    <div class="navbar navbar-inner block-header">
    </div>
    <div class="block-content collapse in">
        <div class="span12">
             <form class="form-horizontal" id="change-password">
              <fieldset>
                  <legend>修改密码</legend>
                <div class="control-group">
                  <label class="control-label" for="old_password">输入原密码</label>
                  <div class="controls">
                    <input class="input-xlarge focused" name="old_password" id="old_password" type="password" placeholder="当前密码">
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" for="focusedInput">输入新密码</label>
                  <div class="controls">
                    <input class="input-xlarge focused" name="new_password" id="new_password" type="password" placeholder="新的密码">
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" for="focusedInput">再次输入</label>
                  <div class="controls">
                    <input class="input-xlarge focused" name="re_passowrd" id="re_password" type="password" placeholder="重复新密码">
                  </div>
                </div>
                <div class="form-actions" >

               <input id="change_password_btn" class="btn btn-primary" type="button" value="保存" />

                </div>
              </fieldset>
            </form>

        </div>
    </div>
</div>

{/block}
