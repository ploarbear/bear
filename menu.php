 <?php
$appid="wxa287cd1ade0e68e4";
$appsecret="3647d8465fd32b3bfbb93c78fe3f27cd";

$url=
    "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";

$output = https_request($url);
$jsoninfo = json_decode($output,true);
$access_token = $jsoninfo["access_token"];
//自定义json格式菜单内容
$jsonmenu = '{
    "button": [
        {
            "name": "KT天气预报", 
            "sub_button": [
                {
                    "type": "click", 
                    "name": "广州天气", 
                    "key": "天气广州"
                }, 
                {
                    "type": "click", 
                    "name": "深圳天气", 
                    "key": "天气深圳"
                }, 
                {
                    "type": "click", 
                    "name": "北京天气", 
                    "key": "天气北京"
                }, 
                {
                    "type": "click", 
                    "name": "上海天气", 
                    "key": "天气上海"
                }, 
                {
                    "type": "view", 
                    "name": "本地天气", 
                    "url": "http://m.hao123.com/a/tianqi"
                }
            ]
        }, 
        {
            "name": "KT课堂", 
            "sub_button": [
                {
                    "type": "click", 
                    "name": "课堂简介", 
                    "key": "jgjyclass"
                }, 
                {
                    "type": "click", 
                    "name": "KT推荐", 
                    "key": "jgtj"
                }, 
                {
                    "type": "click", 
                    "name": "创业分享", 
                    "key": "创业"
                }
            ]
        },
         {
            "name": "KT服务", 
            "sub_button": [
                {
                    "type": "view", 
                    "name": "学生端", 
                    "url": "http://ztkwx.applinzi.com/login.php"
                }, 
                {
                    "type": "view", 
                    "name": "教师端", 
                    "url": "http://ztkwx.applinzi.com/login2.php"
                }
            ]
        }
    ]
}';
//创建菜单实现
$url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$access_token;
$result = https_request($url,$jsonmenu);
/*var_dump($result);*/
//自定义CURL会话创建菜单
function https_request($url,$data=null){
    $curl = curl_init();
    curl_setopt($curl,CURLOPT_URL,$url);
    curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,FALSE);
    curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,FALSE);
    if(!empty($data)){
        curl_setopt($curl,CURLOPT_POST,1);
        curl_setopt($curl,CURLOPT_POSTFIELDS,$data);
    }
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
    $output = curl_exec($curl);
    curl_close($curl);
    return $output;
}