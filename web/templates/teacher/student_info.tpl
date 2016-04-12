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
    <legend>个人信息</legend>
        <div class="span12">
             <form class="form-horizontal">
              <fieldset>
                 <div class="control-group"></div>

                 <div class="control-group">
                  <label class="control-label">照片</label>
                    <div class="span3" style="width:150px;height:180px;">
                        <a href="#" class="thumbnail">
                            <img  style="width: 150px; height: 180px;" src="images/photo.jpeg">
                        </a>
                    </div>
                </div>


                <div class="control-group">
                  <label class="control-label">学号</label>
                  <div class="controls">
                    <span class="input-xlarge uneditable-input">Some value here</span>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">姓名</label>
                  <div class="controls">
                    <span class="input-xlarge uneditable-input">Some value here</span>
                  </div>
                </div>
                 <div class="control-group">
                  <label class="control-label">学院</label>
                  <div class="controls">
                    <span class="input-xlarge uneditable-input">Some value here</span>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">专业</label>
                  <div class="controls">
                    <span class="input-xlarge uneditable-input">Some value here</span>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">年级</label>
                  <div class="controls">
                    <span class="input-xlarge uneditable-input">Some value here</span>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">班级</label>
                  <div class="controls">
                    <span class="input-xlarge uneditable-input">Some value here</span>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">性别</label>
                  <div class="controls">
                    <span class="input-xlarge uneditable-input">Some value here</span>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">民族</label>
                  <div class="controls">
                    <span class="input-xlarge uneditable-input">Some value here</span>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">身份证号码</label>
                  <div class="controls">
                    <span class="input-xlarge uneditable-input">Some value here</span>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">电话号码</label>
                  <div class="controls">
                    <span class="input-xlarge uneditable-input">Some value here</span>
                  </div>
                </div>

                 <div class="form-actions" >

                <button class="btn btn-primary"> &nbsp&nbsp&nbsp修改&nbsp&nbsp&nbsp </button>
                <button class="btn"> &nbsp&nbsp&nbsp返回&nbsp&nbsp&nbsp </button>

                </div>

              </fieldset>
            </form>

        </div>
    </div>
</div>
{/block}
