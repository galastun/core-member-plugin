<?php
/**
 * A helper class for HTTP requests to Planning Center.
 * 
 * @class
 */
class HttpHelper {
  public function __construct($appId, $clientSecret) {
    $this->appId = $appId;
    $this->clientSecret = $clientSecret;
  }

  /**
   * Uses Wordpress GET to get data from Planning Center with Authorization set.
   * 
   * @param {String} $url The url to the API.
   * @return {Object} JSON body from the server.
   */
  public function get($url) {
    $result = wp_remote_get($url, array(
      'headers' => array(
        'Authorization' => 'Basic ' . base64_encode($this->appId . ':' . $this->clientSecret)
      )
    ));

    return json_decode($result['body']);
  }

  /**
   * Uses Wordpress POST to send data to Planning Center with Authorization set.
   * 
   * @param {String} $url The url to the API
   * @param {Object} $body The body to send.
   * @return {Object} JSON body from the server.
   */
  public function post($url, $body) {
    $result = wp_remote_post($url, array(
      'body' => json_encode($body),
      'headers' => array(
        'Authorization' => 'Basic ' . base64_encode($this->appId . ':' . $this->clientSecret)
      )
    ));

    return json_decode($result['body']);
  }
}
?>