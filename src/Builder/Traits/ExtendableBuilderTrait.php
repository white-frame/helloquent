<?php
namespace WhiteFrame\Helloquent\Builder\Traits;

use WhiteFrame\Helloquent\Builder\Builder;
use WhiteFrame\Helloquent\Repository;

/**
 * Trait ExtendableBuilderTrait
 * @package WhiteFrame\Helloquent\Traits
 */
trait ExtendableBuilderTrait
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
} 