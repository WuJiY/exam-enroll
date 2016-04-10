if(typeof jQuery == 'undefined'){
    console.error('jQuery is not loadin');
    setTimeOut(request(), 2000);  // 延时2秒执行
}else{
    request();
}

function request(){
    $('#auth-btn').click(function(){
        var username = $('input[name=username]').val();
        var password = $('input[name=password]').val();
        var rememberme = $('input[name=rememberme]:checked').val();
        console.info('rememberme is ' + rememberme);
        if(rememberme == 'remember-me'){
            $.cookie('rememberme', true, {expires: 7});
            $.cookie('username', username, {expires : 7});
            $.cookie('password', password, {expires : 7});
        }else{
            $.cookie('rememberme', false, {expires: -1});
            $.cookie('username', "", {expires : -1});
            $.cookie('password', "", {expires : -1});
        }
        $('input').attr('disabled', 'disabled');
        $.post("/api.php/auth", {
            username : username,
            password : password
        }, function(data, state){
            if(state == 'success'){
                if(data.status == 201){
                    window.location = data.data.url + '?token=' + data.data.token;
                }else{
                    alert(data.status + " : " + data.data);
                    $('input').removeAttr('disabled');
                }
            }
        });
    });


}
