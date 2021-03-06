<?php

namespace GiveFormFieldManager\Infrastructure;


use BadMethodCallException;
use ReflectionClass;
use ReflectionException;
use UnexpectedValueException;
use function array_search;
use function get_called_class;

/**
 * Base Enum class
 *
 * Create an enum by implementing this class and adding class constants.
 *
 * @since 2.0.0
 * @credit myclabs/php-enum
 */
abstract class Enum implements \JsonSerializable {
	/**
	 * Enum value
	 *
	 * @var mixed
	 */
	protected $value;

	/**
	 * Store existing constants in a static cache per object.
	 *
	 * @var array
	 */
	protected static $cache = [];

	/**
	 * Creates a new value of some type
	 *
	 * @param mixed $value
	 *
	 * @throws UnexpectedValueException|ReflectionException if incompatible type is given.
	 */
	public function __construct( $value ) {
		if ( $value instanceof static ) {
			$this->value = $value->getValue();

			return;
		}

		if ( ! $this->isValid( $value ) ) {
			throw new UnexpectedValueException( "Value '$value' is not part of the enum " . get_called_class() );
		}

		$this->value = $value;
	}

	/**
	 * @return mixed
	 */
	public function getValue() {
		return $this->value;
	}

	/**
	 * Returns the enum key (i.e. the constant name).
	 *
	 * @return false|int|string
	 * @throws ReflectionException
	 */
	public function getKey() {
		return static::search( $this->value );
	}

	/**
	 * @return string
	 */
	public function __toString() {
		return (string) $this->value;
	}

	/**
	 * Compares one Enum with another.
	 *
	 * This method is final, for more information read https://github.com/myclabs/php-enum/issues/4
	 *
	 * @return bool True if Enums are equal, false if not equal
	 */
	final public function equals( Enum $enum = null ) {
		return $enum !== null && $this->getValue() === $enum->getValue() && get_called_class() === \get_class( $enum );
	}

	/**
	 * Returns the names (keys) of all constants in the Enum class
	 *
	 * @return array
	 * @throws ReflectionException
	 */
	public static function keys() {
		return \array_keys( static::toArray() );
	}

	/**
	 * Returns instances of the Enum class of all Enum constants
	 *
	 * @return static[] Constant name in key, Enum instance in value
	 * @throws ReflectionException
	 */
	public static function values() {
		$values = array();

		foreach ( static::toArray() as $key => $value ) {
			$values[ $key ] = new static( $value );
		}

		return $values;
	}

	/**
	 * Returns all possible values as an array
	 *
	 * @return array Constant name in key, constant value in value
	 * @throws ReflectionException
	 */
	public static function toArray() {
		$class = get_called_class();
		if ( ! isset( static::$cache[ $class ] ) ) {
			$reflection              = new ReflectionClass( $class );
			static::$cache[ $class ] = $reflection->getConstants();
		}

		return static::$cache[ $class ];
	}

	/**
	 * Check if is valid enum value
	 *
	 * @param $value
	 *
	 * @return bool
	 * @throws ReflectionException
	 */
	public static function isValid( $value ) {
		return \in_array( $value, static::toArray(), true );
	}

	/**
	 * Check if is valid enum key
	 *
	 * @param $key
	 *
	 * @return bool
	 * @throws ReflectionException
	 */
	public static function isValidKey( $key ) {
		$array = static::toArray();

		return isset( $array[ $key ] ) || \array_key_exists( $key, $array );
	}

	/**
	 * Return key for value
	 *
	 * @param $value
	 *
	 * @return false|int|string
	 * @throws ReflectionException
	 */
	public static function search( $value ) {
		return array_search( $value, static::toArray(), true );
	}

	/**
	 * Returns a value when called statically like so: MyEnum::SOME_VALUE() given SOME_VALUE is a class constant
	 *
	 * @param string $name
	 * @param array $arguments
	 *
	 * @return static
	 * @throws BadMethodCallException|ReflectionException
	 */
	public static function __callStatic( $name, $arguments ) {
		$array = static::toArray();
		if ( isset( $array[ $name ] ) || \array_key_exists( $name, $array ) ) {
			return new static( $array[ $name ] );
		}

		throw new BadMethodCallException( "No static method or enum constant '$name' in class " . get_called_class() );
	}

	/**
	 * Specify data which should be serialized to JSON. This method returns data that can be serialized by json_encode()
	 * natively.
	 *
	 * @return mixed
	 * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
	 */
	public function jsonSerialize() {
		return $this->getValue();
	}
}

