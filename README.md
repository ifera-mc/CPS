![CPS Banner](https://github.com/JackMD/CPS/blob/master/meta/cps.png)
# CPS

| HitCount | License | Poggit | Release |
|:--:|:--:|:--:|:--:|
|[![HitCount](http://hits.dwyl.io/JackMD/CPS.svg)](http://hits.dwyl.io/JackMD/CPS)|[![GitHub license](https://img.shields.io/github/license/JackMD/CPS.svg)](https://github.com/JackMD/CPS/blob/master/LICENSE)|[![Poggit-CI](https://poggit.pmmp.io/ci.shield/JackMD/CPS/CPS)](https://poggit.pmmp.io/ci/JackMD/CPS/CPS)|[![](https://poggit.pmmp.io/shield.state/CPS)](https://poggit.pmmp.io/p/CPS)|

### A simple plugin which checks the clicks of a player per second. With in-built support for ScoreHud version 6.0+.

### Available Tags:

| Tag | Description |
|:--:|:--:|
|`{cps.cps}`|Shows the cps of the player on ScoreHud|

### API

CPS provides a simple API for developers wishing to use this plugin.<br />
- First you need to get hold of the plugin. You can do so by:<br />
```php
$cps = Server::getInstance()->getPluginManager()->getPlugin("CPS");
if($cps instanceof \JackMD\CPS\CPS){
    //do whatever
}
```
- Then you can get the click of a player via:<br />
```php
/** @var pocketmine\Player $player */
$clicks = $cps->getClicks($player);
```
- You can take a look at [CPS](https://github.com/JackMD/CPS/blob/master/src/JackMD/CPS/CPS.php) for more info.

### Credits
[DaPigGuy](https://github.com/DaPigGuy) for most of the code.
