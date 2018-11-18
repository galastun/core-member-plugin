<?php
use PHPUnit\Framework\TestCase;

require_once 'UserUpdate.php'; 
require_once 'HttpHelper.php';

final class UserUpdateTest extends TestCase {
  protected $userUpdate;
  protected $httpHelper;
  private $apiUrl = 'https://api.planningcenteronline.com/people/v2';

  protected function setUp() {
    $this->httpHelper = $this->createMock(HttpHelper::class);
    $this->userUpdate = new UserUpdate($this->httpHelper, 'name@email.com');
  }

  /** @test */
  public function shouldShowTrueBecauseEmailExists(): void {
    $this->httpHelper->expects($this->any())
      ->method('get')
      ->will($this->returnCallback('callback'));

    $this->assertEquals(
      $this->userUpdate->init(),
      true
    );
  }

  /** @test */
  public function shouldShowFalseBecauseEmailDoesNotExists(): void {
    $this->httpHelper->expects($this->any())
      ->method('get')
      ->will($this->returnCallback('callbackFalse'));

    $this->assertEquals(
      $this->userUpdate->init(),
      false
    );
  }

  /** @test */
  public function shouldCallUpdateUserAllNo(): void {
    $this->httpHelper->expects($this->at(0))
      ->method('post')
      ->with("$this->apiUrl/people/123/field_data", getPostArray('No', '196809'))
      ->will($this->returnCallback('postCallback'));

    $this->httpHelper->expects($this->at(1))
      ->method('post')
      ->with("$this->apiUrl/people/123/field_data", getPostArray('No', '196811'))
      ->will($this->returnCallback('postCallback'));

    $this->httpHelper->expects($this->at(2))
      ->method('post')
      ->with("$this->apiUrl/people/123/field_data", getPostArray('No', '196812'))
      ->will($this->returnCallback('postCallback'));

    $this->httpHelper->expects($this->at(3))
      ->method('post')
      ->with("$this->apiUrl/people/123/field_data", getPostArray('No', '196813'))
      ->will($this->returnCallback('postCallback'));
  
    $this->userUpdate->setId('123');
    $this->userUpdate->updateUser(array());
  }

  /** @test */
  public function shouldCallUpdateUserAllYes(): void {
    $this->httpHelper->expects($this->at(0))
      ->method('post')
      ->with("$this->apiUrl/people/123/field_data", getPostArray('Yes', '196809'))
      ->will($this->returnCallback('postCallback'));

    $this->httpHelper->expects($this->at(1))
      ->method('post')
      ->with("$this->apiUrl/people/123/field_data", getPostArray('Yes', '196811'))
      ->will($this->returnCallback('postCallback'));

    $this->httpHelper->expects($this->at(2))
      ->method('post')
      ->with("$this->apiUrl/people/123/field_data", getPostArray('Yes', '196812'))
      ->will($this->returnCallback('postCallback'));

    $this->httpHelper->expects($this->at(3))
      ->method('post')
      ->with("$this->apiUrl/people/123/field_data", getPostArray('Yes', '196813'))
      ->will($this->returnCallback('postCallback'));
  
    $this->userUpdate->setId('123');
    $this->userUpdate->updateUser(array(
      'attend-weekly' => 1,
      'serving-ministry' => 1,
      'attend-lifegroup' => 1,
      'educating-self' => 1
    ));
  }

  /** @test */
  public function shouldCallUpdateUserSomeYes(): void {
    $this->httpHelper->expects($this->at(0))
      ->method('post')
      ->with("$this->apiUrl/people/123/field_data", getPostArray('Yes', '196809'))
      ->will($this->returnCallback('postCallback'));

    $this->httpHelper->expects($this->at(1))
      ->method('post')
      ->with("$this->apiUrl/people/123/field_data", getPostArray('Yes', '196811'))
      ->will($this->returnCallback('postCallback'));

    $this->httpHelper->expects($this->at(2))
      ->method('post')
      ->with("$this->apiUrl/people/123/field_data", getPostArray('No', '196812'))
      ->will($this->returnCallback('postCallback'));

    $this->httpHelper->expects($this->at(3))
      ->method('post')
      ->with("$this->apiUrl/people/123/field_data", getPostArray('No', '196813'))
      ->will($this->returnCallback('postCallback'));
  
    $this->userUpdate->setId('123');
    $this->userUpdate->updateUser(array(
      'attend-weekly' => 1,
      'serving-ministry' => 1
    ));
  }

  /** @test */
  public function shouldCallUpdateUserAndUpdateFamilyAllYes(): void {
    $this->httpHelper->expects($this->any())
      ->method('get')
      ->will($this->returnCallback('callback'));

    for($i = 0; $i < 12; $i++) {
      $id = 0;
      if($i == 4) {
        $i++; // for some reason this breaks at 4 and only 4
      }

      switch($i) {
        case 0: case 1: case 2: case 3:
          $id = 123;
          break;
        case 5: case 7: case 7: case 8: 
          $id = 5;
          break;
        case 9: case 10: case 11: case 12:
          $id = 6;
          break;
      }

      $this->httpHelper->expects($this->at($i))
        ->method('post')
        ->with("$this->apiUrl/people/$id/field_data", getPostArray('Yes', '196809'))
        ->will($this->returnCallback('postCallback'));

      $this->httpHelper->expects($this->at(++$i))
        ->method('post')
        ->with("$this->apiUrl/people/$id/field_data", getPostArray('Yes', '196811'))
        ->will($this->returnCallback('postCallback'));
  
      $this->httpHelper->expects($this->at(++$i))
        ->method('post')
        ->with("$this->apiUrl/people/$id/field_data", getPostArray('Yes', '196812'))
        ->will($this->returnCallback('postCallback'));
  
      $this->httpHelper->expects($this->at(++$i))
        ->method('post')
        ->with("$this->apiUrl/people/$id/field_data", getPostArray('Yes', '196813'))
        ->will($this->returnCallback('postCallback'));
    }
  
    $this->userUpdate->setId('123');
    $this->userUpdate->updateUser(array(
      'include-household' => 1,
      'attend-weekly' => 1,
      'serving-ministry' => 1,
      'attend-lifegroup' => 1,
      'educating-self' => 1
    ));
  }

