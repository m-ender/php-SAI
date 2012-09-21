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
        $curl = $this->_curlStub;

        $ch = $curl->curl_init();
        $curl->curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $actualResponse = $curl->curl_exec($ch);
        $curl->curl_close($ch);

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
        $ch = $curl->curl_init();
        $curl->curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $actualResponse = $curl->curl_exec($ch);
        $curl->curl_close($ch);

        $this->assertEquals(self::DEFAULT_RESPONSE, $actualResponse);

        // Setting correct URL should give set up response
        $ch = $curl->curl_init($url);
        $curl->curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $actualResponse = $curl->curl_exec($ch);
        $curl->curl_close($ch);

        $this->assertEquals($expectedResponse, $actualResponse);
    }

}