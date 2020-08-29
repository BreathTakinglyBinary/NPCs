<?php

declare(strict_types=1);

namespace BreathTakinglyBinary\npcs\events;

use BreathTakinglyBinary\npcs\entities\NPCHuman;
use pocketmine\event\Cancellable;
use pocketmine\player\Player;

class NPCHitByPlayerEvent extends NPCEvent implements Cancellable {

    private bool $canceled = false;

    private Player $player;

    public function __construct(NPCHuman $npc, Player $player) {
        $this->player = $player;
        parent::__construct($npc);
    }

    public function getPlayer(): Player {
        return $this->player;
    }

    public function setCanceled(bool $canceled) : void{
        $this->canceled = $canceled;
    }

    public function isCancelled() : bool{
        return $this->canceled;
    }
}
