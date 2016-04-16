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
        <div class="span12">
            <form class="form-horizontal">
              <fieldset>
                <legend>修改考试项目</legend>

                <div class="control-group">
                  <label class="control-label" for="select01">考试项目</label>
                  <div class="controls">
                    <select id="select01" class="chzn-select">
                      <option>钢笔字</option>
                      <option>毛笔字</option>
                      <option>粉笔字</option>
                      <option>普通话</option>
                    </select>
                  </div>
                </div>

                <div class="control-group">
                  <label class="control-label" for="date01">Date input</label>
                  <div class="controls">
                    <input type="text" class="input-xlarge datepicker" id="date01" value="02/16/2016">
                  </div>
                </div>



                <div class="control-group">
                  <label class="control-label" for="textarea2">Textarea WYSIWYG</label>
                  <div class="controls">
                    <textarea class="input-xlarge textarea" placeholder="Enter text ..." style="width: 810px; height: 200px"></textarea>
                  </div>
                </div>
                <div class="form-actions">
                  <button type="submit" class="btn btn-primary">&nbsp&nbsp&nbsp保存&nbsp&nbsp&nbsp </button>
                  <button type="reset" class="btn">&nbsp取消&nbsp&nbsp </button>
                </div>
              </fieldset>
            </form>

        </div>
    </div>
</div>
{/block}
