<?php

require_once('class.mstwilio.php');

// auth
$accountSid = 'XXXXXXXXXXXXX';
$authToken = 'XXXXXXXXXXXXX';
$rootScriptUrl = 'http://www.example.com/twilio/run.php';

// other
$schedule = array(
  'monday'    => '+14155555555',
  'tuesday'   => '+14155555555',
  'wednesday' => '+14155555555',
  'thursday'  => '+14155555555',
  'friday'    => '+14155555555',
);

$callHandler = function($twilio, $post, $actions=null) use ($schedule) {
  $callerId = $post['From'];
  $number_to_call = $schedule['monday'];

  // call forward
  // get $number_to_call from $schedule
  $twilio->dial($number_to_call);
  print $twilio;
  return;
};

$smsHandler = function($twilio, $post, $actions=null) use ($schedule) {
  $callerId = $post['From'];
  $original_message = $post['Body'];

  $message_response = 'blah';

  // respond
  $twilio->message($message_response, array('to' => $callerId));
  print $twilio;
  return;
};

$twilio = new MSTwilio($accountSid, $authToken, $rootScriptUrl, $callHandler, $smsHandler);
$twilio->run();
