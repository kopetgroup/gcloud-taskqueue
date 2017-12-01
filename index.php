<?php
require 'vendor/autoload.php';

use google\appengine\api\taskqueue\PushTask;
use google\appengine\api\taskqueue\PushQueue;

$app = new Slim\App();

$app->get('/', function ($request, $response, $args) {
  $response->write("Welcome to Slim!");
  return $response;
});

$app->get('/create', function ($request, $response) {

  $task = new PushTask('/queue',['name' => 'queue', 'action' => 'send_reminder']);

  //$task_name = $task->add('kopet');
  //echo 'create task: '.$task_name ;
  $queue = new PushQueue('kopet');
  $e = $queue->addTasks([$task]);
  return 'Task added: '.$e;

});

$app->post('/queue', function ($request, $response) {

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
  return file_get_contents($url, false, $context);

});

$app->get('/cron', function ($request, $response) {

  $msg = 'iki kronjot @'.date('Y-m-d H:i:s');
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
  $result = file_get_contents($url, false, $context);
  return $result;
  
});
$app->run();
