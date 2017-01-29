<?php

/**
 * User: aviginsberg
 * IDE: PhpStorm.
 * Date: 4/27/16
 */
class JobwatcherAPI
{
    protected $job_ID, $auto_end_job;
    protected $site_URL = "http://jobwatcher.io/";

    function __construct($job_ID, $auto_end_job=true) {
        $this->job_ID = $job_ID;
        $this->auto_end_job = $auto_end_job;
    }

    function __destruct() {
        if($this->auto_end_job)
            $this->end_job();
    }

    function http_request($path)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_URL,$path);
        curl_exec ($ch);
        curl_close ($ch);
    }
    function http_post_request($path, $data)
    {
       
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $path);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER,     array('Content-Type: text/plain'));

        curl_exec($ch);
       
    }


    function start_job()
    {
        $this->http_request($this->site_URL."start/".$this->job_ID);
    }

    function end_job()
    {
        $this->http_request($this->site_URL."end/".$this->job_ID);
    }

    function fail_job()
    {
        $this->http_request($this->site_URL."fail/".$this->job_ID);
    }

    function log_job($message)
    {
        $this->http_post_request($this->site_URL."log/".$this->job_ID,$message);
    }
}