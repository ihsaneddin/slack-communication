<?php 
namespace Ihsaneddin\Slack\Message;

use Slack\Message\Attachment as Attchmt;

class Attachment extends Attchmt {

  /**
  * {@inheritDoc}
  */
  public function __construct($title, $text, $fallback = null, $color = null, $pretext = null, array $fields = [])
  {
    $this->data['title'] = $title;
    $this->data['text'] = $text;
    $this->data['fallback'] = $fallback ?: $text;
    $this->data['color'] = $color;
    $this->data['pretext'] = $pretext;
    // $this->data["mrkdown"] = $mrkdown;
    // $this->data["footer"] = $footer;
    // $this->data["footer_icon"] = $footerIcon;
    // $this->data["ts"] = $ts;
    $this->data['fields'] = $fields;
  }

  /**
   * Gets a mrkdwn value.
   *
   * @return boolean  
  */
  public function getMrkdwn(){
    return isset($this->data["mrkdwn"]) ? $this->data["mrkdwn"] : false;
  }

  /**
   * Gets a plain-text footer of the attachment.
   *
   * @return string A plain-text footer of the attachment.
  */
  public function getFooter(){
    return isset($this->data["footer"]) ? $this->data["footer"] : null;
  }

  /**
   * Gets url of footer_icon of the attachment.
   *
   * @return string Am url footer_icon of the attachment.
  */
  public function getFooterIcon(){
    return isset($this->data["footer_icon"]) ? $this->data["footer_icon"] : false;
  }

  /**
   * Gets unix timestamp of attachment.
   *
   * @return integer An integer of unix timestamp.
   */
  public function getTs(){
    return isset($this->data["ts"]) ? $this->data["ts"] : false;
  }

  public function setFooter(string $footer = null){
    $this->data["footer"] = $footer;
    return $this;
  }

  public function setFooterIcon(string $footerIcon){
    $this->data["footer_icon"] = $footerIcon;
    return $this;
  }

  public function setMarkdown(bool $mrkdwn){
    $this->data['mrkdwn'] = $mrkdwn;
    return $this;
  }

  public function setTimestamp(int $ts){
    $this->data["ts"] = $ts;
    return $this;
  }

  public function addAction(Action $action){
    $this->data["actions"][] = $action;
    return $this;
  }

  public function setActions(array $actions=[]){
    $this->data["actions"] = $actions;
    return $this;
  }

}