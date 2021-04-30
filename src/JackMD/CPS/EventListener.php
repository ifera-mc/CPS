<?php
declare(strict_types = 1);

namespace JackMD\CPS;

use pocketmine\event\Listener;
use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\network\mcpe\protocol\InventoryTransactionPacket;
use pocketmine\network\mcpe\protocol\LevelSoundEventPacket;
use pocketmine\network\mcpe\protocol\types\inventory\UseItemOnEntityTransactionData;

class EventListener implements Listener{
	
	/** @var CPS */
	private $plugin;
	
	/**
	 * EventListener constructor.
	 *
	 * @param CPS $plugin
	 */
	public function __construct(CPS $plugin){
		$this->plugin = $plugin;
	}
	
	/**
	 * @param DataPacketReceiveEvent $event
	 */
	public function onDataPacketReceive(DataPacketReceiveEvent $event){
		$player = $event->getPlayer();
		$p = $event->getPacket();
		if ($p instanceof LevelSoundEventPacket and $p->sound == LevelSoundEventPacket::SOUND_ATTACK_NODAMAGE or $p instanceof InventoryTransactionPacket and $p->trData instanceof UseItemOnEntityTransactionData and $p->trData->getActionType() === UseItemOnEntityTransactionData::ACTION_ATTACK) {
			$this->plugin->addClick($player);
		}
	}
}
