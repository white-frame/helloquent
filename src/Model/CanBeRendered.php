<?php namespace WhiteFrame\Helloquent\Model;

use WhiteFrame\Helloquent\Exceptions\InvalidViewPathException;
use WhiteFrame\Helloquent\Renderer;

/**
 * Trait CanBeRendered
 * @package WhiteFrame\Helloquent\Model
 */
trait CanBeRendered
{
	/**
	 * View renderer instance
	 *
	 * @var mixed
	 */
	protected $rendererInstance;

	/**
	 * Check if the Model has a valid path
	 *
	 * @return bool
	 */
	public function hasRenderer()
	{
		return !empty($this->renderer) AND class_exists($this->renderer);
	}

	/**
	 * Instanciate a new Renderer for this Model or get the previously cached one.
	 *
	 * @return Renderer
	 * @throws InvalidViewPathException
	 */
	protected function getRenderer()
	{
		if($this->hasRenderer()) {
			if(!$this->rendererInstance) {
				$this->rendererInstance = new $this->renderer($this);
			}

			return $this->rendererInstance;
		}
		else {
			throw new InvalidViewPathException('Could get renderer for ' . get_class($this) . '. Please fill $renderer property.');
		}
	}

	/**
	 * Get the Model Renderer.
	 *
	 * @return Renderer
	 */
	public function render()
	{
		return $this->getRenderer();
	}
}