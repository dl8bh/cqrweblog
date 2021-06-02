<?php

class Checkdxcc
{
    private $apiurl;
    private $curl_session;

    function __construct($apiurl)
    {
        $this->apiurl = $apiurl;
        $this->curl_session = curl_init();
        curl_setopt($this->curl_session, CURLOPT_RETURNTRANSFER, true);
    }
    function __destruct()
    {
        curl_close($this->curl_session);
    }
    function call_to_dxcc($callsign)
    {
        $requesturl = $this->apiurl . $callsign;
        curl_setopt($this->curl_session,  CURLOPT_URL, $requesturl);
        $resultstring = curl_exec($this->curl_session);
        $jsonarray = json_decode($resultstring, TRUE);
        return $jsonarray;
    }
}
