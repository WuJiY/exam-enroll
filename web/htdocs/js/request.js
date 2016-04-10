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
            $('input').removeAttr('disabled');
            if(state == 'success'){
                if(data.status == 201){
                    window.location = data.data.url + '?token=' + data.data.token;
                }else{
                    layer.msg(data.status + " : " + data.data);

                }
            }
        });
    });

    $('#change_password_btn').click(function(){
        if($('#change-password').valid()){
            var old = $('#old_password').val();
            var new_password = $('#new_password').val();
            $('input').attr('disabled', 'disabled');
            var index = layer.load(1, {
              shade: [0.1,'#fff'] //0.1透明度的白色背景
            });
            $.post("/api.php/user/change_password", {
                old_password : old,
                new_password : new_password
            }, function(data, state){
                layer.close(index);
                $('input').removeAttr('disabled');
                console.log(data);
                if(state == 'success'){
                    if(data.status == 201){
                        layer.alert(data.data);
                    }else{
                        layer.msg(data.status + " : " + data.data);
                    }
                }
            });
        }
    });


}
