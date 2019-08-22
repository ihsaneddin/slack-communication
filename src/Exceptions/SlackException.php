<?php 
namespace Ihsaneddin\Slack\Exceptions;

use Ihsaneddin\Slack\SlackMessageableInterface;
use Ihsaneddin\Slack\Message\Message;
use Ihsaneddin\Slack\Message\MessageBuilder;
use Ihsaneddin\Slack\Message\Attachment;
use Ihsaneddin\Slack\SlackMessageableTrait;

abstract class SlackException extends \Exception implements SlackMessageableInterface{

  protected $channel = "GMHK7UV7A";

  use SlackMessageableTrait;

  public function toSlackMessage() : Message {
    return $this->getMessageBuilder()
              ->setText("*Exception*")
              ->setMarkdown(true)
              ->setChannelId($this->channel)
              ->addAttachment(new Attachment('*'. get_class($this).'*', $this->getMessage(), null, 'danger', null))
              ->addAttachment(new Attachment("Trace", $this->getTraceAsString()))
              ->create();
  }

  protected function getMessageBuilder() : MessageBuilder {
    return new MessageBuilder;
  }


}