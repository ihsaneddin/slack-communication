<?php 
namespace Ihsaneddin\Slack;

interface SlackMessageableInterface {

  public function toSlackMessage() : Message\Message;

}