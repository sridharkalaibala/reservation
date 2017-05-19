<?php
/**
 * Part of ci-phpunit-test
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class Api_test extends TestCase
{
	public function test_locations()
	{
		$output = $this->request('GET', '/api/locations');
        $this->assertResponseCode(200);
	}

    public function test_location()
    {
        $output = $this->request('GET', '/api/location/1');
        $this->assertResponseCode(200);
    }

    public function test_stands()
    {
        $output = $this->request('GET', '/api/stands/1');
        $this->assertResponseCode(200);
    }

    public function test_company()
    {
        $output = $this->request('GET', '/api/company/1');
        $this->assertResponseCode(200);
    }

    public function test_companies()
    {
        $output = $this->request('GET', '/api/companies');
        $this->assertResponseCode(200);
    }

    public function test_email()
    {
        $output = $this->request('POST', '/api/send_email');
        $this->assertContains('failure', $output);
    }

    public function test_create_company()
    {
        $output = $this->request('POST', '/api/create_company');
        $this->assertContains('error', $output);
    }


    public function test_create_company_error()
    {
        $validation = $this->getDouble('CI_Form_validation', ['run' => TRUE]);
        $company_data = [
            'admin'=>'admin',
            'phone'=>'64665465465',
            'email'=>'sdfdfd@fsjld.com',
            'logo'=>'dfd',
            'marketing_documents'=>'dfd'
        ];
        $validation = $this->getDouble('CI_Form_validation', ['run' => TRUE]);

        $files = [
            'logo' => [
                'name'     => 'logo3.jpg',
                'type'     => 'image/jpeg',
                'tmp_name' => APPPATH.'tests/fixtures/logo3.jpg',
            ]
        ];
       $this->request->setFiles($files);

        $output = $this->request('POST', '/api/create_company',$company_data);
        $this->assertContains('error', $output);
    }

    public function test_send_email()
    {
        $validation = $this->getDouble('CI_Form_validation', ['run' => TRUE]);
        $this->request->setCallable(
            function ($CI) {
                $email = $this->getDouble('CI_Email', ['send' => TRUE]);
                $CI->email = $email;
            }
        );
        $output = $this->request('POST', '/api/send_email',['admin'=>'bala.phpdev@gmail.com','report'=>'test test']);
        $this->assertContains('success', $output);
    }

    public function test_send_email_fail()
    {
        $validation = $this->getDouble('CI_Form_validation', ['run' => TRUE]);
        $this->request->setCallable(
            function ($CI) {
                $email = $this->getDouble('CI_Email', ['send' => false]);
                $CI->email = $email;
            }
        );
        $output = $this->request('POST', '/api/send_email',['admin'=>'bala.phpdev@gmail.com','report'=>'test test']);
        $this->assertContains('failure', $output);
    }

	public function test_method_404()
	{
		$this->request('GET', 'welcome/method_not_exist');
		$this->assertResponseCode(404);
	}

	public function test_APPPATH()
	{
		$actual = realpath(APPPATH);
		$expected = realpath(__DIR__ . '/../..');
		$this->assertEquals(
			$expected,
			$actual,
			'Your APPPATH seems to be wrong. Check your $application_folder in tests/Bootstrap.php'
		);
	}


}
