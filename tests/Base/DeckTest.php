<?php

namespace Solitaire\Test\Base;

use PHPUnit_Framework_TestCase;
use Solitaire\Base\Card;
use Solitaire\Base\Deck;

/**
 * DeckTest
 *
 * Solitaire Game
 */
class DeckTest extends PHPUnit_Framework_TestCase {
    
    protected $deck;

    protected function setUp() {
        // new unshuffled deck
        $this->deck = new Deck();
    }
    
    function testInstance(){
        $this->assertTrue($this->deck instanceof Deck);
        $this->assertEquals(52, count($this->deck));
    }
    
    function testShuffle(){
        $this->assertTrue($this->deck[0] == 'AD');
        $shuffled = $this->deck->shuffle();
        $this->assertEquals(52, count($this->deck));
        $this->assertFalse($this->deck[0] == 'AD');
        $this->assertTrue($shuffled instanceof Deck);
    }
    
    function testGetNextCard(){
        $this->assertEquals(52, count($this->deck));
        $card = $this->deck->getNextCard();
        $this->assertTrue($card instanceof Card);
        $this->assertNotEquals(52, count($this->deck));
        $this->assertEquals(51, count($this->deck));
    }
}