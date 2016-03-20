{* Smarty *}
{include file='layouts/page.tpl'}
{block name=title}导入学生账号信息{/block}
{block name=body}
    <form action="/index.php/import/student_account" method="post" enctype="multipart/form-data">
        <label>excel文件：</label>
        <input type="file" name="student_account_file">
        <button type="submit">提交</button>
    </form>
{/block}
