define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

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
                showExport:false,
                showColumns:false,
                showToggle:false,
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
                            field: 'images', //不能user.images
                            title: __('新视图'),
                            operate: false,
                            events: Table.api.events.img,
                            formatter: Table.api.formatter.img
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
                        {
                            field: 'status',
                            title: __('Status'),
                            searchList: {"0": __('No'), "1": __('Yes')},
                            formatter: Table.api.formatter.toggle
                        },
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

            //在普通搜索提交搜索前
            table.on('common-search.bs.table', function (event, table, query) {
                //这里可以获取到普通搜索表单中字段的查询条件
                console.log(table.options.queryParams);

            });


            //绑定TAB事件
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {

                // var options = table.bootstrapTable(tableOptions);
                var status = $(this).attr("href").replace('#', '');
                var options = table.bootstrapTable('getOptions');
                options.pageNumber = 1;
                options.queryParams = function (params) {
                    if (status != 'all') {
                        params.filter = JSON.stringify({status: status});
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
            }
        }
    };
    return Controller;
});