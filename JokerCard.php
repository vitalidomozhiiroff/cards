<?php

/*
 *  Class JokerCard
 *
 * A joker has no suit and value(TODO usually without value, but needed to be checked).
 *
 */

class JokerCard extends Card {

    function __construct($suit)
    {
        parent::setSuit($suit);
    }

    /**
     * Print a representation of itself
     * @return string
     */
    public function toString() {
        return "Joker of " . parent::getSuit() . 's';
    }

    /*
     * Two cards are equivalent if they are jokers
     *
     */
    public function equals($card) {
        if (is_a($card, 'JokerCard')) {
            return true;
        }

        return false;
    }
}