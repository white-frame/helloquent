<?php
namespace WhiteFrame\Helloquent;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Laracasts\Presenter\PresentableTrait;
use WhiteFrame\Helloquent\Traits\RepositoryScopeAbstractionTrait;

/**
 * Class Model
 * @package B2B\Core\Database\Eloquent
 */
class Model extends \Illuminate\Database\Eloquent\Model
{
	use PresentableTrait;
	use RepositoryScopeAbstractionTrait;

	protected $table;
	protected $viewPath;
	protected $endpoint;
	protected $presenter;
	protected $repository;

	protected $guarded = ['id'];

	/**
	 * @return string
	 */
	public function getViewPath()
	{
		return $this->viewPath;
	}

	/**
	 * @return string
	 */
	public function getEndpoint()
	{
		return $this->endpoint;
	}

	/**
	 * @param bool $tablePrefix
	 *
	 * @return array
	 */
	public function getColumns($tablePrefix = false)
	{
		$columns = Schema::getColumnListing($this->getTable());

		if($tablePrefix) {
			foreach($columns as $key => $column) {
				$columns[$key] = $this->getTable() . '.' . $column;
			}
		}

		return $columns;
	}

	/**
	 * @param $column
	 *
	 * @return bool
	 */
	public function isNullableColumn($column)
	{
		// Remove table prefix
		if(str_contains($column, '.'))
			list(, $column) = explode('.', $column);

		foreach(DB::select('SHOW COLUMNS FROM ' . $this->getTable()) as $infos) {
			$infos = (array)$infos;
			if($infos['Field'] == $column AND $infos['Null'] == 'YES')
				return true;
		}

		return false;
	}
}