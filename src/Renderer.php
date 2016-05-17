<?php
namespace WhiteFrame\Helloquent;

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
	function __construct($entity)
	{
		$this->entity = $entity;
	}

	/**
	 * @param array $bind
	 * @return mixed
	 */
	public function index($bind = [])
	{
		return view($this->path . '.index', $bind);
	}

	/**
	 * @param array $bind
	 * @return mixed
	 */
	public function show($bind = [])
	{
		return view($this->path . '.show', array_merge($bind, [
			'entity' => $this->entity
		]));
	}

	/**
	 * @param array $bind
	 * @return mixed
	 */
	public function create($bind = [])
	{
		return view($this->path . '.create', array_merge($bind, [
			'entity' => $this->entity
		]));
	}

	/**
	 * @param array $bind
	 * @return mixed
	 */
	public function edit($bind = [])
	{
		return view($this->path . '.edit', array_merge($bind, [
			'entity' => $this->entity
		]));
	}
}