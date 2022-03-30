<?php

require_once('twilio/src/Twilio/autoload.php');

class MSTwilio
{
  private $accountSid;
  private $authToken;
  private $rootScriptUrl;
  private $callHandler;

  public function __construct($accountSid, $authToken, $rootScriptUrl, $callHandler, $smsHandler)
  {
    $this->accountSid = $accountSid;
    $this->authToken = $authToken; 
    $this->rootScriptUrl = $rootScriptUrl;
    $this->callHandler = $callHandler;
    $this->smsHandler = $smsHandler;
  }

  public function run()
  {
    $action = $_GET['action'];

    if ($this->validate()) {
      if ($_POST['CallSid']) {
        $this->handleCall();
      } else if ($_POST['SmsSid']) {
        $this->handleSms();
      }
    } else {
      echo 'Nothing to do.';
    }
  }

  private function validate()
  {
    $validator = new \Twilio\Security\RequestValidator($this->authToken);
    $signature = $_SERVER['HTTP_X_TWILIO_SIGNATURE'] ?? '';
    $requestUrl = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $isTwilio = $validator->validate($signature, $requestUrl, $_POST);
    return $isTwilio;
  }

  private function handleCall()
  {
    $twilio = new \Twilio\TwiML\VoiceResponse();
    $recordAction = $this->rootScriptUrl . '?action=handle_recording';
    $handler = $this->callHandler;
    $handler($twilio, $_POST, array('record' => $recordAction));
  }

  private function handleSms()
  {
    $twilio = new \Twilio\TwiML\MessagingResponse();
    $handler = $this->smsHandler;
    $handler($twilio, $_POST);
  }
}
