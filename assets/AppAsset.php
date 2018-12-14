<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        //Bootstrap CSS
        "vendor/assets/css/bootstrap.min.css",
        "https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.1/jquery.rateyo.min.css",
        "vendor/assets/css/animate.min.css",
        "vendor/assets/css/paper-dashboard.css",
        "vendor/assets/css/demo.css",
        "vendor/assets/css/fontawesome-min.css",
        "vendor/assets/css/themify-icons.css",
        "vendor/assets/css/modified.css",
        "vendor/assets/css/course.css",
        "https://fonts.googleapis.com/css?family=Muli:400,300",
        "vendor/datatable-1.10.9/css/dataTables.bootstrap.min.css",
//          "vendor/office/css/office.css",
        "vendor/datatable-1.10.9/css/dataTables.bootstrap.min.css",
        "vendor/dropzone/dropzone.css",
        "vendor/dropzone/min/dropzone.min.css",
        "vendor/alertifyjs/css/alertify.css",
        "vendor/alertifyjs/css/themes/default.css",
        "vendor/assets/select2/select2.css",
        "//cdnjs.cloudflare.com/ajax/libs/rateYo/2.2.0/jquery.rateyo.min.css",
        "https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.css",
        "https://cdn.datatables.net/v/dt/dt-1.10.15/datatables.min.css",
//        "https://cdnjs.cloudflare.com/ajax/libs/britecharts/3.0.0/css/britecharts.css",
        "https://cdn.jsdelivr.net/npm/britecharts/dist/css/britecharts.min.css"
    ];
    public $js = [
        "vendor/assets/js/jquery.min.js",
        "vendor/paper/paper.js",
        "vendor/assets/js/bootstrap.min.js",
//        "vendor/assets/js/paper-dashboard.js",
        "https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js",
//        "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js",
        "vendor/assets/js/jquery.validate.js",
        "vendor/dropzone/min/dropzone.min.js",
        "vendor/dropzone/dropzone.js",
        "vendor/datatable-1.10.9/js/jquery.dataTables.min.js",
        "vendor/datatable-1.10.9/js/dataTables.bootstrap.min.js",
        //alertify js
        "vendor/alertifyjs/alertify.js",
        "vendor/assets/select2/select2.min.js",
        "vendor/assets/formbuilderassets/vendor.js",
        "vendor/assets/formbuilderassets/form-builder.min.js",
        "vendor/assets/formbuilderassets/form-render.min.js",
        "http://formbuilder.online/assets/js/form-builder.min.js",
        "https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.1/jquery.rateyo.min.js",
        "https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.4.1/jquery.twbsPagination.js",
        "https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js",
        "https://cdn.jsdelivr.net/npm/britecharts@2/dist/bundled/britecharts.min.js",
        "https://cdnjs.cloudflare.com/ajax/libs/britecharts/3.0.0/bundled/britecharts.min.js",
        "https://cdnjs.cloudflare.com/ajax/libs/d3/4.13.0/d3.min.js",
        "//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.js",
        "//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/additional-methods.js"
    ];
    public $depends = [
            //'yii\web\YiiAsset',
            //'yii\bootstrap\BootstrapAsset',
    ];

}
