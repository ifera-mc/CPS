<?php
declare(strict_types = 1);

namespace JackMD\CPS;

use Ifera\ScoreHud\event\TagsResolveEvent;
use pocketmine\event\Listener;
use function count;
use function explode;
use function strval;

class TagResolveListener implements Listener{

	/** @var CPS */
	private $plugin;

	public function __construct(CPS $plugin){
		$this->plugin = $plugin;
	}

	public function onTagResolve(TagsResolveEvent $event){
		$tag = $event->getTag();
		$tags = explode('.', $tag->getName(), 2);
		$value = "";

		if($tags[0] !== 'cps' || count($tags) < 2){
			return;
		}

		switch($tags[1]){
			case "cps":
				$value = $this->plugin->getClicks($event->getPlayer());
			break;
		}

		$tag->setValue(strval($value));
	}
}