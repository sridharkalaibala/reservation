<?php
class Stands_model_test extends TestCase
{
    public function setUp()
    {
        $this->obj = $this->newModel('Stands_model');
    }
    public function test_get_stands()
    {

        $json = '[{"id":"1","location_id":"1","name":"Stand1","price":"23","image":"stand1.jpg","booking_status":"Booked","booked_by":"1","position":"475,180"},{"id":"2","location_id":"1","name":"Stand2","price":"24","image":"stand2.jpg","booking_status":"Free","booked_by":"22","position":"620,160"},{"id":"3","location_id":"1","name":"Stand3","price":"100","image":"stand3.jpg","booking_status":"Free","booked_by":"15","position":"250,520"},{"id":"4","location_id":"1","name":"Stand4","price":"80","image":"stand4.jpg","booking_status":"Free","booked_by":"21","position":"800,420"}]';
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
            1 => 'Stand1',
            2 => 'Stand2',
            3 => 'Stand3',
            4 => 'Stand4',
        ];
        $list = $this->obj->get_stands(1);
        foreach ($list as $company) {
            $this->assertEquals($expected[$company['id']], $company['name']);
        }
    }
    public function test_updateStatus()
    {


        $db = $this->getMockBuilder('CI_DB_pdo_sqlite_driver')
            ->disableOriginalConstructor()
            ->getMock();
        $db->method('where')->willReturn(true);
        $db->method('update')->willReturn(true);
        $db->method('affected_rows')->willReturn(1);

        // Verify invocations
        $this->verifyInvoked(
            $db,
            'where',
            []
        );
        // Verify invocations
        $this->verifyInvoked(
            $db,
            'update',
            []
        );

        // Replace property db with mock object
        $this->obj->db = $db;
        $result = $this->obj->updateStatus(1,1);
        $this->assertEquals($result, true);
    }


}