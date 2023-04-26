<?php

function cost_to_float($pennies) {
    return number_format($pennies / 100, 2);
}
?>