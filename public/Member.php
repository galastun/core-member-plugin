<?php

  /**
   * Used to create Planning Center member from scratch.
   */
  class Member {
    private $apiUrl = 'https://api.planningcenteronline.com/people/v2/';
    private $created = false;

    /**
     * Sets the keys, secrets and the members info
     * @constructor
     */
    public function __construct($pluginName) {
      $options = get_option($pluginName);
      $this->appId = $options['app-id'];
      $this->clientSecret = $options['client-secret'];
    }

    /**
     * Sets the first name of the member
     * 
     * @param {String} $firstName 
     * @returns void
     */
    public function setFirstName($firstName) {
      $this->firstName = $firstName;
    }

    /**
     * Sets the last name of the member
     * 
     * @param {String} $lastName
     * @returns void
     */
    public function setLastName($lastName) {
      $this->lastName = $lastName;
    }

    public function setAge($age) {
      $this->child = $age == 'child';
    }

    /**
     * Sets the email of the member
     * 
     * @param {String} $email
     * @returns void
     */
    public function setEmail($email) {
      $this->email = $email;
    }

    /**
     * Creates the user and if there is an email, adds it.
     * 
     * @returns bool
     */
    public function create() {
      $url = "$this->apiUrl/people/";
      $result = wp_remote_post($url, array(
        'body' => json_encode(array(
          'data' => array(
            'attributes' => array(
              'first_name' => $this->firstName,
              'last_name' => $this->lastName,
              'child' => $this->child
            )
          )
        )),
        'headers' => array(
          'Authorization' => 'Basic ' . base64_encode($this->appId . ':' . $this->clientSecret)
        )
      ));

      $json = json_decode($result['body']);

      if(array_key_exists('errors', $json)) {
        return false;
      }

      $this->created = true;

      $this->id = $json->data->id;

      if(isset($this->email)) {
        return $this->addEmail($this->id);
      }
    }

    /**
     * Creates a household based on the members array passed in.
     * 
     * @param {Member[]} $members
     * @returns bool
     */
    public function addHousehold($members) {
      $memberArray = array();
      array_push($memberArray, array(
        'type' => 'Person',
        'id' => $this->id
      ));

      foreach($members as $member) {
        array_push($memberArray, array(
          'type' => 'Person',
          'id' => $member->id
        ));
      }

      $url = "$this->apiUrl/households/";
      $result = wp_remote_post($url, array(
        'body' => json_encode(array(
          'data' => array(
            'attributes' => array(
              'name' => "$this->lastName Household"
            ),
            'relationships' => array(
              'people' => array(
                'data' => $memberArray
              ),
              'primary_contact' => array(
                'data' => array(
                  'type' => 'Person',
                  'id' => $this->id
                )
              )
            )
          )
        )),
        'headers' => array(
          'Authorization' => 'Basic ' . base64_encode($this->appId . ':' . $this->clientSecret)
        )
      ));

      $json = json_decode($result['body']);

      if(array_key_exists('errors', $json)) {
        return false;
      }
    }

    private function addEmail($id) {
      $url = "$this->apiUrl/people/$id/emails";
      $result = wp_remote_post($url, array(
        'body' => json_encode(array(
          'data' => array(
            'attributes' => array(
              'address' => $this->email,
              'location' => 'Home'
            )
          )
        )),
        'headers' => array(
          'Authorization' => 'Basic ' . base64_encode($this->appId . ':' . $this->clientSecret)
        )
      ));

      $json = json_decode($result['body']);

      if(array_key_exists('errors', $json)) {
        return false;
      } else {
        return true;
      }
    }
  }
?>