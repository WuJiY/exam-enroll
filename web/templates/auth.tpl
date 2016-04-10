{* Smarty *}
{extends file='layouts/base.tpl'}
{block name=head}
<!-- Bootstrap -->
<link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
<link href="/assets/styles.css" rel="stylesheet" media="screen">
 <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script src="/vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
{/block}
{block name=body}
<body id="login">
   <div style="height:150px;width:100%;background-color:#0051CC;text-align:center"></div>

  <div class="container" style="margin-top:50px" >

    <form class="form-signin" id="auth">
      <h2 class="form-signin-heading">用户登录</h2>
      <input type="text" class="input-block-level" name="username" placeholder="请在此输入您的用户名">
      <input type="password" class="input-block-level" name="password" placeholder="请在此输入您的密码">
      <label class="checkbox">
        <input type="checkbox" id="rememberme" name="rememberme" value="remember-me">记住我
      </label>
      <button id="auth-btn" class="btn btn-large btn-primary" type="button">登陆</button>
    </form>

  </div> <!-- /container -->
  <script src="/vendors/jquery-1.9.1.min.js"></script>
  <script src="/vendors/layer2/layer.js"></script>
  <script src="/vendors/carhartl-jquery-cookie/jquery.cookie.js"></script>
  <script src="/bootstrap/js/bootstrap.min.js"></script>
  <script src="/js/request.js"></script>
</body>
{/block}
