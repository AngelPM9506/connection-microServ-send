<?php

namespace NDD_send_connect;

require 'vendor/autoload.php';

use GuzzleHttp\Client;



class NDD_send_connect
{
  private $defultUrl = 'http://send.test01.app';
  private $url = '';
  private $apikey;
  private $defaultheaders = [
    'Accept' => 'application/json',
    'Content-Type' => 'application/json',
  ];
  private $headers = [
    'Accept' => 'application/json',
    'Content-Type' => 'application/json',
    'Authorization' => ''
  ];
  private $client;
  private $isToken = false;

  public function __construct($apikey, $url = null, $isToken = false)
  {
    if (!$apikey) {
      throw new \Exception("Apikey is required", 1);
    }
    $this->apikey = $apikey;
    $this->url = $url ? $url : $this->defultUrl;
    $this->headers['Authorization'] = $this->apikey;
    $this->client = new Client([
      'base_uri' => $this->url,
      'headers' => $this->headers
    ]);
    $this->isToken = $isToken;
  }

  // Primero creamos un metodo para setar un nueva url en caso de que sea necesario
  public function set_url($url)
  {
    if (!$url) {
      throw new \Exception("Url is required", 1);
    }
    $this->url = $url;
    $this->client = new Client([
      'base_uri' => $this->url,
      'headers' => $this->headers
    ]);
  }

  // segundo creamos un metodo para regresar la url por defecto en caso de que sea necesario
  public function set_defaultUrl()
  {
    $this->url = $this->defultUrl;
    $this->client = new Client([
      'base_uri' => $this->url,
      'headers' => $this->headers
    ]);
  }

  // metodo para retornar la url actual
  public function get_url()
  {
    return $this->url;
  }

  // creamos un metodo para setar un nuevo apikey en caso de que sea necesario
  public function set_apikey($apikey, $isToken = false)
  {
    if (!$apikey) {
      throw new \Exception("Apikey is required", 1);
    }
    $this->apikey = $apikey;
    $this->headers['Authorization'] = $this->apikey;
    $this->client = new Client([
      'base_uri' => $this->url,
      'headers' => $this->headers
    ]);
  }

  /**
   * Metodo para enviar un correo electronico mediante un apikey
   * @param string $from
   * @param string $to
   * @param string $subject
   * @param string $cc
   * @param string $bcc
   * @param string $html
   * @param string $text
   * @endpoint /v1/send/key
   */
  public function send_email($from, $to, $subject, $cc = null, $bcc = null, $html = null, $text = null)
  {
    if (!$to || !$html || !$subject) {
      throw new \Exception("To, Html and Subject are required", 1);
    }
    $data = [
      'from' => $from,
      'to' => $to,
      'subject' => $subject,
      'cc' => $cc,
      'bcc' => $bcc,
      'html' => $html,
      'text' => $text
    ];

    try {
      //code...
      $response = $this->client->post('/v1/send/key', [
        'json' => $data
      ]);
      return json_decode($response->getBody()->getContents());
    } catch (\GuzzleHttp\Exception\RequestException $th) {
      //throw $th;
      if($th->hasResponse()){
        return json_decode($th->getResponse()->getBody()->getContents());
      }else{

        return $th->getMessage();
      }
    }
  }

  /**
   * Metodo para enviar un correo electronico mediante un token
   * @param string $from
   * @param string $to
   * @param string $subject
   * @param string $cc
   * @param string $bcc
   * @param string $html
   * @param string $text
   * @endpoint /v1/send/token
   */

  public function send_email_token($from, $to, $subject, $cc = null, $bcc = null, $html = null, $text = null)
  {
    if (!$to || !$html || !$subject) {
      throw new \Exception("To, Html and Subject are required", 1);
    }
    $data = [
      'from' => $from,
      'to' => $to,
      'subject' => $subject,
      'cc' => $cc,
      'bcc' => $bcc,
      'html' => $html,
      'text' => $text
    ];

    try {
      //code...
      $response = $this->client->post('/v1/send/token', [
        'json' => $data
      ]);
      return json_decode($response->getBody()->getContents());
    } catch (\GuzzleHttp\Exception\RequestException $th) {
      //throw $th;
      if($th->hasResponse()){
        return json_decode($th->getResponse()->getBody()->getContents());
      }else{

        return $th->getMessage();
      }
    }
  }
}
