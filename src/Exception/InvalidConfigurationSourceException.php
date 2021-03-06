<?php
/**
 * Bright Nucleus Config Component.
 *
 * @package   BrightNucleus\Config
 * @author    Alain Schlesser <alain.schlesser@gmail.com>
 * @license   MIT
 * @link      http://www.brightnucleus.com/
 * @copyright 2016 Alain Schlesser, Bright Nucleus
 */

namespace BrightNucleus\Config\Exception;

use BrightNucleus\Exception\InvalidArgumentException;

/**
 * Class InvalidConfigurationSourceException.
 *
 * @since   0.4.0
 *
 * @package BrightNucleus\Config\Exception
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
class InvalidConfigurationSourceException extends InvalidArgumentException implements ConfigException
{

}
