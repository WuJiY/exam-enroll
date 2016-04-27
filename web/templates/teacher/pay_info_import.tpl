{* Smarty *}
{extends file='../layouts/teacher.tpl'}
{block name=head}
<!-- Bootstrap -->
<link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
<link href="/vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen">
<link href="/assets/styles.css" rel="stylesheet" media="screen">
<link href="/css/validation.css" rel="stylesheet">
<link href="/css/jquery.fileupload.css" rel="stylesheet">
<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script src="/vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
{/block}
{block name=nav}
    {include '../components/teacher/nav_student.tpl'}
{/block}
{block name='main'}
<div class="block">
    <div class="navbar navbar-inner block-header">
        <h3>导入缴费信息</h3>
    </div>
    <div class="block-content collapse in">
        <div class="span12">
            <fieldset>
                <div class="alert alert-info alert-block">
                    <a class="close" data-dismiss="alert" href="#">&times;</a>
                    <h4 class="alert-heading">选择文件上传之前请仔细阅读！</h4>
                    <p>
                        <ul>
                            <li>在选择文件进行上传时，请选择后缀名为.xls或者.xlsx[推荐]格式的文件。</li>
                            <li>
                                文件内容需要符合以下规则：
                                <ol>
                                    <li>表格第一行为表头行，此行数据将不会被读取。</li>
                                    <li>数据区域为表格二行到数据结束，请手动删除掉表格其他区域的统计信息等数据。</li>
                                    <li>
                                        表格每一列均有严格定义，规则如下：
                                        <ul>
                                            <li>A -> ID 此项内容务必保留，此项为学生报名后分配的唯一标识。</li>
                                            <li>B -> 学号 必须保证此项内容不为空且唯一，如果出现重复值，后面的内容将覆盖前面的内容</li>
                                            <li>C -> 姓名</li>
                                            <li>D -> 性别 请填写 男 或者 女</li>
                                            <li>E -> 民族</li>
                                            <li>F -> 身份证号 默认情况下将会以此项内容作为密码，如果此项内容设置为空，则密码为12345678</li>
                                            <li>G -> 手机号码 必须是11位数字，如果没有可以留空</li>
                                            <li>H -> 学院</li>
                                            <li>I -> 年级</li>
                                            <li>J -> 专业</li>
                                            <li>K -> 班级</li>
                                            <li>L -> 粉笔字缴费情况 已缴费请填写 是 未缴费请留空或填写 否 </li>
                                            <li>M -> 钢笔字缴费情况 已缴费请填写 是 未缴费请留空或填写 否 </li>
                                            <li>N -> 毛笔字缴费情况 已缴费请填写 是 未缴费请留空或填写 否 </li>
                                        </ul>
                                    </li>
                                    <li>请将数据存放在worksheet1中，系统默认只读取第一个worksheet。</li>
                                    <li>
                                        如果您的表格中有通过函数计算得到的结果，需要您手动将之转换为值，方法如下：
                                        <ol>
                                            <li>选中所有需要转换的单元格</li>
                                            <li>点击鼠标右键，复制这些单元格</li>
                                            <li>在原处点击鼠标右键，点击“选择性粘贴”</li>
                                            <li>在弹出的窗口中选择“值”，点击确定按钮</li>
                                        </ol>
                                    </li>
                                </ol>
                            </li>
                            <li>
                                为了尽量避免操作麻烦，请前往<a>这里</a>选择考试并下载对应的数据文件。
                            </li>
                        </ul>
                    </p>
                </div>

                <div class="control-group">
                    <!-- The fileinput-button span is used to style the file input field as button -->
                    <span class="btn btn-success fileinput-button">
                        <i class="glyphicon glyphicon-plus"></i>
                        <span>选择文件</span>
                        <!-- The file input field used as target for the file upload widget -->
                        <input id="fileupload" type="file" name="student_payinfo_file">
                    </span>
                    <br>
                    <br>
                    <!-- The global progress bar -->
                    <div id="progress" class="progress">
                        <div class="progress-bar progress-bar-success"></div>
                    </div>
                    <!-- The container for the uploaded files -->
                    <div id="files" class="files"></div>
                </div>
            </fieldset>
            <hr />
            <div id="results"></div>

        </div>
    </div>
</div>
{/block}
{block name=footer}
<!--/.fluid-container-->
<script src="/vendors/jquery-1.9.1.min.js"></script>
<script src="/bootstrap/js/bootstrap.min.js"></script>
<script src="/vendors/layer2/layer.js"></script>
<script src="/vendors/easypiechart/jquery.easy-pie-chart.js"></script>
<script src="/vendors/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="/vendors/jquery-validation/localization/messages_zh.js"></script>
<script src="/vendors/jQuery-File-Upload-9.12.3/js/vendor/jquery.ui.widget.js"></script>
<script src="/js/load-image.all.min.js"></script>
<script src="/js/canvas-to-blob.min.js"></script>
<script src="/vendors/jQuery-File-Upload-9.12.3/js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="/vendors/jQuery-File-Upload-9.12.3/js/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="/vendors/jQuery-File-Upload-9.12.3/js/jquery.fileupload-process.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="/vendors/jQuery-File-Upload-9.12.3/js/jquery.fileupload-image.js"></script>
<!-- The File Upload audio preview plugin -->
<script src="/vendors/jQuery-File-Upload-9.12.3/js/jquery.fileupload-audio.js"></script>
<!-- The File Upload video preview plugin -->
<script src="/vendors/jQuery-File-Upload-9.12.3/js/jquery.fileupload-video.js"></script>
<!-- The File Upload validation plugin -->
<script src="/vendors/jQuery-File-Upload-9.12.3/js/jquery.fileupload-validate.js"></script>
<script src="/assets/scripts.js"></script>
<script src="/js/validate.js"></script>
<script src="/js/request.js"></script>
<script src="/js/fileupload/import_student_payinfo.js"></script>
</body>
{/block}
