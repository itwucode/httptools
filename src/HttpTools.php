<?php


namespace Wuhttp;


class HttpTools {


    /**
     * 发起网络请求
     * @param string $url
     * @param $data
     * @param array $header
     * @return bool|string
     */
    public function http_request(string $url, $data = [], array $header = []) {
        $ret = '';
        // 1、初始化
        $ch = curl_init();
        // 2、相关配置
        # 设置请求的URL地址
        curl_setopt($ch, CURLOPT_URL, $url);
        # 设置一下执行成功后不直接返回到客户端
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        # 设置超时时间  单位是秒
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        # 不进行证书的检测
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        # 伪造一个请求的浏览器型号
        curl_setopt($ch, CURLOPT_USERAGENT, 'msie');

        // 表示有请求体，是POST的提交
        if (!empty($data)) {
            # 指明是一个POST请求
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            if (is_string($data)) {
                # 设置头信息，告诉接受者我们发送的数据类型
                curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            }
        }
        // 3、执行
        $ret = curl_exec($ch);
        # 请求的错误码 为0表示请求正确，大于0则表求请求失败的
        if (curl_errno($ch) > 0) {
            echo curl_error($ch);
            exit;
        }
        // 4、关闭请求资源
        curl_close($ch);
        return $ret;
    }
}