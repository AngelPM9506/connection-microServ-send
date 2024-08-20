<?php

namespace NDD_send_connect_php56;

class NDD_send_connect_php56
{
    private $defultUrl = 'http://send.test01.app';
    private $url = '';
    private $apikey;
    private $defaultheaders = [
        'Accept: application/json',
        'Content-Type: application/json',
    ];
    private $headers = [
        'Accept: application/json',
        'Content-Type: application/json',
        'Authorization: '
    ];
    private $isToken = false;

    public function __construct($apikey, $url = null, $isToken = false)
    {
        if (!$apikey) {
            throw new \Exception("Apikey is required", 1);
        }
        $this->apikey = $apikey;
        $this->url = $url ? $url : $this->defultUrl;
        $this->headers[] = 'Authorization: ' . $this->apikey;
        $this->isToken = $isToken;
    }

    public function set_url($url)
    {
        if (!$url) {
            throw new \Exception("Url is required", 1);
        }
        $this->url = $url;
    }

    public function set_defaultUrl()
    {
        $this->url = $this->defultUrl;
    }

    public function get_url()
    {
        return $this->url;
    }

    public function set_apikey($apikey, $isToken = false)
    {
        if (!$apikey) {
            throw new \Exception("Apikey is required", 1);
        }
        $this->apikey = $apikey;
        $this->headers = [
            'Accept: application/json',
            'Content-Type: application/json',
            'Authorization: ' . $this->apikey
        ];
    }

    private function send_request($endpoint, $data)
    {
        $ch = curl_init($this->url . $endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        // Deshabilitar la verificación SSL
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            throw new \Exception(curl_error($ch));
        }

        // Obtiene el código de estado HTTP de la respuesta
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        // return json_decode($response, true);
        return $http_code;
    }

    public function send_email($from, $to, $subject, $cc = null, $bcc = null, $replyTo = null, $html = null, $text = null)
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
            'replyTo' => $replyTo,
            'html' => $html,
            'text' => $text
        ];

        return $this->send_request('/v1/send/key', $data);
    }

    public function send_email_token($from, $to, $subject, $cc = null, $bcc = null, $replyTo = null, $html = null, $text = null)
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
            'replyTo' => $replyTo,
            'html' => $html,
            'text' => $text
        ];

        return $this->send_request('/v1/send/token', $data);
    }
}
