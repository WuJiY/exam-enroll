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
        <form class="form-horizontal" id="room-edit">
            <fieldset>
                <legend>修改考场</legend>

                <div class="control-group">
                    <label class="control-label" for="code">考场编号</label>
                    <div class="controls">
                        <input class="input-xlarge focused" id="code" name="code" type="text" value="{$data['code']}" placeholder="考场编号，如203,310等">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="volume">可容纳人数</label>
                    <div class="controls">
                        <input class="input-xlarge focused" id="volume" name="volume" value="{$data['volume']}" type="text" placeholder="30">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="building">考试地址</label>
                    <div class="controls">
                        <select name="building" id="building" class="chzn-select">
                            {foreach $buildings as $building}
                            <option value="{$building['id']}" {if $data['location'] eq $building['id']}selected{/if}>{$building['name']}</option>
                            {/foreach}
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="title">备注</label>
                    <div class="controls">
                    <input class="input-xlarge focused" id="title" name="title" value="{$data['title']}" type="text" placeholder="关于这个教室的备注">
                </div>

                <div class="form-actions" >
                    <input type="button" class="btn btn-primary" id="room-edit-btn" data-room-id="{$data['id']}" value="保存">
                </div>
            </fieldset>
       </form>
    </div>
</div>
{/block}
