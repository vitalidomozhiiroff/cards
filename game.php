<?php

include 'Card.php';
include 'JokerCard.php';
include 'StandardCard.php';
include 'Pack.php';

/*
 * Game emulation - Pick as many pairs as you can find
 *
 */

// So, lets have a pack randomly ordered with 54 cards
$pack = new Pack();

//Decent players will remember the value of previously-seen unmatched cards
// Lets do an array for this to emulate which has a marks that is actually an 'emulated/imagined' position of card that player has in his head and visually imagine
$marks = array();

//If the two cards are equivalent, they can be removed and placed in the bank.
// This is our bank for cards :)
$bank = array();

print '<b>trace: </b><br>';

$e = 0;

//Next we play hard until bank is full
while (count($bank) != 54) {


    // pick two cards with visual marks and randomly
    $first = null;
    while ($first == null) {
        $first_pos = rand(0, 53);
        $first = $pack->pickCard($first_pos);
    }



    // Maybe we can remember where was the same value
    $found = false;

    for ($i = 0; $i < 54; $i++) {
        if (!isset($marks[$i]) || ($first_pos == $i)) {
            continue;
        }
        $mark = $marks[$i];

        if ($mark != null) {
            if ($mark->equals($first)) {
                $found = true;
                $second = $pack->pickCard($i);
                $second_pos = $i;
                break;
            }
        }
    }


/*    foreach ($marks as $key => $value) {
        if ($value != null) {
            if ($value->equals($first)) {
                // got it!
                // it means we know the that in this position was the same

                $found = true;
                $second = $pack->pickCard($key);
                break;
            }
        }
    }*/

    // if we do not track where is the same we pick another
    if (!$found) {
        $second = null;
        while ($second == null) {
            $second_pos = rand(0, 53);
            $second = $pack->pickCard($second_pos);
        }
    }

/*    if ($second == null) {
        $second = $pack->pickCard($key);
    }

    if ($first == null) {
        $second = $pack->pickCard($key);
    }*/

    // compare if they are equal
    if ($first->equals($second)) {
        // if yes then place them to the bank both
        $bank[] = $first;
        $marks[$first_pos] = null;
        print "<div style='color:yellow'>+ [$first_pos] " . $first->toString() . "</div><br>";

        $bank[] = $second;
        $marks[$second_pos] = null;
        print "<div style='color:yellow'>+ [$second_pos] " . $second->toString() . "</div><br>";
    } else {
        // if not put them back but
        //  Decent players will remember the value of previously-seen unmatched cards - so if the player picks a 7 and a 9, they won't match - but later, when he/she picks a new pair and the first card is a 7,
        // he/she will remember that another 7 has been seen in a different location, and pick that to form a matching pair.
        // So we need to keep 'in mind'

        // put 'in mind'
        $marks[$first_pos] = $first;
        $marks[$second_pos] = $second;

        $pack->putBackCard($first, $first_pos);
        $pack->putBackCard($second, $second_pos);
    }

    $e++;

    if ($e >= 100) {
        print 'not all, but exceded 100 steps<br>';
        print 'The dump of bank is';
        var_dump($bank);

        print 'And the pack' . $pack->getCards();
        var_dump($bank);
        exit();
    }

}

echo 'Everything found and seems works! :)';


