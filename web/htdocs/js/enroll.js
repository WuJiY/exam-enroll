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
}
