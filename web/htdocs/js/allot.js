/**
 * Created by swumao on 2016/6/5.
 */
$(document).ready(function () {
    // 获取所有的考试项目
    $.post('/api.php/exam/all', {

    }, function (data, status) {
        if(status == 'success'){
            if(data.status == 200){
                var datas = data.data.data;
                for(var i in datas){
                    var e = datas[i];
                    $('#exam-list-content').append('<tr><td><input data-id="' + e.id +
                        '" type="checkbox"></td>' +
                        '<td>' + e.name + '</td>' +
                        '<td>' + e.type + '</td>' +
                        '<td>' + e.exam_time + '</td></tr>');
                }
            }else{
                layer.msg(data.status + data.data);
            }
        }else{
            layer.msg('网络错误');
        }
    });

    // 获取所有的考场信息
    $.post('/api.php/room/all', {

    }, function (data, status) {
        if(status == 'success'){
            if(data.status == 200){
                var datas = data.data.data;
                for(var i in datas){
                    var e = datas[i];
                    $('#room-list-content').append('<tr><td><input data-id="' + e.id +
                        '" type="checkbox"></td>' +
                        '<td>' + e.title + '</td>' +
                        '<td>' + e.code + '</td>' +
                        '<td>' + e.volume + '</td></tr>');
                }
            }else{
                layer.msg(data.status + data.data);
            }
        }else{
            layer.msg('网络错误');
        }
    });

    $('#allot-button').click(function(){
        var exams = [], rooms = [];
        $('#exam-list-content input[type=checkbox]').each(function(e) {
            if($(this).is(':checked')){
                exams.push($(this).attr('data-id'));
            }
        });

        $('#room-list-content input[type=checkbox]').each(function(e){
            if($(this).is(':checked')){
                rooms.push($(this).attr('data-id'));
            }
        });
        var index = layer.load(0, {shade: false});
        $.post("/api.php/exam/allot", {
            exams : exams,
            rooms : rooms
        }, function(data, status){
            layer.close(index);
            if(status == 'success'){
                if(data.status == 201){
                    // 分配成功
                    layer.confirm('分配考场成功，是否前往查看？', {
                        btn: ['好，这就去','稍后我自己去查看'] //按钮
                    }, function(){
                        window.location = '/index.php/allot_info';
                    }, function(){
                        layer.msg('祝您使用愉快！');
                    });
                }else{
                    layer.msg(data.status + data.data);
                }
            }else{
                layer.msg('网络错误，请稍后重试');
            }
        });
    });

});
