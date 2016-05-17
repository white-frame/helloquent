<?php
namespace WhiteFrame\Helloquent;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Traits\Macroable;
use WhiteFrame\Helloquent\Exceptions\EntityNotSpecifiedException;
use WhiteFrame\Statistics\Statistics;

/**
 * Class Repository
 */
class Repository
{
	use Macroable;

	protected $entity;

	/**
	 * Create a new instance of the managed entity
	 *
	 * @return Model
	 */
	protected function make($with = [])
	{
		$entity = $this->getModel();

		if(count($with) > 0)
			$entity = $entity->with($with);

		return $entity;
	}

	/**
	 * @return Model
	 */
	public function getModel()
	{
		if(empty($this->entity))
			throw new EntityNotSpecifiedException("No valid entity found for repository " . get_class($this) . '. Please specify a valid $entity property.');

		$entity = $this->entity;

		return new $entity();
	}

	/**
	 * Return all availables objects
	 *
	 * @param array $with
	 *
	 * @return Builder
	 */
	public function all(array $with = [])
	{
		return $this->make($with);
	}

	/**
	 * Find an entity by id
	 *
	 * @param int $id
	 * @param array $with
	 *
	 * @return \Illuminate\Database\Eloquent\Model|null
	 */
	public function getById($id, array $with = [])
	{
		$query = $this->make($with);

		return $query->find($id);
	}

	/**
	 * Find a single entity by key value
	 *
	 * @param string $key
	 * @param string $value
	 * @param array $with
	 *
	 * @return \Illuminate\Database\Eloquent\Model|null
	 */
	public function getFirstBy($key, $value, array $with = [])
	{
		return $this->make($with)->where($key, '=', $value)->first();
	}

	/**
	 * @param $key
	 * @param $value
	 * @param array $with
	 *
	 * @return \Illuminate\Database\Eloquent\Model
	 */
	public function getFirstOrNewBy($key, $value, array $with = [])
	{
		return $this->make($with)->firstOrNew([$key => $value]);
	}

	/**
	 * Find many entities by key value
	 *
	 * @param string $key
	 * @param string $value
	 * @param array $with
	 *
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function getManyBy($key, $value, array $with = [])
	{
		return $this->make($with)->where($key, '=', $value)->get();
	}

	/**
	 * Return all results that have a required relationship
	 *
	 * @param string $relation
	 * @param array $with
	 *
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function has($relation, $with = [])
	{
		return $this->make($with)->has($relation)->get();
	}

	/**
	 * Get Results by Page
	 *
	 * @param int $page
	 * @param int $limit
	 * @param array $with
	 *
	 * @return \StdClass
	 */
	public function getByPage($page = 1, $limit = 10, $with = [])
	{
		$result = new \StdClass;
		$result->page = $page;
		$result->limit = $limit;
		$result->totalItems = 0;
		$result->items = [];

		$model = $this->make($with)->skip($limit * ($page - 1))->take($limit)->get();

		$result->totalItems = $this->make()->count();
		$result->items = $model->all();

		return $result;
	}

	/**
	 * @param $query
	 *
	 * @return mixed
	 */
	public function scopeTrashed($query)
	{
		return $query->onlyTrashed();
	}

	/**
	 * @return mixed
	 */
	public function create($attributes = [])
	{
		// Filtering attributes
		$attributes = $this->filterAttributes($attributes);

		return $this->getModel()->create($attributes);
	}

	/**
	 * @param $id
	 * @param array $attributes
	 * @return \Illuminate\Database\Eloquent\Model|null
	 */
	public function update($id, $attributes = [])
	{
		// Filtering attributes
		$attributes = $this->filterAttributes($attributes);

		// Search for entity
		$entity = $this->getById($id);

		// Update entity
		foreach($attributes as $name => $value) {
			$entity->$name = $value;
		}

		// Save entity modifications
		$entity->save();

		return $entity;
	}

	/**
	 * @param $attributes
	 *
	 * @return array
	 */
	public function filterAttributes($attributes)
	{
		$columns = $this->getModel()->getColumns();
		$filtered = [];

		foreach($attributes as $name => $value) {
			if(!starts_with($name, '_') AND in_array($name, $columns)) {

				// Check for empty value and nullable allowed
				if(empty($value) AND $this->getModel()->isNullableColumn($name)) $filtered[$name] = null;
				else
					$filtered[$name] = $value;
			}
		}

		return $filtered;
	}

	/**
	 * @param $query
	 * @param $term
	 * @return Builder
	 */
	public function scopeSearch(Builder $query, $term)
	{
		if(!empty($term)) {
			foreach($this->getModel()->getColumns() as $column) {
				$query->where($column, 'LIKE', '%' . $term . '%');
			}
		}

		return $query;
	}

	/**
	 * Get the macroable macro
	 *
	 * @param $name
	 * @return Callable
	 */
	public static function getMacro($name)
	{
		return static::$macros[$name];
	}

	/**
	 * @return mixed
	 */
	public function getScopes()
	{
		return array_filter(array_merge(get_class_methods($this), array_keys(self::$macros)), function($var) {
			return starts_with($var, 'scope');
		});
	}
}
