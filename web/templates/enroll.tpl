{* Smarty *}
{extends file='layouts/student.tpl'}
{block name=nav}
    {include 'components/student/nav_enroll.tpl'}
{/block}
{block name='main'}

<div class="block">
    <div class="navbar navbar-inner block-header">
    </div>
    <div class="block-content collapse in">
        <div class="span12">
            <form class="form-horizontal">
              <fieldset>
                <legend>请选择报名项目</legend>

                <div class="control-group">
                  <label class="control-label" for="optionsCheckbox">钢笔字</label>
                  <div class="controls">
                      <input class="uniform_on" type="checkbox" id="optionsCheckbox" value="option1">
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" for="optionsCheckbox">毛笔字</label>
                  <div class="controls">
                      <input class="uniform_on" type="checkbox" id="optionsCheckbox" value="option1">
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" for="optionsCheckbox">粉笔字</label>
                  <div class="controls">
                      <input class="uniform_on" type="checkbox" id="optionsCheckbox" value="option1">
                  </div>
                </div>

                <hr>
                <div class="control-group">
                  <label class="control-label" for="optionsCheckbox">普通话</label>
                  <div class="controls">
                      <input class="uniform_on" type="checkbox" id="optionsCheckbox" value="option1">
                  </div>
                </div>



                <div class="form-actions">
                  <button type="submit" class="btn btn-primary">Save changes</button>
                  <button type="reset" class="btn">Cancel</button>
                </div>
              </fieldset>
            </form>

        </div>
    </div>
</div>

{/block}
