<?php

namespace Solitaire\Test\Towers;

use PHPUnit_Framework_TestCase;
use Solitaire\Base\Card;
use Solitaire\Base\FoundationPile;
use Solitaire\Base\Pile;
use Solitaire\Towers\TableauPile;

/**
 * TableauPileTest
 *
 * Solitaire Game
 */
class TableauPileTest extends PHPUnit_Framework_TestCase {

    protected $tableau;
    protected $tableau2;
    protected $foundation;

    protected function setUp() {
        $this->tableau = new TableauPile();
        $this->tableau2 = new TableauPile();
        $this->foundation = new FoundationPile(FALSE);
    }

    function testInstance() {
        $this->assertTrue($this->tableau instanceof TableauPile);
        $this->assertTrue($this->tableau instanceof Pile);
    }

    function testCanAddWhenEmpty() {
        $card = new Card(['suit' => 'H', 'class' => 1], ['index' => 1, 'term' => 'A']);
        $this->assertTrue($this->tableau->isEmpty());
        $this->assertFalse($this->tableau->canAdd($card, $this->foundation));
        $this->assertFalse($this->tableau->canAdd($card, $this->tableau2));

        $card = new Card(['suit' => 'H', 'class' => 1], ['index' => 13, 'term' => 'K']);
        $this->assertTrue($this->tableau->canAdd($card, $this->tableau2));
    }

    function testCanAddWhenNotEmpty() {
        $card = new Card(['suit' => 'H', 'class' => 1], ['index' => 1, 'term' => 'A']);
        $this->tableau->deal($card);
        $this->assertFalse($this->tableau->isEmpty());

        $card = new Card(['suit' => 'H', 'class' => 1], ['index' => 13, 'term' => 'K']);
        $this->assertFalse($this->tableau->canAdd($card, $this->tableau2));
        $this->assertTrue($this->tableau2->canAdd($card, $this->tableau));

        $this->tableau2->deal($card);
        $this->assertFalse($this->tableau2->isEmpty());

        $card = new Card(['suit' => 'H', 'class' => 1], ['index' => 12, 'term' => 'Q']);
        $this->assertTrue($this->tableau2->canAdd($card, $this->tableau));

        $card = new Card(['suit' => 'D', 'class' => 1], ['index' => 12, 'term' => 'Q']);
        $this->assertFalse($this->tableau2->canAdd($card, $this->tableau));
    }

}
