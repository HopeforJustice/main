<?php
/**
 * @license MIT
 *
 * Modified by impress-org on 10-January-2024 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */

namespace Give\Vendors\Faker\Provider\nl_BE;

class Internet extends \Give\Vendors\Faker\Provider\Internet
{
    protected static $freeEmailDomain = ['gmail.com', 'hotmail.com', 'yahoo.com', 'advalvas.be'];
    protected static $tld = ['com', 'com', 'com', 'net', 'org', 'be', 'be', 'be'];
}
