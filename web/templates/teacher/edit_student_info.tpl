{* Smarty *}
{extends file='../layouts/teacher.tpl'}
{block name=nav}
    {include 'components/teacher/nav_student.tpl'}
{/block}
{block name=headaddtion}
<link href="/css/jquery.fileupload.css" rel="stylesheet">
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

                     <div class="control-group">
                         <label class="control-label" for="student_number">学号</label>
                         <div class="controls">
                             <input class="input-xlarge focused" id="student_number" name="student_number" type="text" value="{$data['student_number']}">
                         </div>
                     </div>
                     <div class="control-group">
                         <label class="control-label" for="name">姓名</label>
                         <div class="controls">
                             <input class="input-xlarge focused" id="name" name="name" type="text" value="{$data['name']}">
                         </div>
                     </div>
                     <div class="control-group">
                         <label class="control-label" for="college">学院</label>
                         <div class="controls">
                             <input class="input-xlarge focused" id="college" name="college" type="text" value="{$data['college']}">
                         </div>
                     </div>
                     <div class="control-group">
                         <label class="control-label" for="major">专业</label>
                         <div class="controls">
                             <input class="input-xlarge focused" id="major" name="major" type="text" value="{$data['major']}">
                         </div>
                     </div>
                     <div class="control-group">
                         <label class="control-label" for="grade">年级</label>
                         <div class="controls">
                             <input class="input-xlarge focused" id="grade" name="grade" type="text" value="{$data['grade']}">
                         </div>
                     </div>
                     <div class="control-group">
                         <label class="control-label" for="class">班级</label>
                         <div class="controls">
                             <input class="input-xlarge focused" id="class" name="class" type="text" value="{$data['class']}">
                         </div>
                     </div>
                     <div class="control-group">
                         <label class="control-label" for="sex">性别</label>
                         <div class="controls">
                             <select name="sex" id="sex">
                                 <option value="0" {if $data['sex'] eq 0}selected{/if}>男</option>
                                 <option value="1" {if $data['sex'] eq 1}selected{/if}>女</option>
                                 <option value="2" {if $data['sex'] eq 2}selected{/if}>未知</option>
                             </select>
                         </div>
                     </div>
                     <div class="control-group">
                         <label class="control-label" for="nationid_card_number">民族</label>
                         <div class="controls">
                             <input class="input-xlarge focused" id="nation" name="nation" type="text" value="{$data['nation']}">
                         </div>
                     </div>
                     <div class="control-group">
                         <label class="control-label" for="id_card_number">身份证号码</label>
                         <div class="controls">
                             <input class="input-xlarge focused" id="id_card_number" name="id_card_number" type="text" value="{$data['id_card_number']}">
                         </div>
                     </div>
                     <div class="control-group">
                         <label class="control-label" for="telephone_number">电话号码</label>
                         <div class="controls">
                             <input class="input-xlarge focused" id="telephone_number" name="telephone_number" type="text" value="{$data['telephone_number']}">
                         </div>
                     </div>

                     <div class="form-actions" >
                         <button class="btn btn-primary"> &nbsp&nbsp&nbsp保存&nbsp&nbsp&nbsp </button>
                         <button class="btn"> &nbsp&nbsp&nbsp返回&nbsp&nbsp&nbsp </button>
                     </div>

                </fieldset>
            </form>

        </div>
    </div>
</div>
{/block}
{block name=footeraddtion}
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
<script src="/js/fileupload/upload_photo.js"></script>
{/block}
