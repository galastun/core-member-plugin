<?php

include_once 'HttpHelper.php';

use PHPUnit\Framework\TestCase;

function wp_remote_get($url, $opts) {
  return array(
    'body' => json_encode(array(
      'test' => 'pass'
    ))
  );
}

function wp_remote_post($url, $opts) {
  return array(
    'body' => json_encode(array(
      'test' => 'pass'
    ))
  );
}

final class HttpHelperTest extends TestCase {
  protected $httpHelper;
  protected function setUp() {
    $this->httpHelper = new HttpHelper('123', '456');
  }

  /** @test */
  public function shouldCorrectlyCallWPGet(): void {
    $this->assertEquals(
      json_decode(json_encode(array(
        'test' => 'pass'
      ))),
      $this->httpHelper->get('/url')
    );
  }

  /** @test */
  public function shouldCorrectlyCallWPPost(): void {
    $this->assertEquals(
      json_decode(json_encode(array(
        'test' => 'pass'
      ))),
      $this->httpHelper->post('/url', array())
    );
  }
}
?>