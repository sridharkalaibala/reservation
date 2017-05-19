<?php
/**
 * Part of ci-phpunit-test
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class Templates_test extends TestCase
{
	public function test_index()
	{
		$output = $this->request('GET', '/templates/home.html');
		$this->assertContains('<h2>Please choose event to book</h2>', $output);
	}

    public function test_email()
    {
        $output = $this->request('GET', '/templates/email.html');
        $this->assertContains('<h2>Send users report to Business Admins</h2>', $output);
    }

    public function test_booking()
    {
        $output = $this->request('GET', '/templates/booking.html');
        $this->assertContains('<h2>Please choose free stand and reserve</h2>', $output);
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
