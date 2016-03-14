<?php

namespace WhiteFrame\Helloquent\Builder;

class Manager
{
	public static $classes = [];

	/**
	 * @param  mixed $models
	 * @param  mixed $classes
	 * @return Void
	 */
	public static function add($models, $classes)
	{
		//Le premier paramètre supporte string et array.
		$models = (!is_array($models)) ? (array) $models : $models;

		//Le deuxième paramètre supporte string et array.
		$classes = (!is_array($classes)) ? (array) $classes : $classes;

		foreach($classes as $class) {
			$class = app()->make($class);
			foreach($models as $model) {
				$model = self::regexify($model);
				self::$classes[$model][get_class($class)] = $class;
			}
		}
	}

	/**
	 * @param  object $model
	 * @return Collection
	 */
	public static function get_classes($model)
	{
		$classes = [];

		foreach(self::$classes as $ckey => $class) {
			if(self::check($ckey, get_class($model))) {
				if(!is_array($class)) {
					$classes = array_add($classes, $ckey, $class); 
				} else {
					foreach($class as $scKey => $subClass) {
						$classes[$ckey][$scKey] = $subClass;			
					}
				}
			}	
		}
		return $classes;
	}

	/**
	 * @param  string $expression
	 * @return string
	 */
	private static function regexify($expression)
	{
		$expression = str_replace('\\', '\\\\', $expression);
        $expression = str_replace('*', '(.*)', $expression);
        
        return $expression;
	}

	/**
	 * @param  string $expression
	 * @param  string $checked
	 * @return bool
	 */
	private static function check($expression, $checked)
	{
		return (preg_match('#^' . $expression . '$#', $checked) == 1) ? true : false;
	}
}