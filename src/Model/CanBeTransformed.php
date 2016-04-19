<?php namespace WhiteFrame\Helloquent\Model;

use WhiteFrame\Helloquent\Exceptions\TransformerNotSpecifiedException;
use WhiteFrame\Helloquent\Transformer;

/**
 * Trait CanBeTransformed
 * @package WhiteFrame\Helloquent\Model
 */
trait CanBeTransformed
{
	/**
	 * Check if the Model has a valid transformer
	 *
	 * @return bool
	 */
	public function hasTransformer()
	{
		return !empty($this->transformer) AND class_exists($this->transformer);
	}

	/**
	 * Instanciate a new Transformer for this Model.
	 *
	 * @return Transformer
	 * @throws TransformerNotSpecifiedException
	 */
	public function transformer()
	{
		if(!$this->hasTransformer()) {
			throw new TransformerNotSpecifiedException('Could get transformer of ' . get_class($this) . '. Please fill $transformer property.');
		}

		return new $this->transformer();
	}
}