<?php 
namespace Ihsaneddin\Slack\Message\Block;

use Slack\DataObject;

class Section extends Block {

  protected $type = "section";

  public function __construct(Elements\Text $text, Elements\Accessory $accessory = null, array $fields = [], $block_id = null){
    parent::__construct($block_id);
    $this->data["text"] = $text;
    if($accessory){
      $this->data["accessory"] = $accessory; 
    }
    if(!empty($fields)){
      $this->data["fields"] = $fields;
    }
    if($block_id){
      $this->data['block_id'] = $block_id;
    }
  }

  public function getText(){
    return isset($this->data["text"]) ? $this->data["text"] : null;
  }

  public function getFields(){
    return isset($this->data["fields"]) ? $this->data["fields"] : null;
  }

  public function jsonUnserialize(array $data)
  {
    if (isset($this->data['fields'])) {
      for ($i = 0; $i < count($this->data['fields']); $i++) {
        $this->data['fields'][$i] = Elements\Text::fromData($this->data['fields'][$i]);
      }
    }
    if(isset($this->data["text"])){
      $this->data['text'] = Elements\Text::fromData($this->data['text']);
    }
  }

}