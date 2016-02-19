<?php
/**
 * Schema Config file with test data for the unit tests.
 *
 * @package   BrightNucleus\Config
 * @author    Alain Schlesser <alain.schlesser@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.brightnucleus.com/
 * @copyright 2016 Alain Schlesser, Bright Nucleus
 */

namespace BrightNucleus\Core;

$test_schema = [

    'random_string'    => [
        '__default'  => 'default_test_value',
        '__required' => true,
    ],
    'positive_integer' => [
        '__default'  => 99,
        '__required' => 'TRUE',
    ],
    'negative_integer' => [
        '__required' => 'Yes',
    ],
    'positive_boolean' => [
        '__default'  => true,
        '__required' => false,
    ],
    'negative_boolean' => [
        '__required' => 'No',
    ],
    'nested'           => [
        '__required' => 'Yes',
        'level2'   => [
            '__required' => true,
            'level3'   => [
                '__required' => 'TRUE',
            ],
        ],
    ],

];

return $test_schema;
