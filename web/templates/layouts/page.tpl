{extends file='./base.tpl'}
{block name=head}
<!-- Bootstrap -->
<link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
<link href="/vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen">
<link href="/assets/styles.css" rel="stylesheet" media="screen">
<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script src="/vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
{/block}
{block name=body}
<body>
    {block name=header}
        {block name=navbar}
            {include '../components/navbar.tpl'}
        {/block}
    {/block}
    {block name=content}
    <div class="container-fluid">
        <div class="row-fluid">
            {block name=nav}
                {include '../components/nav.tpl'}
            {/block}
            <div class="span9" id="content">
                <div class="row-fluid">
                    {block name=notify}
                        {include '../components/notify.tpl'}
                    {/block}
                    {block name=breadcrumb}
                        {include '../components/breadcrumb.tpl'}
                    {/block}
                </div>
                {block name=main}

                {/block}
            </div>
        </div>
        {block name=copyright}
            {include '../components/copyright.tpl'}
        {/block}
    {/block}
</div>
{block name=footer}
<!--/.fluid-container-->
<script src="vendors/jquery-1.9.1.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="vendors/easypiechart/jquery.easy-pie-chart.js"></script>
<script src="assets/scripts.js"></script>
</body>
{/block}
</body>
{/block}
