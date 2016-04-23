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
        <form class="form-horizontal" id="building-edit">
            <fieldset>
                <legend>编辑教学楼</legend>

                <div class="control-group">
                    <label class="control-label" for="name">教学楼名称</label>
                    <div class="controls">
                        <input class="input-xlarge focused" id="name" name="name" type="text" placeholder="教学楼名称，如八教" value="{$data['name']}">
                    </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="code">编码</label>
                        <div class="controls">
                            <input class="input-xlarge focused" id="code" name="code" type="text" placeholder="教学楼编码，如8, 25" value="{$data['code']}">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="title">备注</label>
                        <div class="controls">
                        <input class="input-xlarge focused" id="title" name="title" type="text" placeholder="关于这个教学楼的备注" value="{$data['title']}">
                    </div>
                </div>

                <div class="form-actions" >
                    <input type="button" class="btn btn-primary" id="building-edit-btn" data-building-id="{$data['id']}" value="保存">
                </div>
            </fieldset>
       </form>
    </div>
</div>
{/block}
