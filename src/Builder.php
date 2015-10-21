<?php
namespace WhiteFrame\Helloquent;

/**
 * Class Builder
 * @package Six\Database\Eloquent
 */
class Builder extends \Illuminate\Database\Eloquent\Builder
{
	/**
	 * When a method is not found, try to search if this method
	 * is a scope from the repository linked to this Model.
	 *
	 * @param  string $method
	 * @param  array $parameters
	 * @return mixed
	 */
	public function __call($method, $parameters)
	{
		$repository = $this->getModel()->getRepository();

		if(method_exists($repository, $scope = 'scope' . ucfirst($method))) {
			array_unshift($parameters, $this);

			return call_user_func_array([$repository, $scope], $parameters) ?: $this;
		}

		return parent::__call($method, $parameters);
	}

	/**
	 * Get the model instance being queried.
	 *
	 * @return Model
	 */
	public function getModel()
	{
		return $this->model;
	}
} 