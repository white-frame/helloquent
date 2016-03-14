<?php
namespace WhiteFrame\Helloquent\Builder;

/**
 * Class Builder
 * @package WhiteFrame\Helloquent\Builder
 */
class Builder extends \Illuminate\Database\Eloquent\Builder
{
	/**
	 * When a method is not found, try to search if this method
	 * is a scope of Helloquent given models.
	 *
	 * @param  string $method
	 * @param  array $parameters
	 * @return mixed
	 */
	public function __call($method, $parameters)
	{
		$models = \WhiteFrame\Helloquent::get_classes($this->model);

		foreach($models as $model) { 
			foreach($model as $submodel) {
				if(method_exists($submodel, $scope = $this->method_name_to_scope($method))) {
					array_unshift($parameters, $this);
					return call_user_func_array([$submodel, $scope], $parameters) ?: $this;
				}	
			}
		}

		return parent::__call($method, $parameters);
	}

	public function method_name_to_scope($method)
	{
		return 'scope' . ucfirst(strtolower($method));
	}
} 