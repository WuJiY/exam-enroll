window.onload = function(){
    $('.btn-show').click(function(){
        var uid = $(this).attr('data-user-id');
        var index = layer.load(0, {shade: false});
        $.post("/api.php/student/info",{
            id : uid
        }, function(data, status){
            layer.close(index);
            if(status == 'success'){
                if(data.status == 200){
                    console.log(data);
                    layer.open({
                        type: 1,
                        skin: 'layui-layer-lan', //加上边框
                        area: ['420px', '240px'], //宽高
                        content: '<table class="table table-bordered"><tr><td>学号</td><td>'
                        + data.data['student_number'] + '</td></tr><tr><td>姓名</td><td>'
                        + data.data['name'] + '</td></tr><tr><td>性别</td><td>'
                        + (data.data['sex'] == 0 ? '男' : (data.data['sex'] == 1 ? '女' : '未知')) + '</td></tr><tr><td>民族</td><td>'
                        + data.data['nation'] + '</td></tr><tr><td>身份证号</td><td>'
                        + data.data['id_card_number'] + '</td></tr><tr><td>电话号码</td><td>'
                        + data.data['telephone_number'] + '</td></tr><tr><td>学院</td><td>'
                        + data.data['college'] + '</td></tr><tr><td>年级</td><td>'
                        + data.data['grade'] + '</td></tr><tr><td>专业</td><td>'
                        + data.data['major'] + '</td></tr><tr><td>班级</td><td>'
                        + data.data['class'] + '</td></tr></table>'
                    });
                }else{
                    layer.msg(data.status + ':' + data.data);
                }
            }else{
                layer.msg('网络错误，请求失败！' + status);
            }
        });
    });

    $('.btn-delete').click(function(){
        var uid = $(this).attr('data-user-id');
        var m = $(this).parent().parent();
        layer.confirm('您确定要删除该数据吗？', {
            btn: ['马上删除','算了'] //按钮
        }, function(){
            var index = layer.load(0, {shade: false});
            $.post('/api.php/student/delete',{
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
        var uid = $(this).attr('data-user-id');
        window.location = '/index.php/student/edit/student_info/' + uid;
    });
}
