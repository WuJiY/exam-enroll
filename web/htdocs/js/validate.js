if(typeof jQuery == 'undefined'){
    console.error('jQuery is not loadin');
    setTimeOut(validate(), 2000);  // 延时2秒执行
}else{
    validate();
}

function validate(){
    $('#change-password').validate({
        rules : {
            old_password : "required",
            new_password: {
                required : true
            },
            re_passowrd : {
                required : true,
                equalTo : "#new_password"
            }
        },
        messages : {
            old_password : "必须输入旧密码",
            new_password : {
                required : "必须输入新密码"
            },
            re_passowrd : {
                required : "必须输入确认密码",
                equalTo : "确认密码必须与新密码保持一致"
            }
        }
    });

    $('#exam-add').validate({
        rules : {
            name : "required",
            type : "required",
            exam_time : "required",
            title : "required"
        },
        messages : {
            name : "必须为这个考试提供一个名称",
            type : "必须选择一个考试的类型",
            exam_time : "必须选择考试开始的时间",
            title : "必须填写考试说明"
        }
    });

    $('#exam-edit').validate({
        rules : {
            name : "required",
            type : "required",
            exam_time : "required",
            title : "required"
        },
        messages : {
            name : "必须为这个考试提供一个名称",
            type : "必须选择一个考试的类型",
            exam_time : "必须选择考试开始的时间",
            title : "必须填写考试说明"
        }
    });
}
