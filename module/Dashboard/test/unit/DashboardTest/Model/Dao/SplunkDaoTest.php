<?php
namespace DashboardTest\Model\Dao;

use DashboardTest\DataProvider\SplunkDaoDataProvider;

class SplunkDaoTest extends AbstractDaoTestCase
{
    use SplunkDaoDataProvider;

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     *
     */
    protected function setUp()
    {
        parent::setUp();
        $this->testedDao->getDataProvider()->setAdapter(new \Zend\Http\Client\Adapter\Test());
    }

    /**
     * @dataProvider fetchFivehundredsForAlertWidgetDataProvider
     */
    public function testFetchFivehundredsForAlertWidget($apiResponse, $expectedDaoResponse)
    {
        $adapter = $this->testedDao->getDataProvider()->getAdapter();
        $responseString = file_get_contents($apiResponse);
        $adapter->setResponse($responseString);
        $response = $this->testedDao->fetchFivehundredsForAlertWidget(['config' => 'godtStatus500']);
        $this->assertInternalType('array', $response);
        $this->assertEquals($expectedDaoResponse, $response);

    }

    /**
     * Executing fetch* method that is not defined in JenkinsDao - should throw an Exception
     * @expectedException \Dashboard\Model\Dao\Exception\FetchNotImplemented
     */
    public function testImproperApiMethod()
    {
        $this->testedDao->fetchImproperDataName();
    }

    /**
     * Proper API method, not all required params given - should throw an Exception
     * @expectedException \Dashboard\Model\Dao\Exception\EndpointUrlNotAssembled
     */
    public function testNotAllRequiredParamsGiven()
    {
        $this->testedDao->fetchFivehundredsForAlertWidget();
    }
}
