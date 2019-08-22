<?php

require __DIR__ . '/vendor/autoload.php';

use React\EventLoop\Factory;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\Drivers\Slack\SlackRTMDriver;

$loop = \React\EventLoop\Factory::create();

$client = new Ihsaneddin\Slack\ApiClient($loop);
$client->setToken('xoxb-271237322528-720215220626-XdEJuqnMBWs5hnfkRobsAuEd');
use \Slack\Channel;
$channel = new Channel($client, ["id" => "GMHK7UV7A"]);

use Ihsaneddin\Slack\Message\{Attachment, Block};
use Slack\Message\AttachmentField;
$message = $client->getMessageBuilder()
    ->setText('Hello, *all*!')
    ->setChannel($channel)
    ->addBlock(new Block("section", [
      "text" => new Block("plain_text", [
          "text" => "Farmhouse"
        ]),
      "accessory" => new Block("datepicker", [
        "initial_date" => "1990-04-28"
      ])
    ]))
    ->addAttachment(new Attachment('My Attachment', 'attachment text'))
    ->addAttachment(new Attachment('Build Status', '~Build failed!~ :/', 'build failed', 'good', null, [], true, null,null,time()))
    ->addAttachment(new Attachment('Some Fields', 'fields', null, '#BADA55', [
        new AttachmentField('Title1', 'Text', false),
        new AttachmentField('Title2', 'Some other text', true)
    ]))
    ->create();
$ex = new Ihsaneddin\Slack\Exceptions\TestException("Exception message");
$message = $ex->toSlackMessage();
$client->postMessage($message)->otherwise(function($e){
  eval(\Psy\sh());
});
eval(\Psy\sh());
$loop->run();

// Load driver
$config = [
  'slack' => [
      'token' => 'xoxb-271237322528-720215220626-XdEJuqnMBWs5hnfkRobsAuEd'
  ]
];

// #DriverManager::loadDriver(\BotMan\Drivers\Slack\SlackDriver::class);
// #$botman = BotManFactory::create($config);
// DriverManager::loadDriver(SlackRTMDriver::class);
// $loop = Factory::create();
// $botman = BotManFactory::createForRTM($config, $loop);

// $botman->hears('test', function($bot) {
//   $bot->reply('I heard you! :)');
// });

// $botman->hears('convo', function($bot) {
//   $bot->startConversation(new ExampleConversation());
// });

// $loop->run();