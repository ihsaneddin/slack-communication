<?php 
namespace Ihsaneddin\Slack;

use React\EventLoop\Factory;
use React\EventLoop\LoopInterface;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\Drivers\Slack\SlackRTMDriver;

class Client {

  protected $token;
  protected $loop;

  public function __construct(){
    $this->token = config("slack.token");
  }

  public function createLoop() : LoopInterface{
    return Factory::create();
  }

  public function sendMessage(SlackMessageableInterface $messageable, string $token = null){
    $loop = $this->createLoop();
    $token = is_null($token) ? $this->token : $token;
    $client = $this->newApiClient($loop, $token);
    $message = $messageable->toSlackMessage();
    $client->postMessage($message);
    $loop->run();
  }

  public function newApiClient(LoopInterface $loop, string $token = null) : ApiClient {
    $client = new ApiClient($loop);
    $token = is_null($token) ? $this->token : $token;
    $client->setToken($token);
    return $client;
  }

  public function initLiveBot(LoopInterface $loop, string $token = null){
    DriverManager::loadDriver(SlackRTMDriver::class);
    $config = [
      "slack" => [
        "token" => is_null($token) ? $this->token : $token
      ]
    ];
    $botman = BotManFactory::createForRTM($config, $loop);
    return $botman;
  }

}