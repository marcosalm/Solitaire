<?php
namespace Solitaire\Common;

use ArrayIterator;

/**
 * provides the generic concrete implementation to IteratorAggregate interface's 
 * abstract methods 
 *
 * Solitaire Game
 */
trait IteratorAggregate {
    
    protected abstract function &getContainer();
    
    /**
     * IteratorAggregate related, used to loop over the object.
     * @return ArrayIterator
     */
    public function getIterator() {
        $container = &$this->getContainer();
        return new ArrayIterator($container);
    }
}
