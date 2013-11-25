<?php


/*
 * Basic card abstract class.
 *
 * Info:
 *  Every card has a type of: Heart, Diamond, Spade or Club.
 *
 */


abstract class Card {
    private $suit;
    public static $allowed_types =  array('Heart', 'Diamond', 'Spade', 'Club');

    function __construct($suit)
    {
        $this->suit = $suit;
    }

    public function setSuit($suit)
    {
        if (!in_array(ucfirst($suit), self::$allowed_types) ) {
            throw new \Exception('Please check card type input.');
        }
        $this->suit = $suit;
    }

    public function getSuit()
    {
        return $this->suit;
    }

    //Each ahs it own equals method
    abstract public function equals($card);

} 