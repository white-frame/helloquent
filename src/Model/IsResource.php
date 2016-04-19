<?php namespace WhiteFrame\Helloquent\Model;

use WhiteFrame\Helloquent\Exceptions\InvalidEndpointException;

/**
 * Trait IsResource
 * @package WhiteFrame\Helloquent\Model
 */
trait IsResource
{
	public function hasEndpoint()
	{
		return !empty($this->endpoint);
	}

	public function endpoint()
	{
		if(!$this->hasEndpoint()) {
			throw new InvalidEndpointException('Could get endpoint of ' . get_class($this) . '. Please fill $endpoint property.');
		}

		return $this->endpoint;
	}
}