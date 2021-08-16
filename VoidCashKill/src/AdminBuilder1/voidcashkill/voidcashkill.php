<?php

namespace AdminBuilder1\VoidCashKill;

use pocketmine\Server;
use pocketmine\Player;

use pocketmine\plugin\PluginBase;


use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\entity\EntityDamageEvent;

use pocketmine\utils\TextFormat as C;

class VoidCashKill extends PluginBase implements Listener {
	public $cash;
	public $KillPlayer;
	
	public function onEnable(){
		$this->getLogger()->info(C::GREEN . "voidcashkill is enabled");
		$this->cash = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
	}
	public function onDisabled(){
		$this->getLogger()->info(C::GREEN . "voidcashkill is enabled");
	}
	 public function onDamage(EntityDamageEvent $event){
        $this->KillPlayer = $event->getDamager()->getName();
	  }
	  
	public function onPlayerDeath(PlayerDeathEvent $e){
		$player = $e->getPlayer();
		$cid = $player->getLastDamageCause()->getCause();
		switch($cid){
			  case EntityDamageEvent::CAUSE_VOID:
				EconomyAPI::getInstance()->addMoney($this->KillPlayer, 250);
				$this->getServer()->broadcastMessage($this->killPlayer . " threw " . $player->getName() . "into the void");
				return true;
       break;
		}
	}
	 
	
}
