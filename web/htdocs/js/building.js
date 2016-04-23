window.onload = function(){
    $('.btn-delete').click(function(){
        var id = $(this).attr('data-building-id');
        var m = $(this).parent().parent();
        layer.confirm('您确定要删除该数据吗？', {
            btn: ['马上删除','算了'] //按钮
        }, function(){
            var index = layer.load(0, {shade: false});
            $.post('/api.php/building/delete',{
                id : id
            },function(data, status){
                layer.close(index);
                console.log(data);
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
        var id = $(this).attr('data-building-id');
        window.location = '/index.php/building/edit/' + id;
    });
};
