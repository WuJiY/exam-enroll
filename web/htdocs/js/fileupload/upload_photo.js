/*jslint unparam: true, regexp: true */
/*global window, $ */
$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    // var url = window.location.hostname === 'mao.com' ?
    //             '//jquery-file-upload.appspot.com/' : 'server/php/',
    var url = '/api.php/import/student_account',
        uploadButton = $('<button/>')
            .addClass('btn btn-primary')
            .prop('disabled', true)
            .text('上传中...')
            .on('click', function () {
                var $this = $(this),
                    data = $this.data();
                $this
                    .off('click')
                    .text('中止上传')
                    .on('click', function () {
                        $this.remove();
                        data.abort();
                    });
                data.submit().always(function () {
                    $this.remove();
                });
            });
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        autoUpload: false,
        acceptFileTypes: /(\.|\/)(jpg|png|jpeg)$/i,
        maxFileSize: 999000,
        // Enable image resizing, except for Android and Opera,
        // which actually support image resizing, but fail to
        // send Blob objects via XHR requests:
        // disableImageResize: /Android(?!.*Chrome)|Opera/
        //      .test(window.navigator.userAgent),
        // previewMaxWidth: 100,
        // previewMaxHeight: 100,
        // previewCrop: true
    }).on('fileuploadadd', function (e, data) {
        data.context = $('<div/>').appendTo('#files');
        $.each(data.files, function (index, file) {
            var node = $('<p/>')
                    .append($('<span/>').text(file.name));
            if (!index) {
                node
                    .append('<br>')
                    .append(uploadButton.clone(true).data(data));
            }
            node.appendTo(data.context);
        });
    }).on('fileuploadprocessalways', function (e, data) {
        var index = data.index,
            file = data.files[index],
            node = $(data.context.children()[index]);
        if (file.preview) {
            node
                .prepend('<br>')
                .prepend(file.preview);
        }
        if (file.error) {
            node
                .append('<br>')
                .append($('<span class="text-error"/>').text(file.error));
        }
        if (index + 1 === data.files.length) {
            data.context.find('button')
                .text('上传')
                .prop('disabled', !!data.files.error);
        }
    }).on('fileuploadprogressall', function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#progress .progress-bar').css(
            'width',
            progress + '%'
        );
    }).on('fileuploaddone', function (e, data) {
        // $.each(data.result.data, function (index, file) {
        //     if (file.url) {
        //         var link = $('<a>')
        //             .attr('target', '_blank')
        //             .prop('href', file.url);
        //         $(data.context.children()[index])
        //             .wrap(link);
        //     } else if (file.error) {
        //         var error = $('<span class="text-error"/>').text(file.error);
        //         $(data.context.children()[index])
        //             .append('<br>')
        //             .append(error);
        //     }
        // });

        $.each(data.files, function (index) {
            var error = $('<span class="text-success"/>').text('文件上传成功。');
            $(data.context.children()[index])
                .append('<br>')
                .append(error);
        });
        $.each(data.result.data[0], function(index, result){
            console.log(result);
            $('#results').append('<p>' + result.name + ":" +  result.operater_status +'</p>');
        });

    }).on('fileuploadfail', function (e, data) {
        $.each(data.files, function (index) {
            var error = $('<span class="text-error"/>').text('文件上传失败。');
            $(data.context.children()[index])
                .append('<br>')
                .append(error);
        });
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});
