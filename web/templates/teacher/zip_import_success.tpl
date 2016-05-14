{* Smarty *}
{extends file='../layouts/teacher.tpl'}
{block name=nav}
    {include 'components/teacher/nav_student.tpl'}
{/block}
{block name='main'}
<div class="block">
    <div class="navbar navbar-inner block-header">
    </div>
    <div class="block-content collapse in">
        <div class="span12">
             {foreach $result as $file=>$item}
             	<p>{$file}:{$item}</p>
             {/foreach}
        </div>
    </div>
</div>
{/block}
