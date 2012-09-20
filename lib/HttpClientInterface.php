<?php
/**
 * Low-level interface for sending HTTP requests and handling responses.
 * The interface provides operations to handle multiple requests and can either work
 * on each of them separately or on all of them together.
 **/
interface SAI_HttpClientInterface
{
    public function initializeRequest($url = null);

    public function setOption($requestId, $key, $value);
    public function setOptionForAll($key, $value);
    public function setOptions($requestId, $optionsArray);
    public function setOptionsForAll($optionsArray);

    public function execute($requestId);
    public function executeAll();

    public function getResponse($requestId);
    public function getInfo($requestId);
    public function getError($requestId);

    public function close($requestId);
    public function closeAll();
}
