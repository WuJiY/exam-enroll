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
        <form class="form-horizontal" id="room-add">
            <fieldset>
                <legend>新增考场</legend>

                <div class="control-group">
                    <label class="control-label" for="code">考场编号</label>
                    <div class="controls">
                        <input class="input-xlarge focused" id="code" name="code" type="text" placeholder="考场编号，如203,310等">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="volume">可容纳人数</label>
                    <div class="controls">
                        <input class="input-xlarge focused" id="volume" name="volume" type="text" placeholder="30">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="building">考试地址</label>
                    <div class="controls">
                        <select name="building" id="building" class="chzn-select">
                            {foreach $buildings as $building}
                            <option value="{$building['id']}">{$building['name']}</option>
                            {/foreach}
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="title">备注</label>
                    <div class="controls">
                    <input class="input-xlarge focused" id="title" name="title" type="text" placeholder="关于这个教室的备注">
                </div>

                <div class="form-actions" >
                    <input type="button" class="btn btn-primary" id="room-add-btn" value="添加">
                </div>
            </fieldset>
       </form>
    </div>
</div>
{/block}
