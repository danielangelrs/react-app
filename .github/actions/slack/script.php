<?php

require_once 'vendor/autoload.php';
Requests::register_autoloader();

echo "::debug ::Sending a request to slack\n";

$response = Requests::post(
    $_ENV ["INPUT_SLACK_WEBHOOK"],
    array(
        'Content-type' => 'application/json'
    ),
    json_encode(array (
        'blocks' => 
        array (
          0 => 
          array (
            'type' => 'section',
            'text' => 
            array (
              'type' => 'mrkdwn',
              'text' => $_ENV ["INPUT_MESSAGE"],
            ),
          ),
          1 => 
          array (
            'type' => 'section',
            'fields' => 
            array (
              0 => 
              array (
                'type' => 'mrkdwn',
                'text' => '*Repository:*
      {$_ENV ['GITHUB_REPOSITORY']}',
              ),
              1 => 
              array (
                'type' => 'mrkdwn',
                'text' => '*Event:*
      {$_ENV ['GITHUB_EVENT_NAME']}',
              ),
              array (
                'type' => 'mrkdwn',
                'text' => '*Ref:*
      {$_ENV ['GITHUB_GITHUB_REF']}',
              ),
              array (
                'type' => 'mrkdwn',
                'text' => '*SHA:*
      {$_ENV ['GITHUB_SHA']}',
              ),
              2 => 
              array (
                'type' => 'mrkdwn',
                'text' => '*Last Update:*
      Mar 10, 2015 (3 years, 5 months)',
              ),
              3 => 
              array (
                'type' => 'mrkdwn',
                'text' => '*Reason:*
      All vowel keys aren\'t working.',
              ),
              4 => 
              array (
                'type' => 'mrkdwn',
                'text' => '*Specs:*
      "Cheetah Pro 15" - Fast, really fast"',
              ),
            ),
          ),
        ),
      ))
     
);


echo "::group::Slack response\n";
var_dump($response);
echo '::endgroup::\n';

if(!$response->success) {
    echo $response->body;
    exit(1);
}