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
            <form class="form-horizontal" id="exam-edit">
                <fieldset>
                    <legend>修改考试项目</legend>

                    <div class="control-group">
                        <label class="control-label" for="name">考试名称 </label>
                        <div class="controls">
                            <input type="text" name="name" id="name" placeholder="输入考试名称，最大20个汉字" value="{$data['name']}">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="type">考试类型</label>
                        <div class="controls">
                            <select name="type" id="type" class="chzn-select">
                                {foreach $exam_types as $exam_type}
                                <option value="{$exam_type['id']}" {if $data['type'] eq $exam_type['id']}selected{/if}>{$exam_type['name']}</option>
                                {/foreach}
                            </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="date01">开始考试时间</label>
                        <div class="controls">
                            <input name="exam_time" type="text" class="input-xlarge datepicker" data-date-format="yyyy-mm-dd hh:ii" id="datetimepicker" value="{$data['exam_time']}">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="textarea2">考试说明</label>
                        <div class="controls">
                            <textarea name="title" id="title" class="input-xlarge textarea" placeholder="Enter text ...">{$data['title']}</textarea>
                        </div>
                    </div>
                    <div class="form-actions">
                        <input id="exam-edit-btn" type="button" class="btn btn-primary" value="保存" data-exam-id="{$data['id']}"> </input>
                    </div>
                </fieldset>
            </form>

        </div>
    </div>
</div>
{/block}
{block name=footeraddtion}
<script src="/vendors/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script src="/vendors/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js"></script>
<script src="/vendors/bootstrap-switch/dist/js/bootstrap-switch.min.js"></script>
<script src="/js/exam.js"></script>
{/block}
