#myone fastadmin test project
>learning fastadmin by fonnie 参考 https://mdeditor.com

### nginx+tp配置伪静态
```text
location / {
     if (!-e $request_filename){
           rewrite ^(.*)$ /index.php?s=$1 last; break;
    }
}
```

### js阻止事件冒泡
```javascript
e.stopPropagation();
```
 
### 配置require-table图片查看器
>在require-backend.js中添加viewer
```javascript
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
```
>在require-table中配置
```javascript
 formatter: {
                img: function (value, row, index) {

                    //查找字段名 使多字段使用
                    function getKey(obj,value) {
                        for(let key in obj){
                            if(obj[key] === value){
                                //找到了 value
                                return key;
                            }else{
                                //不是要找的 value
                                if(typeof obj[key] === 'object'){
                                    //该值为对象
                                    let temp = getKey(obj[key], value);

                                    if(temp){
                                        //temp 不是 undefined，找到了 value
                                        return '${temp}, ${key}';
                                    }
                                }
                            }
                        };
                    }

                    var field = getKey(row,value);

                    value = value === null ? '' : value.toString();
                    var classname = typeof this.classname !== 'undefined' ? this.classname : 'img-sm viewer-img';
                    var arr = value.split(',');
                    var ul = $('<ul id="viewer'+field + index + '" style="list-style-type:none;padding:0;margin-bottom:0px;width:100%;"></ul>');
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
                        // e.stopPropagation();
                        e.preventDefault();
                        //查找字段名
                        function getKey(obj,value) {
                            for(let key in obj){
                                if(obj[key] === value){
                                    //找到了 value
                                    return key;
                                }else{
                                    //不是要找的 value
                                    if(typeof obj[key] === 'object'){
                                        //该值为对象
                                        let temp = getKey(obj[key], value);

                                        if(temp){
                                            //temp 不是 undefined，找到了 value
                                            return '${temp}, ${key}';
                                        }
                                    }
                                }
                            };
                        }

                        var field = getKey(row,value);

                        var options = {
                            url: 'data-original',
                        };
                        $('#viewer'+field + index).viewer(options);
                    },
                },
            }
```
>在wuliu.js中配置
```javascript
 {
    field: 'images',
    title: __('新视图'),
    operate: false,
    events: Table.api.events.img,
    formatter: Table.api.formatter.img
},
```
### git更新
````
git add .
git pull
````