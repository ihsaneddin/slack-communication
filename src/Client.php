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

  public function setToken(string $token){
    $this->token = $token;
  }

  public function createLoop() : LoopInterface{
    return Factory::create();
  }

  public function sendMessage(SlackMessageableInterface $messageable, string $thread = null, callable $then = null, callable $otherwise = null){
    $loop = $this->createLoop();
    $token = $this->token;
    $client = $this->newApiClient($loop, $token);
    $message = $messageable->toSlackMessage();
    $promise = $client->postMessage($message, $thread);
    if(is_callable($then)){
      $promise->then($then);
    }
    if(is_callable($otherwise)){
      $promise->otherwise($otherwise);
    }
    $loop->run();
    $loop->stop();
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