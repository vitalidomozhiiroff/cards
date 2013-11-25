<?php

/**
 * Class Pack
 *
 * A pack of cards comprises each of the thirteen values (2, 3... King, Ace) in each of the four suits - plus two jokers.
 */


class Pack {

    private $cards;

    // Creates cards pack with 54 cards and randomly shuffled
    function __construct()
    {
        $before = array();
        // 1. populate the with standard cards
        for ($i = 0; $i < 52; $i++) {
            //generate random value for the card
            $value = StandardCard::$allowed_values[rand(0, 12)];
            //generate random type for the card
            $suit =   Card::$allowed_types[rand(0, 3)];
            if (isset($before[$suit][$value])) {
                $i--;
                continue;
            }

            $before[$suit][$value] = true;
            $cards[] = new StandardCard($suit, $value);
        }

        //2. populate the with two joker cards
        for ($i = 0; $i < 2; $i++) {
            //generate random type for the card
            $suit =   Card::$allowed_types[rand(0, 3)];

            if (isset($before[$suit]['joker'])) {
                $i--;
                continue;
            }

            $before[$suit]['joker'] = true;
            $cards[] = new JokerCard($suit);
        }

        // 3. Shuffle the cards randomly
        shuffle($cards);
        $this->cards = $cards;
    }

    // card pick function
    function pickCard($position_mark) {
        $card = $this->cards[$position_mark];
        if ($card == null) {
            //print $position_mark;
            return null;
            //exit();
        }
        print "<div style='color:red'><- [$position_mark] " . $card->toString() . "</div><br>";
        $this->cards[$position_mark] = null; // remove from pack because we take
        return $card;
    }

    function putBackCard($card, $mark) {
        print "<div style='color:green'>-> [$mark] " . $card->toString() . "</div><br>";
        $this->cards[$mark] = $card;
    }

    /**
     * @param array $cards
     */
    public function setCards($cards)
    {
        $this->cards = $cards;
    }

    /**
     * @return array
     */
    public function getCards()
    {
        return $this->cards;
    }


}