<?php
namespace Solitaire\Common;

/**
 * provides the generic concrete implementation to Countable interface's 
 * abstract method
 *
 * Solitaire Game
 */
trait Countable {
    
    protected abstract function &getContainer(); 
    

    /**
     * Used by Countable
     * @return integer count of the current cards in the deck
     */
    public function count() {
        $container = &$this->getContainer();
        return count($container);
    }
}
