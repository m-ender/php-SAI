<?php
/**
 * Mocks the cURL interface without issuing any PHP requests.
 * See http://www.php.net/manual/en/book.curl.php
 **/
class SAI_HttpClient_CurlMock
    implements SAI_CurlInterface
{

    public function curl_close($ch)
    {
        // TODO: Implement curl_close() method.
    }

    public function curl_copy_handle($ch)
    {
        // TODO: Implement curl_copy_handle() method.
    }

    public function curl_errno($ch)
    {
        // TODO: Implement curl_errno() method.
    }

    public function curl_error($ch)
    {
        // TODO: Implement curl_error() method.
    }

    public function curl_exec($ch)
    {
        // TODO: Implement curl_exec() method.
    }

    public function curl_getinfo($ch, $opt = 0)
    {
        // TODO: Implement curl_getinfo() method.
    }

    public function curl_init($url = null)
    {
        // TODO: Implement curl_init() method.
    }

    public function curl_multi_add_handle($mh, $ch)
    {
        // TODO: Implement curl_multi_add_handle() method.
    }

    public function curl_multi_close($mh)
    {
        // TODO: Implement curl_multi_close() method.
    }

    public function curl_multi_exec($mh, &$still_running)
    {
        // TODO: Implement curl_multi_exec() method.
    }

    public function curl_multi_getcontent($ch)
    {
        // TODO: Implement curl_multi_getcontent() method.
    }

    public function curl_multi_info_read($mh, &$msgs_in_queue = null)
    {
        // TODO: Implement curl_multi_info_read() method.
    }

    public function curl_multi_init()
    {
        // TODO: Implement curl_multi_init() method.
    }

    public function curl_multi_remove_handle($mh, $ch)
    {
        // TODO: Implement curl_multi_remove_handle() method.
    }

    public function curl_multi_select($mh, $timeout = 1.0)
    {
        // TODO: Implement curl_multi_select() method.
    }

    public function curl_setopt_array($ch, $options)
    {
        // TODO: Implement curl_setopt_array() method.
    }

    public function curl_setopt($ch, $option, $value)
    {
        // TODO: Implement curl_setopt() method.
    }

    public function curl_version($age = CURLVERSION_NOW)
    {
        // TODO: Implement curl_version() method.
    }
}
