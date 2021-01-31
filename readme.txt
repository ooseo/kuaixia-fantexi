Nginx 配置
伪静态配置(默认的配置)
location / {
    if (!-e $request_filename) {
        rewrite ^(.*)$ /index.php/$1 last;
        break;
    }
}

当注释 fastcgi_param PATH_INFO $path_info; 后的配置
location / {
    if (!-e $request_filename) {
        rewrite ^(.*)$ /index.php?s=$1 last;
        break;
    }
}

主配置文件删除其他静态文件配置增加如下配置，请修改root路径
location ~ ^/images {
    root /www/wwwroot/www.youdomain.com/dafeiji-fantexi/data;
    error_log /dev/null;
    access_log off;
    expires 30d;
}

data/images  模版所需图片
data/tdk/section.txt 模版所需内容句子文件 
data/words 模版所需关键词，可以是多个文件


清理缓存
http://www.youdomain.com/site/clean

推送
http://www.youdomain.com/site/push




