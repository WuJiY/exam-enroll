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
                  <legend>修改照片</legend>
                 <div class="control-group">
                  <label class="control-label"></label>
                    <div class="span3" style="width:150px;height:180px;">
                        <a href="#" class="thumbnail">
                            <img  style="width: 150px; height: 180px;" src="images/photo.jpeg">
                        </a>
                    </div>
                </div>
                <div class="control-group">
                  <label class="control-label" for="fileInput">选择照片</label>
                  <div class="controls">
                    <input class="input-file uniform_on" id="fileInput" type="file">
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
