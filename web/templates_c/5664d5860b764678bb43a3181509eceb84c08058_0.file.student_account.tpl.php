<?php
/* Smarty version 3.1.29, created on 2016-03-20 15:54:33
  from "/home/parallel/Workstation/PHPLab/test_route/web/templates/student_account.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_56ee5739212026_42318874',
  'file_dependency' => 
  array (
    '5664d5860b764678bb43a3181509eceb84c08058' => 
    array (
      0 => '/home/parallel/Workstation/PHPLab/test_route/web/templates/student_account.tpl',
      1 => 1458460469,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:layouts/page.tpl' => 1,
  ),
),false)) {
function content_56ee5739212026_42318874 ($_smarty_tpl) {
$_smarty_tpl->ext->_inheritance->init($_smarty_tpl, false);
?>

<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:layouts/page.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php 
$_smarty_tpl->ext->_inheritance->processBlock($_smarty_tpl, 0, 'title', array (
  0 => 'block_208644158956ee573920c053_12135797',
  1 => false,
  3 => 0,
  2 => 0,
));
?>

<?php 
$_smarty_tpl->ext->_inheritance->processBlock($_smarty_tpl, 0, 'body', array (
  0 => 'block_138828981556ee573920ff68_77229039',
  1 => false,
  3 => 0,
  2 => 0,
));
?>

<?php }
/* {block 'title'}  file:student_account.tpl */
function block_208644158956ee573920c053_12135797($_smarty_tpl, $_blockParentStack) {
?>
导入学生账号信息<?php
}
/* {/block 'title'} */
/* {block 'body'}  file:student_account.tpl */
function block_138828981556ee573920ff68_77229039($_smarty_tpl, $_blockParentStack) {
?>

    <form action="/index.php/import/student_account" method="post" enctype="multipart/form-data">
        <label>excel文件：</label>
        <input type="file" name="student_account_file">
        <button type="submit">提交</button>
    </form>
<?php
}
/* {/block 'body'} */
}
