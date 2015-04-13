<?php

namespace Solitaire\Test\Base;

use PHPUnit_Framework_TestCase;
use Solitaire\Base\Card;
use Solitaire\Base\DiscardPile;
use Solitaire\Base\FoundationPile;
use Solitaire\Base\StockPile;

/**
 * Description of DiscardPileTest
 *
 * Solitaire Game
 */
class DiscardPileTest extends PHPUnit_Framework_TestCase {
    
    protected $discard;

    protected function setUp() {
        $this->discard = new DiscardPile();
    }
    
    function testCanAdd() {
        $card = new Card(['suit' => 'H', 'class' => 1], ['index' => 1, 'term' => 'A']);
        $src = new FoundationPile(FALSE);
        $this->assertTrue($this->discard->isEmpty());
        $this->assertFalse($this->discard->canAdd($card, $src));

        $src = new StockPile(32);
        $this->assertTrue($this->discard->isEmpty());
        $this->assertTrue($this->discard->canAdd($card, $src));
    }

    function testCanRemove() {
        $dest = new FoundationPile(FALSE);
        $card = new Card(['suit' => 'H', 'class' => 1], ['index' => 1, 'term' => 'A']);
        $this->discard->addCard($card);
        $this->assertFalse($this->discard->isEmpty());
        $this->assertTrue($this->discard->canRemove($dest));
        
        $removed = $this->discard->removeCard();
        $this->assertTrue($removed instanceof Card);
        $this->assertTrue($removed->isFirstInRank());
        $this->assertTrue($this->discard->isEmpty());

        $dest = new StockPile(32);
        $card = new Card(['suit' => 'H', 'class' => 1], ['index' => 1, 'term' => 'A']);
        $this->discard->addCard($card); // deal card
        $this->assertFalse($this->discard->isEmpty());
        $this->assertFalse($this->discard->canRemove($dest));
    }
}
