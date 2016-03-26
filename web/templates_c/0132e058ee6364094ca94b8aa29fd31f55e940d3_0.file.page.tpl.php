<?php
/* Smarty version 3.1.29, created on 2016-03-20 15:36:43
  from "/home/parallel/Workstation/PHPLab/test_route/web/templates/layouts/page.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_56ee530b5811c9_18416219',
  'file_dependency' => 
  array (
    '0132e058ee6364094ca94b8aa29fd31f55e940d3' => 
    array (
      0 => '/home/parallel/Workstation/PHPLab/test_route/web/templates/layouts/page.tpl',
      1 => 1458459400,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./base.tpl' => 1,
  ),
),false)) {
function content_56ee530b5811c9_18416219 ($_smarty_tpl) {
$_smarty_tpl->ext->_inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->ext->_inheritance->processBlock($_smarty_tpl, 0, 'head', array (
  0 => 'block_76539457656ee530b57c9f9_34383396',
  1 => false,
  3 => 0,
  2 => 0,
));
?>

<?php $_smarty_tpl->ext->_inheritance->endChild($_smarty_tpl);
$_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:./base.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'head'}  file:layouts/page.tpl */
function block_76539457656ee530b57c9f9_34383396($_smarty_tpl, $_blockParentStack) {
?>

    <link href="/css/page.css" rel="stylesheet" type="text/css">
<?php
}
/* {/block 'head'} */
}
