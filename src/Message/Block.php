<?php 
namespace Ihsaneddin\Slack\Message;

use Slack\DataObject;

class Block extends DataObject {

  public function __construct(string $type = null, array $data = []){
    $this->data["type"] = $type ? $type : "section";
    $this->data = array_merge($this->data, $data);
  }

  public function getType(){
    return isset($this->data["type"]) ? $this->data["type"] : "section";
  }

  public function getText(){
    return isset($this->data["text"]) ? $this->data["text"] : null;
  }

  public function getAccessory(){
    return isset($this->data["accessory"]) ? $this->data["accessory"] : null;
  }

  public function getElements(){
    return isset($this->data["elements"]) ? $this->data["elements"] : null;
  }

  public function jsonUnserialize(array $data)
  {
    if (isset($this->data['elements'])) {
      for ($i = 0; $i < count($this->data['elements']); $i++) {
        $this->data['elements'][$i] = Block::fromData($this->data['elements'][$i]);
      }
    }
    if(isset($this->data["accessory"])){
      $this->data['accessory'] = Block::fromData($this->data['accessory']);
    }
    if(isset($this->data["text"])){
      $this->data["text"] = Block::fromData($this->data["text"]);
    }
  }

}