<?php
namespace Ihsaneddin\Slack;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;

class SlackServiceProvider extends ServiceProvider

{
  /**
  * Bootstrap the application services.
  *
  * @return void
  */
  public function boot()
  {
    $this->publishConfig();
  }
  /**
  * Register the application services.
  *
  * @return void
  */
  public function register()
  {

    $this->app->bind('slackclient', function()
    {
      return new \Ihsaneddin\Slack\Client;
    });
  }

  private function publishConfig()
  {
    $config = __DIR__ . '/config/slack.php';
    $this->mergeConfigFrom($config, 'slack');
    $this->publishes([__DIR__ . '/config/slack.php' => config_path('slack.php')], 'config');
  }

}