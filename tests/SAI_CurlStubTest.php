<?php
require_once dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'CurlStub.php';

class SAI_CurlStubTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var SAI_CurlStub
     */
    protected $_curlStub;

    const DEFAULT_RESPONSE = 'default response';

    public function setUp()
    {
        $this->_curlStub = new SAI_CurlStub();
        $this->_curlStub->setResponse(self::DEFAULT_RESPONSE);
    }

    public function testSetResponse()
    {
        $curl = $this->_curlStub;

        $ch = $curl->curl_init();
        ob_start();
        $curl->curl_exec($ch);
        $actualResponse = ob_get_clean();
        $curl->curl_close($ch);

        $this->assertEquals(self::DEFAULT_RESPONSE, $actualResponse);
    }

    public function testReturnTransfer()
    {
        $actualResponse = $this->_getResponseFromCurl();

        $this->assertEquals(self::DEFAULT_RESPONSE, $actualResponse);
    }

    public function testSetResponseForSpecificUrl()
    {
        $curl = $this->_curlStub;

        $expectedResponse = 'page found';
        $url = 'http://www.google.com';
        $requiredOptions = array(
            CURLOPT_URL => $url
        );
        $curl->setResponse($expectedResponse, $requiredOptions);

        // Setting no URL should give default response
        $actualResponse = $this->_getResponseFromCurl();

        $this->assertEquals(self::DEFAULT_RESPONSE, $actualResponse);

        // Setting correct URL should give set up response
        $actualResponse = $this->_getResponseFromCurl($url);

        $this->assertEquals($expectedResponse, $actualResponse);
    }

    public function testSetResponsesForMultipleUrls()
    {
        $curl = $this->_curlStub;

        $expectedResponse1 = 'google page found';
        $url1 = 'http://www.google.com';
        $expectedResponse2 = 'bing page found';
        $url2 = 'http://www.bing.com';

        $requiredOptions1 = array(
            CURLOPT_URL => $url1
        );
        $curl->setResponse($expectedResponse1, $requiredOptions1);
        $requiredOptions2 = array(
            CURLOPT_URL => $url2
        );
        $curl->setResponse($expectedResponse2, $requiredOptions2);

        // Setting wrong URL should give default response
        $actualResponse = $this->_getResponseFromCurl('http://www.yahoo.com');

        $this->assertEquals(self::DEFAULT_RESPONSE, $actualResponse);

        // Setting correct URLs should give corresponding responses
        $actualResponse = $this->_getResponseFromCurl($url1);

        $this->assertEquals($expectedResponse1, $actualResponse);

        $actualResponse = $this->_getResponseFromCurl($url2);

        $this->assertEquals($expectedResponse2, $actualResponse);
    }

    private function _getResponseFromCurl($url = null)
    {
        $curl = $this->_curlStub;

        $ch = $curl->curl_init($url);
        $curl->curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $actualResponse = $curl->curl_exec($ch);
        $curl->curl_close($ch);
        return $actualResponse;
    }
}