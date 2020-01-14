define(['backend'], function (Backend) {

    //图片查看
    require.config({
        paths: {
            'viewer': '../libs/viewer/viewer.min',
        },
        shim: {
            'viewer': {
                deps: [
                    'jquery',
                    'css!../libs/viewer/viewer.min.css'
                ],
            },
        }
    });
});