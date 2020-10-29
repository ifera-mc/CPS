<?php
declare(strict_types = 1);

namespace JackMD\CPS;

use Ifera\ScoreHud\event\PlayerTagUpdateEvent;
use Ifera\ScoreHud\scoreboard\ScoreTag;
use Ifera\ScoreHud\ScoreHud;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use function is_null;
use function strval;

class CPS extends PluginBase{

	/** @var ScoreHud|null */
	private $scoreHud = null;
	/** @var array */
	private $clicks;
	
	public function onEnable(){
		$this->scoreHud = $this->getServer()->getPluginManager()->getPlugin("ScoreHud");

		if(!is_null($this->scoreHud)){
			$this->getServer()->getPluginManager()->registerEvents(new TagResolveListener($this), $this);
		}

		$this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
		$this->getLogger()->info("CPS Plugin Enabled.");
	}
	
	/**
	 * @param Player $player
	 * @return int
	 */
	public function getClicks(Player $player): int{
		if(!isset($this->clicks[$player->getLowerCaseName()])){
			return 0;
		}

		$time = $this->clicks[$player->getLowerCaseName()][0];
		$clicks = $this->clicks[$player->getLowerCaseName()][1];

		if($time !== time()){
			unset($this->clicks[$player->getLowerCaseName()]);
			return 0;
		}

		return $clicks;
	}
	
	/**
	 * @param Player $player
	 */
	public function addClick(Player $player): void{
		if(!isset($this->clicks[$player->getLowerCaseName()])){
			$this->clicks[$player->getLowerCaseName()] = [time(), 0];
		}

		$time = $this->clicks[$player->getLowerCaseName()][0];
		$clicks = $this->clicks[$player->getLowerCaseName()][1];

		if($time !== time()){
			$time = time();
			$clicks = 0;
		}

		$clicks++;
		$this->clicks[$player->getLowerCaseName()] = [$time, $clicks];

		if(!is_null($this->scoreHud)){
			(new PlayerTagUpdateEvent($player, new ScoreTag("cps.cps", strval($this->getClicks($player)))))->call();
		}
	}
}