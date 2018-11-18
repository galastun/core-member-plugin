<?php

/**
 * Handles user information received from the frontend and calls the 
 * planning center API to update a the user.
 */
class UserUpdate {
  private $id;
  private $apiUrl = 'https://api.planningcenteronline.com/people/v2';
  private $map = array (
    'attend-weekly' => '196809',
    'serving-ministry' => '196811',
    'attend-lifegroup' => '196812',
    'educating-self' => '196813'
  );

  private $data = array (
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

  /**
   * Sets the keys, secrets and the user's email/id
   * @constructor
   */
  public function __construct(HttpHelper $httpHelper, $email) {
    $this->httpHelper = $httpHelper;
    $this->email = $email;
  }

  public function init() {
    if(!$this->checkEmailExists($this->email)) {
      return false;
    }

    $this->getUserId();
    return true;
  }

  /**
   * Sends the user information to the Planning Center API server
   * and sets the rest of the household if it was selected.
   * 
   * @param {Object} postInfo The POST body from the client form
   * @return {void}
   */
  public function updateUser($postInfo) {
    $this->sendUserInfo($this->id, $postInfo);

    if($postInfo['include-household'] == 1) {
      $this->setHouseholdMembers($postInfo);
    }
  }

  /**
   * Sets the ID of the User.
   * 
   * @param {String} $value The ID to set.
   */
  public function setId($value) {
    $this->id = $value;
  }

  /**
   * Sets the field definition for the Planning Center API.
   * @param {String} value the id to set
   * @returns {void}
   */
  private function setFieldDef($value) {
    $this->data['data']['relationships']['field_definition']['data']['id'] = $this->map[$value];
  }

  /**
   * Sets the answer to the question and sets it in the Planning Center API
   * format.
   * 
   * @param {String} value Yes|No
   * @return {void}
   */
  private function setValue($value) {
    $this->data['data']['attributes']['value'] = $value;
  }

  /**
   * Sets the values for the body of the POST request to the Planning Center
   * API and then sends it.
   * 
   * @param {String} id The user ID from Planning Center
   * @param {Object} postInfo The POST body from the client form
   * @return {void}
   */
  private function sendUserInfo($id, $postInfo) {
    foreach($this->map as $key => $value) {
      if($key == 'email') {
        continue;
      }

      if(isset($postInfo[$key])) {
        $this->setValue('Yes');
        $this->setFieldDef($key);
        $this->postUpdate($id);
      } else {
        $this->setValue('No');
        $this->setFieldDef($key);
        $this->postUpdate($id);
      }
    }
  }

  /**
   * Sends the actual POST request to the Planning Center API.
   * 
   * @param {String} id the user ID from Planning Center
   * @return {void}
   */
  private function postUpdate($id) {
    $url = "$this->apiUrl/people/$id/field_data";
    $json = $this->httpHelper->post($url, $this->data);

    if(array_key_exists('errors', $json)) {
      if($json->errors[0]->detail == 'An existing field datum already exists for this record and field definition.') {
        // already yes, do nothing
      }
    }
  }

  /**
   * Gets the user ID from Planning Center.
   * 
   * @return {String}
   */
  private function getUserId() {
    $url = "$this->apiUrl/people?where[search_name_or_email]=$this->email&include=field_data,households";
    
    $json = $this->httpHelper->get($url);

    $this->id = $json->data[0]->id;
    $this->householdId = $this->getHousehold($json->included)->id;
  }

  /**
   * Loops through the members in a person's household and sends POST body from
   * the client form.
   * 
   * @param {Object} postInfo The POST body from the client form
   */
  private function setHouseholdMembers($postInfo) {
    $this->household = array();

    $url = "$this->apiUrl/households/$this->householdId?include=people";
    $json = $this->httpHelper->get($url);

    foreach($json->included as $person) {
      $this->sendUserInfo($person->id, $postInfo);
    }
  }

  /**
   * Gets the household from the included data field.
   * 
   * @param {Array} $data The include field of the return data.
   * @return {Object} 
   */
  private function getHousehold($data) {
    foreach($data as $obj) {
      if($obj->type == 'Household') {
        return $obj;
      }
    }

    return null;
  }

  /**
   * Check if an email exists in Planning Center
   * 
   * @param {String} $email The user's email to check
   * @returns {Bool}
   */
  private function checkEmailExists($email) {
    $url = "$this->apiUrl/emails?where[address]=$email";
    $json = $this->httpHelper->get($url);

    return sizeof($json->data) > 0;
  }
}
?>
