<?php
namespace WhiteFrame\Helloquent;

/**
 * Class Presenter
 * @package WhiteFrame\Helloquent
 */
abstract class Presenter
{
	/**
	 * @var mixed
	 */
	protected $entity;

	/**
	 * @param $entity
	 */
	function __construct($entity)
	{
		$this->entity = $entity;
	}

	/**
	 * Allow for property-style retrieval
	 *
	 * @param $property
	 * @return mixed
	 */
	public function __get($property)
	{
		if (method_exists($this, $property))
		{
			return $this->{$property}();
		}

		return $this->entity->{$property};
	}

	/**
	 * @return array
	 */
	public function columns()
	{
		return array_merge(array_combine($this->entity->getColumns(), $this->entity->getColumns()), [
			'actions' => 'Actions'
		]);
	}

	/**
	 * @return array
	 */
	public function searches()
	{
		return [

		];
	}

	/**
	 * @return string
	 */
	public function actions()
	{
		return '
			<a href="' . url($this->entity->getEndpoint() . '/' . $this->entity->id) . '" data-toggle="tooltip" title="' . trans('helloquent::ui.button.show.tooltip') . '"><span class="badge bg-light-blue"><i class="fa fa-search"></i></span></a>
			<a href="' . url($this->entity->getEndpoint() . '/' . $this->entity->id) . '/edit" data-toggle="tooltip" title="' . trans('helloquent::ui.button.edit.tooltip') . '"><span class="badge bg-yellow"><i class="fa fa-pencil"></i></span></a>
			<a href="' . url($this->entity->getEndpoint() . '/' . $this->entity->id) . '/edit"
				data-method="delete"
				data-toggle="confirmation"
				data-confirm-content="' . trans('helloquent::ui.button.confirm.delete.content') . '"
				data-confirm-placement="left"
				data-toggle="tooltip"
				title="Delete">
				<span class="badge bg-red"><i class="fa fa-times"></i></span>
			</a>
		';
	}
}