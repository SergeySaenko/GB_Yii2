<?php


namespace app\components\logger;


class LoggerConsole implements Logger
{

  public function log($txt)
  {
    echo $txt.PHP_EOL;
  }
}