#myone fastadmin test project
>by fonnie

### nginx+tp配置伪静态
```text
location / {
     if (!-e $request_filename){
           rewrite ^(.*)$ /index.php?s=$1 last; break;
    }
}
```