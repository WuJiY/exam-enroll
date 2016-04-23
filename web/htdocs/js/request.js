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

    $('#exam-add-btn').click(function(){
        if($('#exam-add').valid()){
            var name = $('#name').val();
            var type = $('#type').val();
            var exam_time = $('#datetimepicker').val();
            var title = $('#title').val();
            $('input').attr('disabled', 'disabled');
            var index = layer.load(1, {
                shade: [0.1,'#fff'] //0.1透明度的白色背景
            });
            $.post("/api.php/exam/add", {
                name : name,
                type : type,
                exam_time : exam_time,
                title : title
            }, function(data, status){
                layer.close(index);
                $('input').removeAttr('disabled');
                if(status == 'success'){
                    if(data.status == 201){
                        layer.alert(data.data.desc, {}, function(){
                            window.location.href=data.data.uri;
                        });
                    }else{
                        layer.msg(data.status + " : " + data.data);
                    }
                }
            });
        }
    });

    $('#exam-edit-btn').click(function(){
        if($('#exam-edit').valid()){
            var id = $(this).attr('data-exam-id');
            var name = $('#name').val();
            var type = $('#type').val();
            var exam_time = $('#datetimepicker').val();
            var title = $('#title').val();
            $('input').attr('disabled', 'disabled');
            var index = layer.load(1, {
                shade: [0.1,'#fff'] //0.1透明度的白色背景
            });
            $.post("/api.php/exam/edit", {
                id : id,
                name : name,
                type : type,
                exam_time : exam_time,
                title : title
            }, function(data, status){
                layer.close(index);
                $('input').removeAttr('disabled');
                if(status == 'success'){
                    if(data.status == 201){
                        layer.alert(data.data.desc, {}, function(){
                            window.location.href=data.data.uri;
                        });
                    }else{
                        layer.msg(data.status + " : " + data.data);
                    }
                }
            });
        }
    });

    $('#building-add-btn').click(function(){
        if($('#building-add').valid()){
            var name = $('#name').val();
            var code = $('#code').val();
            var title = $('#title').val();
            $('input').attr('disabled', 'disabled');
            var index = layer.load(1, {
                shade : [0.1, '#fff']
            });
            $.post("/api.php/building/add", {
                name : name,
                code : code,
                title : title
            }, function(data, status){
                layer.close(index);
                $('input').removeAttr('disabled');
                if(status == 'success'){
                    if(data.status == 201){
                        layer.alert(data.data.desc, {}, function(){
                            window.location.href=data.data.uri;
                        });
                    }else{
                        layer.msg(data.status + " : " + data.data);
                    }
                }
            });
        }
    });

    $('#building-edit-btn').click(function(){
        if($('#building-edit').valid()){
            var name = $('#name').val();
            var code = $('#code').val();
            var title = $('#title').val();
            var id = $(this).attr('data-building-id');
            $('input').attr('disabled', 'disabled');
            var index = layer.load(1, {
                shade : [0.1, '#fff']
            });
            $.post("/api.php/building/edit", {
                name : name,
                code : code,
                title : title,
                id : id
            }, function(data, status){
                console.log(data);
                layer.close(index);
                $('input').removeAttr('disabled');
                if(status == 'success'){
                    if(data.status == 201){
                        layer.alert(data.data.desc, {}, function(){
                            window.location.href=data.data.uri;
                        });
                    }else{
                        layer.msg(data.status + " : " + data.data);
                    }
                }
            });
        }
    });
}
