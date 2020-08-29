<?php
declare(strict_types=1);

namespace BreathTakinglyBinary\npcs\events;


use BreathTakinglyBinary\npcs\entities\NPCHuman;
use pocketmine\event\Event;

abstract class NPCEvent extends Event{

    private NPCHuman $npc;

    public function __construct(NPCHuman $npc){
        $this->npc = $npc;
    }

    /**
     * @return NPCHuman
     */
    public function getNpc() : NPCHuman{
        return $this->npc;
    }

}