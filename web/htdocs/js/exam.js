window.onload = function(){
    $('#datetimepicker').datetimepicker();
    $(".enroll").bootstrapSwitch();
    $(".score").bootstrapSwitch();

    $('.btn-show').click(function(){
        var id = $(this).attr('data-exam-id');
        var index = layer.load(0, {shade: false});
        $.post("/api.php/exam/info",{
            id : id
        }, function(data, status){
            layer.close(index);
            if(status == 'success'){
                if(data.status == 200){
                    console.log(data);
                    layer.open({
                        type: 1,
                        skin: 'layui-layer-lan', //加上边框
                        area: ['420px', '240px'], //宽高
                        content: '<table class="table table-bordered"><tr><td>名称</td><td>'
                        + data.data['name'] + '</td></tr><tr><td>类型</td><td>'
                        + data.data['type_name'] + '</td></tr><tr><td>考试说明</td><td>'
                        + data.data['title'] + '</td></tr><tr><td>考试时间</td><td>'
                        + data.data['exam_time'] + '</td></tr><tr><td>创建时间</td><td>'
                        + data.data['create_time'] + '</td></tr><tr><td>最后更新时间</td><td>'
                        + data.data['update_time'] + '</td></tr></table>'
                    });
                }else{
                    console.log(data);
                    layer.msg(data.status + ':' + data.data);
                }
            }else{
                layer.msg('网络错误，请求失败！' + status);
            }
        });
    });


    $('.btn-delete').click(function(){
        var uid = $(this).attr('data-exam-id');
        var m = $(this).parent().parent();
        layer.confirm('您确定要删除该数据吗？', {
            btn: ['马上删除','算了'] //按钮
        }, function(){
            var index = layer.load(0, {shade: false});
            $.post('/api.php/exam/delete',{
                id : uid
            },function(data, status){
                layer.close(index);
                if(status == 'success'){
                    if(data.status == 204){
                        m.remove();
                        layer.msg(data.data, {
                            time: 2000, //20s后自动关闭
                            btn: ['知道了']
                        });
                    }else{
                        layer.msg(data.status + ':' + data.data);
                    }
                }else{
                    layer.msg('网络错误，请求失败！' + status);
                }
            });
        }, function(){
            return ;
        });
    });

    $('.btn-edit').click(function(){
        var id = $(this).attr('data-exam-id');
        window.location = '/index.php/exam/edit/' + id;
    });

    $(".enroll").on('switchChange.bootstrapSwitch', function(event, state){
        var enroll = state == true ? 1 : 0;
        var id = $(this).attr('data-exam-id');
        var myswitch = $(this);
        $(this).bootstrapSwitch('toggleDisabled', true);
        $.post('/api.php/exam/enroll/state', {
            id : id,
            enroll : enroll
        }, function(data, status){
            myswitch.bootstrapSwitch('toggleDisabled', false);
            if(status == 'success'){
                if(data.status == 201){
                    layer.msg(data.data.desc, {
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

    $(".score").on('switchChange.bootstrapSwitch', function(event, state){
        var enroll = state == true ? 1 : 0;
        var id = $(this).attr('data-exam-id');
        var myswitch = $(this);
        $(this).bootstrapSwitch('toggleDisabled', true);
        $.post('/api.php/exam/score/state', {
            id : id,
            enroll : enroll
        }, function(data, status){
            myswitch.bootstrapSwitch('toggleDisabled', false);
            if(status == 'success'){
                if(data.status == 201){
                    layer.msg(data.data.desc, {
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
