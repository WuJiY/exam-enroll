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
        <h3>导入学生信息</h3>
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
                                            <li>A -> ID 此项内容务必保留，但在本操作中将不会被使用到。</li>
                                            <li>B -> 学号</li>
                                            <li>C -> 姓名</li>
                                            <li>D -> 性别</li>
                                            <li>E -> 民族</li>
                                            <li>F -> 身份证号</li>
                                            <li>G -> 电话号码</li>
                                            <li>H -> 学院</li>
                                            <li>I -> 年级</li>
                                            <li>J -> 专业</li>
                                            <li>K -> 班级</li>
                                        </ul>
                                    </li>
                                    <li>请将数据存放在worksheet1中，系统默认只读取第一个worksheet。</li>
                                </ol>
                            </li>
                            <li>
                                如果您的数据不符合上述规定，请点击<a>此处</a>下载模版文件。
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
                        <input id="fileupload" type="file" name="student_account_file">
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
<script src="/js/fileupload.js"></script>
</body>
{/block}