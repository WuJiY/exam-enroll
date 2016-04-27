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
            <form class="form-horizontal" method="post" action="/index.php/photo" enctype="multipart/form-data">
                <fieldset>
                    <legend>修改照片</legend>
                    <div class="control-group">
                        <label class="control-label"></label>
                        <div class="span3" style="width:150px;height:180px;">
                            <a href="#" class="thumbnail">
                                <img  style="width: 150px; height: 180px;" src="/index.php/image/{$info['name']}">
                            </a>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="photo">选择照片</label>
                        <div class="controls">
                            <input class="input-file uniform_on" name="photo" id="photo" type="file">
                        </div>
                    </div>
                    <div class="form-actions" >
                        <input type="submit" name="submit" value="保存">
                    </div>
                </fieldset>
            </form>

        </div>
    </div>
</div>

{/block}
