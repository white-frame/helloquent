<?php
namespace WhiteFrame\Helloquent;

use WhiteFrame\Helloquent\Model\CanBeRendered;

/**
 * Class Renderer
 * @package WhiteFrame\Helloquent
 */
class Renderer
{
	/**
	 * @var Model
	 */
	protected $entity;

	/**
	 * @var string
	 */
	protected $path;

	/**
	 * @param $entity
	 * @param $path
	 */
	function __construct($entity, $path)
	{
		$this->path = $path;
		$this->entity = $entity;
	}

	/**
	 * @param array $bind
	 * @return mixed
	 */
	public function index($bind = [])
	{
		return view();
	}

	/**
	 * @param array $bind
	 * @return mixed
	 */
	public function show($bind = [])
	{
		return view();
	}

	/**
	 * @param array $bind
	 * @return mixed
	 */
	public function edit($bind = [])
	{
		return view();
	}
}