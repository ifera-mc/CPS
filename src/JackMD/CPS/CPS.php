<?php
declare(strict_types = 1);

namespace JackMD\CPS;

use pocketmine\Player;
use pocketmine\plugin\PluginBase;

class CPS extends PluginBase{
	
	/** @var array */
	private $clicks;
	
	public function onEnable(){
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
	}
}