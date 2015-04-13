<?php

namespace Solitaire\Towers;

use Solitaire\Base\Card;
use Solitaire\Base\Pile;

/**
 * TowerPile
 *
 * Solitaire Game
 */
class TowerPile extends Pile {
    
    const LIMIT = 1;
    const NAME = 'Tower';

    /**
     * constructor function
     * Tower piles can only hold one item 
     */
    public function __construct() {
        parent::__construct(self::LIMIT, self::NAME);
    }

    /**
     * Tower piles only accept card from Tableau piles
     * 
     * @param \Solitaire\Base\Card $card
     * @param \Solitaire\Base\Pile $src
     * @return boolean
     */
    public function canAdd(Card $card, Pile $src = NULL) {
        if ($src && !($src instanceof TableauPile)) {
            return FALSE;
        }
        return parent::canAdd($card, $src);
    }

}
