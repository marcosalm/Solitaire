<?php

namespace Solitaire\Base;

use ArrayAccess;
use Countable;
use IteratorAggregate;
use Solitaire\Base\Card;
use Solitaire\Base\Deck;

/**
 * Deck base class
 *
 * Solitaire Game
 */
class Deck implements IteratorAggregate, ArrayAccess, Countable {
    use \Solitaire\Common\IteratorAggregate;
    use \Solitaire\Common\ArrayAccess;
    use \Solitaire\Common\Countable;

    /**
     * @var variable holding this deck instance
     */
    private $deck;

    /**
     * @var array of cards meta
     */
    private $cards;

    /**
     * @var array of suits meta
     */
    private $suits;

    /**
     * Creates a new deck of cards, where the suits are in the order
     * of D - diamonds, H - hearts, C - clubs, S - spades, and each suit is
     * ordered A to K.
     *
     */
    public function __construct() {
        $this->init();
        $this->deck = $this->createDeck();
    }

    /**
     * Uses PHP's shuffle to mix up the array
     */
    public function shuffle() {
        shuffle($this->deck);
        return $this;
    }

    /**
     * Resets the deck, mix up the order, and returns the deck.
     * @return Deck
     */
    public function reset() {
        $this->deck = $this->createDeck();
        return $this;
    }

    /**
     * Returns the next Card from the deck
     * follows the convention that right most one at the bottom
     */
    public function getNextCard() {
        // array_shift is slower on large datasets since it has to reindex
        return array_shift($this->deck);
    }

    /**
     * internal helper get the deck
     * @return array container array of cards
     */
    protected function getContainer() {
        return $this->deck;
    }

    /**
     * function which intializes the meta for cards and suits
     * called when when constructing Deck
     */
    private function init() {
        // grouped with binary to make comparisons easy, since we have two classes
        $this->suits = ['D' => 1, 'H' => 1, 'C' => 0, 'S' => 0];
        $this->cards = ['A', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K'];
    }

    /**
     * @param string $suit The suite to create.
     * @return array The cards for the suit.
     */
    private function createSuit($suit) {
        $cards = [];
        foreach ($this->cards as $key => $card) {
            $cards[] = new Card($suit, [ 'index' => $key + 1, 'term' => $card], TRUE);
        }
        return $cards;
    }

    /**
     * Returns a new deck of cards, where the suits are in the order
     * of D - diamonds, H - hearts, C - clubs, S - spades, and each suit is
     * ordered A to K.
     *
     * @return array An array of type Card.
     */
    private function createDeck() {
        $deck = [];
        foreach ($this->suits as $suit => $class) {
            $deck = array_merge($deck, $this->createSuit(['suit' => $suit, 'class' => $class]));
        }
        return $deck;
    }

}
