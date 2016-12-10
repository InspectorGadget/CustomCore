<?php

namespace IGTheCore\Core\ServerCore;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerRespawnEvent;
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
		
			$level = $this->getServer()->getDefaultLevel()->getSafeSpawn();
			$p->teleport($level);
		
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
	
		$help[0] = " -- Help -- ";
		$help[1] = "/gm - Manages your GameMode!";
		$help[2] = "/fly - Allows you to toggle fly mode!";
		
		$player->sendMessage($help[0]);
		$player->sendMessage($help[1]);
		$player->sendMessage($help[2]);
	
	}
	
	public function onDrop(PlayerDropItemEvent $eve) {
		
		$this->setCancelled(true);
		
	}
	
	public function onCommand(CommandSender $sender, Command $cmd, $label, array $args) {
		switch(strtolower($cmd->getName())) {
		
		case "gm":
		
			$player = $sender;
			$this->gmHelp($player);
		
			return true;
		break;
		
		case "gmc":
		
			$player = $sender;
			
			$player->setGamemode(1);
			$sender->sendMessage("You GM has been to Gamemode C updated!");
		
			return true;
		break;
		
		case "gms":
			
			$player = $sender;
			
			$player->setGamemode(0);
			$sender->sendMessage("You GM has been changed to Gamemode S!");
			
			return true;
		break;
		
		case "fly":
		
		$sender->sendMessage("Usage: /fly <on | off>");
		
			if(isset($args[1])) {
				switch(strtolower($args[1])) {
				
					case "on":
						
						$sender->sendMessage("You have turned on Fly mode!");
						$sender->setAllowFlight(true);
						
						return true;
					break;
					
					case "off":
					
						$sender->sendMessage("You have turned off Fly mode!");
						$sender->setAllowFlight(false);
						
						return true;
					break;
				}
			}
			
			return true;
		break;
		}
	
	}
	
	public function gmHelp($player) {
	
		$text[0] = "/gms = GameMode Survival";
		$text[1] = "/gmc = GameMode Creative";
		
		$player->sendMessage($text[0]);
		$player->sendMessage($text[1]);
	
	}
	
	public function onRespawn(PlayerRespawnEvent $e) {
		$player = $e->getPlayer();
		
		$player->getInventory()->clearAll();
		
		$this->onItem($player);
		$sender->sendMessage("Default Item added!");
	}

	public function onDisable() {
	}
	
}
