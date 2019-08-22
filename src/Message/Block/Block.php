<?php 
namespace Ihsaneddin\Slack\Message\Block;

use Slack\DataObject;

abstract class Block extends DataObject {

  protected $type;

  public function __construct($block_id = null){
    $this->data["type"] = $this->type;
    if($block_id){
      $this->block_id = $block_id;
    }
  }

  public function getType(){
    return isset($this->data["type"]) ? $this->data["type"] : "section";
  }

  public function getBlockId(){
    return isset($this->data["block_id"]) ? $this->data["block_id"] : null;
  }

}