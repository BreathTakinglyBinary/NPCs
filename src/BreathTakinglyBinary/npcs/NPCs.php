<?php

declare(strict_types=1);

namespace BreathTakinglyBinary\npcs;

use BreathTakinglyBinary\npcs\entities\NPCHuman;
use BreathTakinglyBinary\npcs\events\NPCHitByPlayerEvent;
use pocketmine\entity\Entity;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityMotionEvent;
use pocketmine\event\Listener;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;


class NPCs extends PluginBase implements Listener {

    /**
     * @return void
     */
    public function onEnable(): void {
        Entity::registerEntity(NPCHuman::class, true);
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    /**
     * @param EntityDamageByEntityEvent $event
     *
     * @return void
     * @ignoreCancelled true
     *
     */
    public function onEntityDamageByEntity(EntityDamageByEntityEvent $event): void {
        $entity = $event->getEntity();
        if ($entity instanceof NPCHuman) {
            $event->setCancelled(true);
            $damager = $event->getDamager();
            if (!$damager instanceof Player) {
                return;
            }
            (new NPCHitByPlayerEvent($entity, $damager))->call();
        }
    }

    /**
     * @param EntityMotionEvent $event
     *
     * @return void
     */
    public function onEntityMotion(EntityMotionEvent $event): void {
        $entity = $event->getEntity();
        if ($entity instanceof NPCHuman) {
            $event->setCancelled(true);
        }
    }

    public function onDisable(){
        foreach($this->getServer()->getLevels() as $level){
            foreach($level->getEntities() as $entity){
                if($entity instanceof NPCHuman){
                    $entity->close();
                }
            }
        }
    }

}
