<?php
declare(strict_types = 1);

namespace JackMD\CPS;

use pocketmine\event\Listener;
use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\network\mcpe\protocol\InventoryTransactionPacket;

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
		$packet = $event->getPacket();
		if($packet instanceof InventoryTransactionPacket){
			$transactionType = $packet->transactionType;
			if($transactionType === InventoryTransactionPacket::TYPE_USE_ITEM || $transactionType === InventoryTransactionPacket::TYPE_USE_ITEM_ON_ENTITY){
				$this->plugin->addClick($player);
			}
		}
	}
}