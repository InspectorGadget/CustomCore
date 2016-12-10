<?php

namespace IGTheCore\Core\ServerCore;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\event\Listener;
use pocketmine\utils\Config;
use pocketmine\Server;
use pocketmine\Player;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerDropItemEvent;
use pocketmine\utils\TextFormat as TF;

class ServerCore extends PluginBase implements Listener {

	public function onEnable() {
		$this->getServer()->registerEvents($this, $this);
		$this->getLogger()->warning("
		* Starting CustomCore!
		* Ploting Server DB!
		");
	}
	
	public function onJoin(PlayerJoinEvent $e) {
		$p = $e->getPlayer();
		$player = $e->getPlayer();
		$n = $p->getName();
		$inv = $p->getInventory();
		$inv->clearAll();
		
		$text[0] = " ---- Welcome, $n! ---- ");
		$text[1] = TF::BOLD . TF::RED . "Welcome" . TF::GREEN . "to" . TF::YELLOW . "JDCustom!";
		$text[2] = "We have about" . TF::RED . count($this->getServer()->getOnlinePlayers() . TF::RESET . " players online!";
		$text[3] = "Our Website: " . TF::RED . "https://jdcraft.net";
		$text[4] = "Check your inventory!";
		
		$p->sendMessage($text[0]);
		$p->sendMessage($text[1]);
		$p->sendMessage($text[2]);
		$p->sendMessage($text[3]);
		$p->sendMessage($text[4]);
		
		$this->onItem($player);
	}
	
	public function onHeld(PlayerItemHeldEvent $ev) {
		$hand = $ev->getPlayer()->getItemInHand();
		$p = $ev->getPlayer();
		$player = $ev->getPlayer();
		
		if($hand->getName() === "Help") {
		
			$this->Help($player);
		
		}
		
		if($hand->getName() === "Spawn") {
		
			$
		
		}
	}
	
	public function onItem($player) {
		
		$player->getInventory()->addItem(Item::get(339, 0, 1)->setCustomName("Help"));
		$player->getInventory()->addItem(Item::get(345, 0, 1)->setCustomName("Spawn"));
		$player->setGamemode(0);
		$player->setMaxHealth(20);
		$player->setHealth(20);
		$player->setFood(20);
		
	}
	
	public function Help($player) {
	
		$help[0] = " -- Help -- ");
		$help[1] = "");
	
	}
	
	public function onDrop(PlayerDropItemEvent $eve) {
		
		$this->setCancelled(true);
		
	}







}
