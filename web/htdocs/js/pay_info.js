/**
 * Created by swumao on 2016/5/28.
 */
window.onload = function () {
    $(".paystatus").bootstrapSwitch();

    $(".paystatus").on('switchChange.bootstrapSwitch', function(event, state){
        var pay_status = state == true ? 1 : 0;
        var id = $(this).attr('data-enroll-id');
        var myswitch = $(this);
        $(this).bootstrapSwitch('toggleDisabled', true);
        $.post('/api.php/enroll/pay_status', {
            id : id,
            pay_status : pay_status
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
