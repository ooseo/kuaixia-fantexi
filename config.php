<?php

// 系统
$config['system']['host'] = 'dev.fantexi.com'; // 访问域名
$config['system']['cache'] = 0; // 不开启缓存，86400 缓存一天
$config['system']['debug'] = true; // 不开启缓存，86400 缓存一天
$config['system']['view_type'] = 'vedio'; // 模版类型
$config['system']['count_code'] = ''; // 统计代码
$config['system']['cache_time'] = 86400 * 3; // 缓存时间 0 不开启

// redis 配置
$config['redis']['host'] = '127.0.0.1';
$config['redis']['port'] = 6379;
$config['redis']['password'] = '';
$config['redis']['select_db'] = 0;

// keyword是固定变量，num 和 suffix是随机变量 其他可以自己修改
$config['seo']['title'] = '{keyword}-{keyword}{suffix}-第{num}集费高清在线观看';
$config['seo']['title_suffix'] = "视频大全,在线观看,最新网址,免费观看,高清完整视频,高清频道,精彩完整视频,精彩完整视频,全集在线观看,高清免费播放";
$config['seo']['sitemap'] = 1000; // sitemap 链接数量
$config['seo']['baidu_token'] = ""; // baidu 推送token

// 干扰
$config['inter']['is_template'] = true; // 模版干扰
$config['inter']['is_ascii'] = true; // 阿斯克码干扰

// 访问控制
$config['request']['is_spider'] = false;  // 只允许蜘蛛访问 当有收录后请将此值改为false
$config['request']['is_get'] = true; // 只允许Get访问
$config['request']['uri_length'] = 40; // 访问路径最长
$config['request']['deny_ips'] = '110.110.*.*,120.120.120.*'; // IP黑名单，多个半角逗号分割，CD两段支持通配符

// 业务
$config['business']['landing']['pc'] = ''; // PC端跳转地址, 404 跳转到404页面
$config['business']['landing']['mobile'] = ''; // 移动端跳转地址 404 跳转到404页面

return $config;