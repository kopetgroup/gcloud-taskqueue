<?php

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

	$memcache = new Memcache;
	$memcache->set('kopet','yes');
	$memcache->set('sekolah','wes');