<?php
class Company_model_test extends TestCase
{
    public function setUp()
    {
        $this->obj = $this->newModel('Company_model');
    }
    public function test_get_companies()
    {

        $json = '[{"id":"1","admin":"Sridhar","logo":"logo2.jpg","email":"sri@pluskb.com","phone":"808080890","marketing_documents":"marketing1.zip"},{"id":"2","admin":"sdfsdfsd","logo":"ca77cb3d10c48461c136618e174610c0.png","email":"sdfsdfsd@gmail.com","phone":"4535345","marketing_documents":"a3e09effe2a3704f2ebdd69c4dab8525.zip"}]';
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
            1 => 'Sridhar',
            2 => 'sdfsdfsd',
        ];
        $list = $this->obj->get_companies();
        foreach ($list as $company) {
            $this->assertEquals($expected[$company['id']], $company['admin']);
        }
    }
    public function test_get_company()
    {

        $json = '[{"id":"1","admin":"Sridhar","logo":"logo2.jpg","email":"sri@pluskb.com","phone":"808080890","marketing_documents":"marketing1.zip"}]';
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
            1 => 'Sridhar'
        ];
        $list = $this->obj->get_company(1);
        foreach ($list as $company) {
            $this->assertEquals($expected[$company['id']], $company['admin']);
        }

        $this->assertEquals(count($list), 1);
    }

    public function test_insert_company()
    {


        $db = $this->getMockBuilder('CI_DB_pdo_sqlite_driver')
            ->disableOriginalConstructor()
            ->getMock();
        $db->method('insert')->willReturn(true);
        $db->method('insert_id')->willReturn(1);

        // Verify invocations
        $this->verifyInvokedOnce(
            $db,
            'insert',
            []
        );
        // Verify invocations
        $this->verifyInvokedOnce(
            $db,
            'insert_id',
            []
        );

        // Replace property db with mock object
        $this->obj->db = $db;

        $expected = 1;
        $last_insert_id = $this->obj->insert(array('admin'=>'Sridhar'));
        $this->assertEquals($expected, $last_insert_id);
     }
}