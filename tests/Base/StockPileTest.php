<?php

namespace Solitaire\Test\Base;

use PHPUnit_Framework_TestCase;
use Solitaire\Base\Card;
use Solitaire\Base\DiscardPile;
use Solitaire\Base\FoundationPile;
use Solitaire\Base\Pile;
use Solitaire\Base\StockPile;

/**
 * StockPileTest
 *
 * Solitaire Game
 */
class StockPileTest extends PHPUnit_Framework_TestCase {

    protected $stock;

    protected function setUp() {
        $this->stock = new StockPile(32);
    }

    function testInstance() {
        $this->assertTrue($this->stock instanceof StockPile);
        $this->assertTrue($this->stock instanceof Pile);
    }

    function testCanAdd() {
        $card = new Card(['suit' => 'H', 'class' => 1], ['index' => 1, 'term' => 'A']);
        $src = new FoundationPile(FALSE);
        $this->assertTrue($this->stock->isEmpty());
        $this->assertFalse($this->stock->canAdd($card, $src));

        $src = new DiscardPile();
        $this->assertTrue($this->stock->isEmpty());
        $this->assertFalse($this->stock->canAdd($card, $src));
    }

    function testCanRemove() {
        $dest = new FoundationPile(FALSE);
        $this->assertFalse($this->stock->canRemove($dest));

        $dest = new DiscardPile();
        $this->assertTrue($this->stock->isEmpty());
        $this->assertFalse($this->stock->canRemove($dest));

        $card = new Card(['suit' => 'H', 'class' => 1], ['index' => 1, 'term' => 'A']);
        $this->stock->addCard($card); // deal card
        $this->assertFalse($this->stock->isEmpty());
        $this->assertTrue($this->stock->canRemove($dest));
    }

    function testPrintPile() {
        $card = new Card(['suit' => 'H', 'class' => 1], ['index' => 1, 'term' => 'A']);
        $this->stock->addCard($card); // deal card
        $this->assertFalse($this->stock->isEmpty());
        
        $this->assertContains('Faced down', sprintf('%s', $this->stock->printPile()));
    }

}
