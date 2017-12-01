<?php
require('vendor/autoload.php');

use google\appengine\api\taskqueue\PushTask;
use google\appengine\api\taskqueue\PushQueue;

$r = file_get_contents('http://128.199.103.36/next');
if($r==0){
	
}else{
	
	$task1 = new PushTask('/queue',['name' => 'queue', 'action' => 'send_reminder']);
	$task2 = new PushTask('/queue',['name' => 'queue', 'action' => 'send_reminder']);
	$task3 = new PushTask('/queue',['name' => 'queue', 'action' => 'send_reminder']);
	
	
	$queue = new PushQueue('kopet');
	$e = $queue->addTasks([$task1,$task2,$task3]);
	


  $msg = 'iki kueue '.implode(',',$e).' @'.date('Y-m-d H:i:s');
  $url = 'https://hooks.slack.com/services/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';
  $data = ['text' => $msg];
  $headers = "Content-Type: application/json";
  $context = [
      'http' => [
          'method' => 'POST',
          'header' => $headers,
          'content' => json_encode($data),
      ]
  ];
  $context = stream_context_create($context);
  echo file_get_contents($url, false, $context);

	
}

