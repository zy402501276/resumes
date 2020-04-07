<?php

define("ROOT",__DIR__);

include_once ROOT.'/Library/origin_autoload.php';

spl_autoload_register("\\Library\\Loader::origin_autoload");

$db = \Library\Factory::createDataBase();

