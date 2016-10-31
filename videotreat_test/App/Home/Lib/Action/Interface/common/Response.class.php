<?php

class Response
{
    /*
     *按json格式输出通信数据
     * @param integer $code 状态码
     * @param string $message 提示信息
     * @param array  $data   数据
     * return string
     */
    public static function json($code, $message = '', $data = array())
    {
        if (!is_numeric($code)) {
            return '';
        }
        $result = array(
            'code' => $code,
            'message' => $message,
            'data' => $data
        );
        echo json_encode($result);
    }

    public static function log($request, $code, $message, $data=array())
    {
        $log_data = ' 状态码：' . $code . ' 返回信息：' . $message . ' 返回数据：' . json_encode($data);
        $handle = fopen(API_LOG, 'a+b');
        $log = date('Y-m-d H:i:s') . "\t" . '请求数据:' . json_encode($request) . "\t" . $log_data . "\r\n";
        fwrite($handle, $log);
        fclose($handle);
    }
}
