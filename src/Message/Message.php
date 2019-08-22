<?php 
namespace Ihsaneddin\Slack\Message;

use Slack\Message\Message as Msg;

class Message extends Msg {

  public function isMarkdownEnabled(){
    return isset($this->data["mrkdwn"]) ? $this->data["mrkdwn"] : false;
  }

  public function hasBlocks(){
    return isset($this->data['blocks']) && count($this->data['blocks']) > 0;
  }

  public function getBlocks(){
    return isset($this->data['blocks']) ? $this->data['blocks'] : [];
  }

}