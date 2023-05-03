<?php

function cost_to_float($pennies) {
    return number_format((int)$pennies / 100, 2);
}
?>