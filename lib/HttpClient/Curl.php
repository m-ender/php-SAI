<?php
/**
 * Implements the HTTP Client interface using PHP's cURL extension.
 * See http://www.php.net/manual/en/book.curl.php
 **/
class SAI_HttpClient_Curl
    implements SAI_HttpClientInterface
{
    /**
     * Array of all cURL handles returned by curl_init() calls.
     * The keys correspond to the request IDs given out to users of this class.
     * @var array of resource
     */
    private $_handles;

    /**
     * Holds responses, each corresponding to handle with the same key.
     * @var array
     */
    private $_responses;


    public function initializeRequest($url = null)
    {
        $_handles[] = curl_init($url);
        end($_handles);
        $lastAddedKey = key($_handles);
        return $lastAddedKey;
    }

    /**
     * This implementation of SAI_HttpClientInterface interprets $key as an integer for curl_setopt()
     */
    public function setOption($requestId, $key, $value)
    {
        return curl_setopt($this->_handles[$requestId], $key, $value);
    }

    public function setOptionForAll($key, $value)
    {
        foreach($this->_handles as $handle)
        {
            if(!curl_setopt($handle, $key, $value))
            {
                return false;
            }
        }
        return true;
    }

    public function setOptions($requestId, $optionsArray)
    {
        return curl_setopt_array($this->_handles[$requestId], $optionsArray);
    }

    public function setOptionsForAll($optionsArray)
    {
        foreach($this->_handles as $handle)
        {
            if(!curl_setopt_array($handle, $optionsArray))
            {
                return false;
            }
        }
        return true;
    }

    public function execute($requestId)
    {
        $this->_responses[$requestId] = curl_exec($this->_handles[$requestId]);
    }

    public function executeAll()
    {
        foreach($this->_handles as $key => $value)
        {
            $this->_responses[$key] = execute($key);
        }
    }

    public function getResponse($requestId)
    {
        return $this->_responses[$requestId];
    }

    public function getInfo($requestId, $option = null)
    {
        return curl_getinfo($this->_handles[$requestId], $option);
    }

    public function getError($requestId)
    {
        return curl_error($this->_handles[$requestId]);
    }

    public function close($requestId)
    {
        curl_close($this->_handles[$requestId]);
        unset($this->_handles[$requestId]);
    }

    public function closeAll()
    {
        foreach($this->_handles as $key => $handle)
        {
            close($key);
        }
    }
}
