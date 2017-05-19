<?php
class Location_model_test extends TestCase
{
    public function setUp()
    {
        $this->obj = $this->newModel('Location_model');
    }
    public function test_get_locations()
    {

        $json = '[{"id":"1","lat":"34.025638","lng":"-117.945146","mapimage":"map1.jpg","name":"Event 1","details":" Date:"},{"id":"2","lat":"34.027743","lng":" -117.945722","mapimage":"map2.png","name":"Event 2","details":" dd"},{"id":"3","lat":"34.029465","lng":"-117.946362","mapimage":"map3.jpg","name":"Event 3","details":" "}]';
        $return = json_decode($json,true);
        $db_result = $this->getMockBuilder('CI_DB_pdo_result')
            ->disableOriginalConstructor()
            ->getMock();
        $db_result->method('result')->willReturn($return);
        $db = $this->getMockBuilder('CI_DB_pdo_sqlite_driver')
            ->disableOriginalConstructor()
            ->getMock();
        $db->method('get')->willReturn($db_result);

        // Verify invocations
        $this->verifyInvokedOnce(
            $db_result,
            'result',
            []
        );
        // Verify invocations
        $this->verifyInvokedOnce(
            $db,
            'get',
            []
        );

        // Replace property db with mock object
        $this->obj->db = $db;

        $expected = [
            1 => '34.025638',
            2 => '34.027743',
            3 => '34.029465',
        ];
        $list = $this->obj->get_locations();
        foreach ($list as $location) {
            $this->assertEquals($expected[$location['id']], $location['lat']);
        }
    }
    public function test_get_location()
    {

        $json = '[{"id":"1","lat":"34.025638","lng":"-117.945146","mapimage":"map1.jpg","name":"Event 1","details":" ddd "}]';
        $return = json_decode($json,true);
         $db_result = $this->getMockBuilder('CI_DB_pdo_result')
            ->disableOriginalConstructor()
            ->getMock();
        $db_result->method('result')->willReturn($return);
        $db = $this->getMockBuilder('CI_DB_pdo_sqlite_driver')
            ->disableOriginalConstructor()
            ->getMock();
        $db->method('where')->willReturn(true);
        $db->method('get')->willReturn($db_result);

        // Verify invocations
        $this->verifyInvokedOnce(
            $db_result,
            'result',
            []
        );
        // Verify invocations
        $this->verifyInvokedOnce(
            $db,
            'get',
            []
        );

        // Replace property db with mock object
        $this->obj->db = $db;

        $expected = [
            1 => '34.025638'
        ];
        $list = $this->obj->get_location(1);
        foreach ($list as $location) {
            $this->assertEquals($expected[$location['id']], $location['lat']);
        }

        $this->assertEquals(count($list), 1);
    }

}