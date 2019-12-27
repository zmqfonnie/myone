define(['jquery', 'bootstrap', 'backend', 'table', 'form', 'viewer'], function ($, undefined, Backend, Table, Form, viewer) {

    var Controller = {

        index: function () {

            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'test/wuliu/index' + location.search,
                    add_url: 'test/wuliu/add',
                    edit_url: 'test/wuliu/edit',
                    del_url: 'test/wuliu/del',
                    multi_url: 'test/wuliu/multi',
                    table: 'wuliu',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'status',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: __('ID'), sortable: true},
                        {field: 'name', title: __('Name')},
                        {
                            field: 'image',
                            title: __('原视图'),
                            operate: false,
                            events: Table.api.events.image,
                            formatter: Table.api.formatter.images
                        },
                        {
                            field: 'images',
                            title: __('新视图'),
                            operate: false,
                            events: Controller.api.events.img,
                            formatter: Controller.api.formatter.img
                        },

                        {field: 'code', title: __('Code')},
                        {
                            field: 'createtime',
                            title: __('Createtime'),
                            sortable: true,
                            operate: 'RANGE',
                            addclass: 'datetimerange',
                            formatter: Table.api.formatter.datetime
                        },
                        {field: 'status', title: __('Status'),searchList:{"0": __('No'),"1": __('Yes')}, formatter: Table.api.formatter.toggle},
                        {
                            field: 'weigh',
                            title: __('Weigh'),
                            sortable: true,
                            searchList: function (column) {
                                return Template('chooseid', {});
                            },
                            formatter: function (value, row, index) {
                                return '<input type="text" class="form-control text-center text-weigh" maxlength="4" data-id="' + row.id + '" value="' + value + '" style="width:60px;margin:0 auto;" />';
                            },
                            events: {
                                "dblclick .text-weigh": function (e) {
                                    e.preventDefault();
                                    e.stopPropagation();
                                    return false;
                                }
                            },
                        },
                        {
                            field: 'operate',
                            title: __('Operate'),
                            table: table,
                            events: Table.api.events.operate,
                            formatter: Table.api.formatter.operate
                        }
                    ]
                ]
            });

            //修改权重
            $(document).on("change", ".text-weigh", function () {
                $(this).data("params", {weigh: $(this).val()});
                Table.api.multi('', [$(this).data("id")], table, this);
                return false;
            });


            //绑定TAB事件
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                // var options = table.bootstrapTable(tableOptions);
                var status = $(this).attr("href").replace('#', '');
                var options = table.bootstrapTable('getOptions');
                options.pageNumber = 1;
                options.queryParams = function (params) {
                    if(status != 'all'){
                        params.filter = JSON.stringify({status: status});
                        // params.status = typeStr;
                    }


                    return params;
                };
                table.bootstrapTable('refresh', {});
                return false;

            });
            $('ul.nav-tabs li.active a[data-toggle="tab"]').trigger("shown.bs.tab");
            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        add: function () {
            Controller.api.bindevent();
        },
        edit: function () {
            Controller.api.bindevent();
        },
        detail: function () {
            Controller.api.bindevent();
        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            },
            formatter: {
                img: function (value, row, index) {
                    value = value === null ? '' : value.toString();
                    var classname = typeof this.classname !== 'undefined' ? this.classname : 'img-sm viewer-img';
                    var arr = value.split(',');
                    var ul = $('<ul id="viewer' + index + '" style="list-style-type:none;padding:0;margin-bottom:0px;width:100%;"></ul>');
                    $.each(arr, function (i, value) {
                        value = value ? value : '/assets/img/blank.gif';
                        if (i == 0) {
                            ul.append('<li><img class="' + classname + '" style="cursor:pointer;margin: 0 auto;float:none;" data-original="' + Fast.api.cdnurl(value) + '" src="' + Fast.api.cdnurl(value) + '" /></li>');
                        } else {
                            ul.append('<li><img class="' + classname + '" style="cursor:pointer;display:none;margin: 0 auto;float:none;" data-original="' + Fast.api.cdnurl(value) + '" src="' + Fast.api.cdnurl(value) + '" /></li>');
                        }
                    });
                    return ul.prop("outerHTML");
                },
            },
            events: {
                img: {
                    'click .viewer-img': function (e, value, row, index) {
                        var options = {
                            url: 'data-original',
                        };
                        $('#viewer' + index).viewer(options);
                    },
                },
            }
        }
    };
    return Controller;
});