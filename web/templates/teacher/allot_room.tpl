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
        <!-- TODO 获取考场信息以及考试信息 -->
        <fieldset>
            <legend>分配考场</legend>
            <div class="row-fluid">
                <div id="exam-list" class="span6">
                    <!-- 选择考试项目 -->
                    <label>选择考试项目：</label>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th></th>
                                <th>考试名称</th>
                                <th>考试类型</th>
                                <th>考试开始时间</th>
                            </tr>
                        </thead>
                        <tbody id="exam-list-content">

                        </tbody>
                    </table>
                </div>
                <div id="room-list" class="span6">
                    <!-- 选择考场 -->
                    <label>选择考场：</label>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th></th>
                                <th>教学楼名称</th>
                                <th>教室编号</th>
                                <th>可容纳人数</th>
                            </tr>
                        </thead>
                        <tbody id="room-list-content">

                        </tbody>
                    </table>
                </div>
            </div>
            <button id="allot-button" class="btn btn-primary"> &nbsp&nbsp&nbsp分配考场&nbsp&nbsp&nbsp </button>
        </fieldset>
    </div>
</div>
{/block}
{block name=footeraddtion}
    <script src="/js/allot.js"></script>
{/block}
