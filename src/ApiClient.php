<?php 
namespace Ihsaneddin\Slack;

use Ihsaneddin\Slack\Message\MessageBuilder;
use Slack\ApiClient as Client;
use Slack\Message\Message;

class ApiClient extends Client{

  /**
  * {@inheritDoc}
  */
  public function postMessage(Message $message)
  {
    $options = [
        'text' => $message->getText(),
        'markdown' => $message->isMarkdownEnabled(),
        'channel' => $message->data['channel'],
        'as_user' => true,
    ];

    if ($message->hasAttachments()) {
        $options['attachments'] = json_encode($message->getAttachments());
    }
    if($message->hasBlocks()){
      $options['blocks'] = json_encode($message->getBlocks());
    }
    return $this->apiCall('chat.postMessage', $options);
  }

  /**
  * {@inheritDoc}
  */
  public function getMessageBuilder()
  {
    return new MessageBuilder($this);
  }

}