<?php
/**
 * Generic Config Schema Class.
 *
 * @package   BrightNucleus\Config
 * @author    Alain Schlesser <alain.schlesser@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.brightnucleus.com/
 * @copyright 2016 Alain Schlesser, Bright Nucleus
 */

namespace BrightNucleus\Config;

use BrightNucleus\Exception\InvalidArgumentException;

/**
 * Class ConfigSchema
 *
 * @since   0.1.0
 *
 * @package BrightNucleus\Config
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
class ConfigSchema extends AbstractConfigSchema
{

    /**
     * The key that is used in the schema to define a default value.
     */
    protected $default_key = '__default';
    /**
     * The key that is used in the schema to define a required value.
     */
    protected $required_key = '__required';

    /**
     * Instantiate a ConfigSchema object.
     *
     * @since 0.1.0
     *
     * @param ConfigInterface|array $schema       The schema to parse.
     * @param string|null           $required_key Key that is used to define a required value.
     * @param string|null           $default_key  Key that is used to define a default value.
     * @throws InvalidArgumentException
     */
    public function __construct($schema, $required_key = null, $default_key = null)
    {
        if ($schema instanceof ConfigInterface) {
            $schema = $schema->getArrayCopy();
        }

        if (! is_array($schema)) {
            throw new InvalidArgumentException(
                sprintf(
                    _('Invalid schema source: %1$s'),
                    print_r($schema, true)
                )
            );
        }

        if ($required_key) {
            $this->required_key = $required_key;
        }

        if ($default_key) {
            $this->default_key = $default_key;
        }

        array_walk($schema, [$this, 'parseSchema']);
    }

    /**
     * Parse a single provided schema entry.
     *
     * @since 0.1.0
     *
     * @param mixed  $elements The data associated with the key.
     * @param string $key  The key of the schema data.
     * @param
     */
    protected function parseSchema($elements, $key, $parent)
    {
        $this->parseDefined($key);

        if (! is_array($elements)) {
            return;
        }

        foreach ($elements as $element_key => $element_value) {
            switch ($element_key) {
                case $this->required_key:
                    $this->parseRequired(
                        $key,
                        $element_value
                    );
                    break;
                case $this->default_key:
                    $this->parseDefault(
                        $key,
                        $element_value
                    );
                    break;
                default:
                    if (is_array($element_value)) {
                        var_dump($element_value);
                        array_walk($element_value, [$this, 'parseSchema']);
                    }
            }
        }
    }

    /**
     * Parse the set of defined values.
     *
     * @since 0.1.0
     *
     * @param string $key The key of the schema data.
     */
    protected function parseDefined($key)
    {
        $this->defined[] = $key;
    }

    /**
     * Parse the set of required values.
     *
     * @since 0.1.0
     *
     * @param string $key  The key of the schema data.
     * @param mixed  $data The data associated with the key.
     */
    protected function parseRequired($key, $data)
    {
        if ($this->isTruthy($data)) {
            $this->required[] = $key;
        }
    }

    /**
     * Parse the set of default values.
     *
     * @since 0.1.0
     *
     * @param string $key  The key of the schema data.
     * @param mixed  $data The data associated with the key.
     */
    protected function parseDefault($key, $data)
    {
        $this->defaults[$key] = $data;
    }

    /**
     * Return a boolean true or false for an arbitrary set of data. Recognizes
     * several different string values that should be valued as true.
     *
     * @since 0.1.0
     *
     * @param mixed $data The data to evaluate.
     * @return bool
     */
    protected function isTruthy($data)
    {
        $truthy_values = [
            true,
            1,
            'true',
            'True',
            'TRUE',
            'y',
            'Y',
            'yes',
            'Yes',
            'YES',
            '√',
        ];

        return in_array($data, $truthy_values, true);
    }
}
