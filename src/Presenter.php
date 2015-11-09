<?php
namespace WhiteFrame\Helloquent;

/**
 * Class Presenter
 * @package B2B\Core\Presenter
 */
class Presenter extends \Laracasts\Presenter\Presenter
{
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
			<a href="' . url($this->entity->getEndpoint() . '/' . $this->entity->id) . '" data-toggle="tooltip" title="See details"><span class="badge bg-light-blue"><i class="fa fa-search"></i></span></a>
			<a href="' . url($this->entity->getEndpoint() . '/' . $this->entity->id) . '/edit" data-toggle="tooltip" title="Edit"><span class="badge bg-yellow"><i class="fa fa-pencil"></i></span></a>
			<a href="' . url($this->entity->getEndpoint() . '/' . $this->entity->id) . '/edit"
				data-method="delete"
				data-toggle="confirmation"
				data-confirm-placement="left"
				data-toggle="tooltip"
				title="Delete">
				<span class="badge bg-red"><i class="fa fa-times"></i></span>
			</a>
		';
	}
}