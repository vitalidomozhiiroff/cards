<?php

/*
 *  Class StandardCard
 *
 *  A standard card has a suit which is: Heart, Diamond, Spade or Club.
 *  A standard card has a value which is: 2, 3, 4, 5, 6, 7, 8, 9, 10, Jack, Queen, King or Ace.
 *
 */

class StandardCard extends Card {

    public static $allowed_values = array( '2', '3', '4', '5', '6', '7', '8', '9', '10', 'Jack', 'Queen', 'King', 'Ace' );

    private $value;

    /**
     * Constructor for a card
     * @param $suit
     * @param $value
     */
    function __construct($suit, $value)
    {
        parent::setSuit($suit);
        $this->value = $value;
    }

    public function setValue($value)
    {
        if (!in_array(ucfirst($value), self::$allowed_values) ) {
            throw new \Exception('Please check card value input');
        }
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }

    /**
     * Print a representation of itself
     * @return string
     */
    public function toString() {
        return $this->value . " of " . parent::getSuit() . 's';
    }

    /*
     * Two cards are equivalent if they have the same value
     *
     */
    public function equals($card) {
        // if card if standard and not something else
        if (is_a($card, 'StandardCard')) {
            if ($this->value == $card->value) {
                return true;
            }
        }

        return false;

    }


} 