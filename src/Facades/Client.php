<?php 
namespace Ihsaneddin\Slack\Facades;

use Illuminate\Support\Facades\Facade;

class Client extends Facade
{
  protected static function getFacadeAccessor()
  {
    return 'slackclient';
  }
}