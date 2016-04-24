window.onload = function(){
    $('#datetimepicker').datetimepicker();
    $(".select").bootstrapSwitch();

    $('#btn-export').click(function(){
        var filter = [];
        $('.select').each(function(index, element){
            if($(this).bootstrapSwitch('state')){
                filter.push($(this).attr('data-exam-id'));
            }
        });
        if(filter.length == 0){
            layer.msg('请先选择你需要导出的考试信息！');
            return;
        }
        $('input').attr('disabled','disabled');
        $.post('/api.php/export', {
            exams : filter
        }, function(data, status){
            console.log(data);
            $('input').removeAttr('disabled');
            if(status == 'success'){
                if(data.status == 200){
                    layer.confirm(data.data.desc + ' 是否立即下载', {
                        btn: ['下载','算了'] //按钮
                    }, function(){
                        window.location.href = data.data.uri;
                    }, function(){
                        return;
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
