<?php namespace WhiteFrame\Helloquent;

/**
 * Class Transformer
 * @package WhiteFrame\Helloquent
 */
class Transformer extends \League\Fractal\TransformerAbstract
{
	public function transform(Model $model)
	{
		$attributes = $model->toArray();

		$presented = [];
		foreach ($model->getColumns() as $name) {
			$presented[$name] = $model->present()->$name;
		}
		$attributes['present'] = $presented;

		return $attributes;
	}
}