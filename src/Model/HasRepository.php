<?php namespace WhiteFrame\Helloquent\Model;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use WhiteFrame\Helloquent\Exceptions\RepositoryNotSpecifiedException;
use WhiteFrame\Helloquent\Repository;

/**
 * Trait HasRepository
 * @package WhiteFrame\Helloquent\Model
 */
trait HasRepository
{
	/**
	 * View repository instance
	 *
	 * @var mixed
	 */
	protected $repositoryInstance;

	/**
	 * Check if the Model has a valid repository
	 *
	 * @return bool
	 */
	public function hasRepository()
	{
		return !empty($this->repository) AND class_exists($this->repository);
	}

	/**
	 * Instanciate a new Repository for this Model.
	 *
	 * @return Repository
	 * @throws RepositoryNotSpecifiedException
	 */
	public function getRepository()
	{
		if(!$this->hasRepository()) {
			throw new RepositoryNotSpecifiedException('Could get repository of ' . get_class($this) . '. Please fill $repository property.');
		}

		return app($this->repository);
	}

	/**
	 * Statically get the model repository
	 *
	 * @return mixed
	 */
	public static function repository()
	{
		$class = get_called_class();
		$entity = new $class();
		return $entity->getRepository();
	}

	/**
	 * Create a new Eloquent query builder for the model.
	 *
	 * @param  \Illuminate\Database\Query\Builder $query
	 * @return \Illuminate\Database\Eloquent\Builder|static
	 */
	public function newEloquentBuilder($query)
	{
		$builder = new Builder($query);

		// Registering repository scopes
		if($this->hasRepository()) {
			$repository = $this->getRepository();

			foreach($repository->getScopes() as $method) {
				if(starts_with($method, 'scope')) {
					$scope = lcfirst(preg_replace('/scope/', '', $method, 1));

					$builder->macro($scope, function() use ($method, $repository) {
						if($repository::hasMacro($method) AND $repository::getMacro($method) instanceof Closure) {
							return call_user_func_array($repository::getMacro($method)->bindTo($repository, get_class($repository)), func_get_args());
						}
						else {
							return call_user_func_array([$repository, $method], func_get_args());
						}
					});
				}
			}
		}

		return $builder;
	}
}