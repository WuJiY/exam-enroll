{* Smarty *}
<div class="dataTables_paginate paging_bootstrap pagination">
    <ul>
        <li class="{if $current_page eq 1}active{/if}">
            <a href="?page=1">首页</a>
        </li>
        <li class="prev {if $current_page eq 1}disabled{/if}">
            <a href="?page={$current_page-1}">← 上一页</a>
        </li>
        {foreach $pages as $page}
            <li class="{if $current_page eq $page}active{/if}">
                <a href="?page={$page}">{$page}</a>
            </li>
        {/foreach}
        <li class="next {if $current_page eq $max_page_num}disabled{/if}">
            <a href="?page={$current_page+1}">下一页 → </a>
        </li>
        <li class="{if $current_page eq $max_page_num}active{/if}">
            <a href="?page={$max_page_num}">尾页</a>
        </li>
    </ul>
</div>
