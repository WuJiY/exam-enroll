{* Smarty *}
<div class="span3" id="sidebar">
    <ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
        <li class="{if $left_nav_active eq 'student_account'}active{/if}">
            <a href="/index.php/import/student_account"><i class="icon-chevron-right"></i>导入学生信息</a>
        </li>
        <li  class="{if $left_nav_active eq 'student_info'}active{/if}">
           <a href="/index.php/student_info"><i class="icon-chevron-right"></i>查看学生信息</a>
        </li>
        <li class="{if $left_nav_active eq 'pay_info_import'}active{/if}">
           <a href="/index.php/import/pay_info"><i class="icon-chevron-right"></i>导入缴费情况</a>
        </li>
        <li class="{if $left_nav_active eq 'pay_info'}active{/if}">
          <a href="/index.php/pay_info"><i class="icon-chevron-right"></i>查看缴费情况</a>
        </li>
        <li class="{if $left_nav_active eq 'photos_import'}active{/if}">
           <a href="/index.php/import/photos"><i class="icon-chevron-right"></i>导入照片</a>
        </li>
        <li class="{if $left_nav_active eq 'photos'}active{/if}">
           <a href="/index.php/photos"><i class="icon-chevron-right"></i>导出照片</a>
        </li>
        <li class="{if $left_nav_active eq 'score_import'}active{/if}">
            <a href="/index.php/import/score"><i class="icon-chevron-right"></i>导入成绩</a>
        </li>
        <li class="{if $left_nav_active eq 'score'}active{/if}">
          <a href="/index.php/score"><i class="icon-chevron-right"></i>查看成绩</a>
        </li>

    </ul>
</div>
