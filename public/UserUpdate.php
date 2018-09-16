<?php

class UserUpdate {
  private $map = array (
    'attend-weekly' => '196809',
    'serving-ministry' => '196811',
    'attend-lifegroup' => '196812',
    'educating-self' => '196813'
  );

  public $data = array (
    'data' => array (
      'type' => 'FieldDatum',
      'attributes' => array (
        'value' => ''
      ),
      'relationships' => array (
        'field_definition' => array (
          'data' => array ( 
            'type' => 'FieldDefinition',
            'id' => ''
          )
        )
      )
    )
  );

  public function __construct($pluginName, $email){
    $options = get_option($pluginName);
    $this->appId = $options['app-id'];
    $this->clientSecret = $options['client-secret'];

    $this->email = $email;
    $this->getUserId();
  }

  public function setFieldDef($value) {
    $this->data['data']['relationships']['field_definition']['data']['id'] = $this->map[$value];
  }

  public function setValue($value) {
    $this->data['data']['attributes']['value'] = $value;
  }

  public function updateUser($postInfo) {
    foreach($postInfo as $key => $value) {
      if($key == 'email') {
        continue;
      }

      if($value == '1') {
        $this->setValue('Yes');
        $this->setFieldDef($key);
        $this->postUpdate();
      }
    }
  }

  private function postUpdate() {
    $url = 'https://api.planningcenteronline.com/people/v2/people/' . $this->id . '/field_data';
    $result = wp_remote_post($url, array(
      'body' => json_encode($this->data),
      'headers' => array(
        'Authorization' => 'Basic ' . base64_encode($this->appId . ':' . $this->clientSecret)
      )
    ));

    $json = json_decode($result['body']);

    if(array_key_exists('errors', $json)) {
      if($json->errors[0]->detail == 'An existing field datum already exists for this record and field definition.') {
        // already yes, do nothing
      }
    }
  }

  private function getUserId() {
    $url = 'https://api.planningcenteronline.com/people/v2/people?where[search_name_or_email]=' . $this->email;
    $result = wp_remote_get($url, array(
      'headers' => array(
        'Authorization' => 'Basic ' . base64_encode($this->appId . ':' . $this->clientSecret)
      )
    ));
    
    $json = json_decode($result['body']);
    $this->id = $json->data[0]->id;
  }
}
?>
