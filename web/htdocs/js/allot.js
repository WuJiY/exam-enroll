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
                    $('#exam-list-content').append('<tr><td><input type="checkbox"></td>' +
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
                    $('#room-list-content').append('<tr><td><input type="checkbox"></td>' +
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
        
    });

});
