<?php
namespace WhiteFrame\Helloquent\Traits;

use Illuminate\Database\Eloquent\Builder;
use WhiteFrame\Helloquent\Repository;

/**
 * Trait RepositoryScopeAbstractionTrait
 * @package Six\Database\Eloquent
 */
trait RepositoryScopeAbstractionTrait
{
	/**
	 * Create a new Eloquent query builder for the model.
	 *
	 * @param  \Illuminate\Database\Query\Builder $query
	 * @return \Illuminate\Database\Eloquent\Builder|static
	 */
	public function newEloquentBuilder($query)
	{
		return new Builder($query);
	}

	/**
	 * @return Repository
	 */
	public function getRepository()
	{
		return app()->make($this->repository);
	}

	/**
	 * @param $repository
	 */
	public function setRepository(Repository $repository)
	{
		$this->repository = $repository;
	}
} 