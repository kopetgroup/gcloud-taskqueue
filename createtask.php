<?php
require('vendor/autoload.php');

use google\appengine\api\taskqueue\PushTask;
use google\appengine\api\taskqueue\PushQueue;

$task = new PushTask(
    '/queue',
    ['name' => 'queue', 'action' => 'send_reminder']);

//$task_name = $task->add('kopet');
//echo 'create task: '.$task_name ;

$queue = new PushQueue('kopet');
$e = $queue->addTasks([$task]);
print_r($e);