  /** @test */
  public function shouldCallUpdateUserAndUpdateFamilyAllNo(): void {
    $this->httpHelper->expects($this->any())
      ->method('get')
      ->will($this->returnCallback('callback'));

    for($i = 0; $i < 12; $i++) {
      $id = 0;
      if($i == 4) {
        $i++; // for some reason this breaks at 4 and only 4
      }

      switch($i) {
        case 0: case 1: case 2: case 3:
          $id = 123;
          break;
        case 5: case 7: case 7: case 8: 
          $id = 5;
          break;
        case 9: case 10: case 11: case 12:
          $id = 6;
          break;
      }

      $this->httpHelper->expects($this->at($i))
        ->method('post')
        ->with("$this->apiUrl/people/$id/field_data", getPostArray('No', '196809'))
        ->will($this->returnCallback('postCallback'));

      $this->httpHelper->expects($this->at(++$i))
        ->method('post')
        ->with("$this->apiUrl/people/$id/field_data", getPostArray('No', '196811'))
        ->will($this->returnCallback('postCallback'));
  
      $this->httpHelper->expects($this->at(++$i))
        ->method('post')
        ->with("$this->apiUrl/people/$id/field_data", getPostArray('No', '196812'))
        ->will($this->returnCallback('postCallback'));
  
      $this->httpHelper->expects($this->at(++$i))
        ->method('post')
        ->with("$this->apiUrl/people/$id/field_data", getPostArray('No', '196813'))
        ->will($this->returnCallback('postCallback'));
    }
  
    $this->userUpdate->setId('123');
    $this->userUpdate->updateUser(array(
      'include-household' => 1
    ));
  }

    /** @test */
    public function shouldCallUpdateUserAndUpdateFamilySomeYes(): void {
      $this->httpHelper->expects($this->any())
        ->method('get')
        ->will($this->returnCallback('callback'));
  
      for($i = 0; $i < 12; $i++) {
        $id = 0;
        if($i == 4) {
          $i++; // for some reason this breaks at 4 and only 4
        }
  
        switch($i) {
          case 0: case 1: case 2: case 3:
            $id = 123;
            break;
          case 5: case 7: case 7: case 8: 
            $id = 5;
            break;
          case 9: case 10: case 11: case 12:
            $id = 6;
            break;
        }
  
        $this->httpHelper->expects($this->at($i))
          ->method('post')
          ->with("$this->apiUrl/people/$id/field_data", getPostArray('Yes', '196809'))
          ->will($this->returnCallback('postCallback'));
  
        $this->httpHelper->expects($this->at(++$i))
          ->method('post')
          ->with("$this->apiUrl/people/$id/field_data", getPostArray('Yes', '196811'))
          ->will($this->returnCallback('postCallback'));
    
        $this->httpHelper->expects($this->at(++$i))
          ->method('post')
          ->with("$this->apiUrl/people/$id/field_data", getPostArray('No', '196812'))
          ->will($this->returnCallback('postCallback'));
    
        $this->httpHelper->expects($this->at(++$i))
          ->method('post')
          ->with("$this->apiUrl/people/$id/field_data", getPostArray('No', '196813'))
          ->will($this->returnCallback('postCallback'));
      }
    
      $this->userUpdate->setId('123');
      $this->userUpdate->updateUser(array(
        'include-household' => 1,
        'attend-weekly' => 1,
        'serving-ministry' => 1
      ));
    }
}

function callback() {
  $args = func_get_args();
  
  if(preg_match("/.*emails.*/", $args[0])) {
    return json_decode(json_encode(array(
      'data' => array(
        'email' => 'test@email.com'
      )
    )));
  }

  if(preg_match("/.*people\?where.*/", $args[0])) {
    return json_decode(json_encode(array(
      'data' => array(
        array(
          'id' => '123'
        )
      ),
      'included' => array(
        array(
          'id' => '321',
          'type' => 'Household'
        )
      )
    )));
  }

  if(preg_match("/.*households.*/", $args[0])) {
    return json_decode(json_encode(array(
      'included' => array(
        array(
          'id' => '5'
        ),
        array(
          'id' => '6'
        )
      )
    )));
  }
}

function callbackFalse() {
  $args = func_get_args();

  if(preg_match("/.*emails.*/", $args[0])) {
    return json_decode(json_encode(array(
      'data' => array()
    )));
  }
}

function postCallback() {
  $args = func_get_args();

  return json_decode(json_encode(array(
    'data' => array()
  )));
}

function getPostArray($value, $id) {
  return array (
    'data' => array (
      'type' => 'FieldDatum',
      'attributes' => array (
        'value' => $value
      ),
      'relationships' => array (
        'field_definition' => array (
          'data' => array ( 
            'type' => 'FieldDefinition',
            'id' => $id
          )
        )
      )
    )
  );
}
?>