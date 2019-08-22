<?php 
namespace Ihsaneddin\Slack\Message;

use Ihsaneddin\Slack\ApiClient;

use Slack\Message\MessageBuilder as MsgBuilder;

class MessageBuilder extends MsgBuilder {

  protected $client;

  public function __construct(ApiClient $client = null)
  {
    $this->client = $client;
  }

  /**
  * {@inheritDoc}
  */
  public function setMarkdown(bool $mrkdwn){
    $this->data["mrkdwn"] = $mrkdwn;
    return $this;
  }

  /**
  * {@inheritDoc}
  */
  public function setChannelId(string $channelId)
  {
    $this->data['channel'] = $channelId;
    return $this;
  }

  /**
  * {@inheritDoc}
  */
  public function create()
  {
    return new Message($this->client, $this->data);
  }

  /**
   * Adds a block to the message.
   *
   * @param Attachment $block The block to add.
   * @return $this
  */
  public function addBlock(Block $block){
    $this->data['blocks'][] = $block;
    return $this;
  }

}