<?php
/**
 * 自动部署git仓库.......
 * 阿里云
 * Created by PhpStorm.
 * User: codeShi
 * Date: 17-7-10
 * Time: 下午4:28
 * change by codeShi 2018
 */
// $is_bare = exec("/usr/bin/git rev-parse --is-bare-repository");
//
// if($is_bare === FALSE) {
//     writeLog("fatal: post-receive: IS_NOT_BARE");
//     exit;
// }
//
// $DeployPath="/home/wwwroot/default/VUE2";
//
// $result = exec("cd /home/wwwroot/default/VUE2;/usr/local/git/bin/git pull >> /tmp/git_auto_push.log 2>&1");
// exec("cd ${DeployPath}");
// exec("/usr/bin/git --work-tree=${DeployPath} clean -fd");
// exec("/usr/bin/git --work-tree=${DeployPath} checkout --force");
// exec("/usr/bin/git pull origin VUE2 >> /tmp/VUE2.log 2>&1");
// WriteLog("web server pull at webserver at time: " . date("YmdHis"));
//
// echo 'success';
//
// function writeLog($str) {
//     $log_str = "[" . date('Y-m-d H:i:s') . "] " . $str ."\n";
//     file_put_contents("/tmp/VUE2",$log_str,FILE_APPEND);
// }

    //密钥
    $secret = "123456";//Github项目中对应的Secret
    //获取GitHub发送的内容
    $json = file_get_contents('php://input');
    $content = json_decode($json, true);

    //github发送过来的签名
    $signature = $_SERVER['HTTP_X_HUB_SIGNATURE'];
    if (!$signature) {
        return http_response_code(404);
    }

    list($algo, $hash) = explode('=', $signature, 2);
    //计算签名
    $payloadHash = hash_hmac($algo, $json, $secret);
    if ($hash !== $payloadHash){
        return http_response_code(404);
    }

    echo "开始部署<br>";
    chdir("/home/wwwroot/default/VUE2");
    exec("git pull 2>&1", $out);
    foreach($out as $v)
    {
        echo iconv( 'GB2312','UTF-8', $v)."<br>";
    }
?>