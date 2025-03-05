/**
 * Open file manager and return selected files.
 * Promise is never resolved if window is closed.
 *
 * @returns Promise<array> Array of selected files with properties:
 *      icon        string
 *      is_file     bool
 *      is_image    bool
 *      name        string
 *      thumb_url   string|null
 *      time        int
 *      url         string
 */
window.filemanager = function filemanager() {
    var url = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : '/filemanager';
    var target = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 'FileManager';
    var features = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 'width=900,height=600';

    return new Promise(function (resolve) {
        const fileManagerWindow = window.open(url, target, features);

        // دریافت پیام از فایل‌منیجر
        window.addEventListener('message', function handler(event) {
            if (event.origin !== 'https://core.pergola.ir') {
                console.log('Invalid origin:', event.origin);
                return;
            }

            console.log('Message received in filemanager.js:', event.data);
            if (event.data && event.data.mceAction === 'fileSelected') {
                resolve(event.data.items); // آرایه آیتم‌ها را برگردانید
                fileManagerWindow.close();
                window.removeEventListener('message', handler);
            }
        }, false);
    });
};
