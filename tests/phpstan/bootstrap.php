<?php

//opcache breaks PHPStan when dynamic reflection is used - see https://github.com/phpstan/phpstan-src/pull/801#issuecomment-978431013
ini_set('opcache.enable', 'off');
//define('pocketmine\START_TIME', microtime(true));
//define('pocketmine\DEBUG', true);
