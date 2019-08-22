<?php 
namespace Ihsaneddin\Slack;

use Ihsaneddin\Slack\Message\MessageBuilder;

trait SlackMessageableTrait {

  protected function getMessageBuilder() : MessageBuilder {
    return new MessageBuilder;
  }

}