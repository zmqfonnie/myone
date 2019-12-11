define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            $("#cityselect-test .col-xs-12").each(function () {
                $("textarea", this).val($(this).prev().prev().html().replace(/[ ]{2}/g, ''));
            });

            //这里需要手动为Form绑定上元素事件
            Form.api.bindevent($("form#cityselectform"));
        }
    };
    return Controller;
});