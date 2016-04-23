window.onload = function(){
    $(".enroll").bootstrapSwitch();

    $(".enroll").on('switchChange.bootstrapSwitch', function(event, state){
        var enroll = state == true ? 1 : 0;
        var exam_id = $(this).attr('data-exam-id');
        var myswitch = $(this);
        $(this).bootstrapSwitch('toggleDisabled', true);
        $.post('/api.php/enroll', {
            exam_id : exam_id,
            status : enroll
        }, function(data, status){
            myswitch.bootstrapSwitch('toggleDisabled', false);
            if(status == 'success'){
                if(data.status == 201){
                    layer.msg(data.data, {
                        time: 2000, //2s后自动关闭
                        btn: ['知道了']
                    });
                }else{
                    layer.msg(data.status + ':' + data.data);
                    return ;
                }
            }else{
                layer.msg('网络错误，请求失败！' + status);
                return ;
            }
        });
    });

    $('.btn-cancle-enroll').click(function(){
        var enroll_id = $(this).attr('data-enroll-id');
        var ele = $(this).parent().parent();
        var btn = $(this);
        $(this).attr('disabled', 'disabled');
        layer.confirm('您确定要取消改报名吗？', {
            btn: ['马上取消','算了'] //按钮
        }, function(){
            var index = layer.load(0, {shade: false});
            $.post('/api.php/enroll/cancle', {
                id : enroll_id
            }, function(data, status){
                btn.removeAttr('disabled');
                layer.close(index);
                if(status == 'success'){
                    if(data.status == 201){
                        ele.remove();
                        layer.msg(data.data, {
                            time: 2000, //2s后自动关闭
                            btn: ['知道了']
                        });
                    }else{
                        layer.msg(data.status + ':' + data.data);
                    }
                }else{
                    layer.msg('网络错误，请求失败！' + status);
                    return ;
                }
            });
        }, function(){
            btn.removeAttr('disabled');
            return ;
        });
    });
}
