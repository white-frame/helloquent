<?php namespace WhiteFrame\Helloquent\Model;

use WhiteFrame\Helloquent\Exceptions\InvalidControllerException;

/**
 * Trait IsResource
 * @package WhiteFrame\Helloquent\Model
 */
trait IsResource
{
	/**
	 * Check if the Model gave a valid controller
	 *
	 * @return bool
	 */
	public function hasController()
	{
		return !empty($this->controller) AND class_exists($this->controller);
	}

	/**
	 * Get the controller linked from
	 *
	 * @return mixed
	 * @throws InvalidControllerException
	 */
	public function controller()
	{
		if(!$this->hasController()) {
			throw new InvalidControllerException('Could get controller of ' . get_class($this) . '. Please fill $controller property.');
		}

		return app()->make($this->controller);
	}
}