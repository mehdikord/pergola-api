(function ($) {
    $.fn.filemanager = function (type, options) {
        type = type || 'file';

        this.on('click', function (e) {
            var route_prefix = options && options.prefix ? options.prefix : '/filemanager';
            var target_input = $('#' + $(this).data('input'));
            var target_preview = $('#' + $(this).data('preview'));
            window.open(route_prefix + '?type=' + type, 'FileManager', 'width=900,height=600');

            // حذف تابع قدیمی SetUrl و جایگزینی با postMessage
            window.SetUrl = function (items) {
                var file_path = items.map(function (item) {
                    return item.url;
                }).join(',');

                // ارسال پیام به TinyMCE با postMessage
                window.opener.postMessage(
                    {
                        mceAction: 'fileSelected',
                        url: file_path,
                    },
                    '*'
                );

                // اگر همچنان نیاز به پشتیبانی از input و preview دارید
                target_input.val('').val(file_path).trigger('change');
                target_preview.html('');
                items.forEach(function (item) {
                    target_preview.append(
                        $('<img>').css('height', '5rem').attr('src', item.thumb_url)
                    );
                });
                target_preview.trigger('change');
            };

            return false;
        });
    };
})(jQuery);
