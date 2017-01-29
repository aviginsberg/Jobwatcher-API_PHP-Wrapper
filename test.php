<?php
/**
 * User: aviginsberg
 * IDE: PhpStorm.
 * Date: 4/27/16
 */

require "JobwatcherAPI.php";

$JW_API_KEY = "abc12345"; //replace with API Key

$JW = new JobwatcherAPI($JW_API_KEY);

$JW->start_job();

$JW->log_job("Testing!");
$JW->log_job("Waiting 4 seconds...");
sleep(4);
$JW->log_job("Waiting 3 seconds...");
sleep(3);
$JW->log_job("Waiting 2 seconds...");
sleep(2);
$JW->log_job("Ending script via destructor!");

