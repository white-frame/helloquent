<?php namespace WhiteFrame\Helloquent\Model;

use WhiteFrame\Helloquent\Exceptions\RepositoryNotSpecifiedException;
use WhiteFrame\Helloquent\Repository;

/**
 * Trait HasRepository
 * @package WhiteFrame\Helloquent\Model
 */
trait HasRepository
{
	/**
	 * View repository instance
	 *
	 * @var mixed
	 */
	protected $repositoryInstance;

	/**
	 * Check if the Model has a valid repository
	 *
	 * @return bool
	 */
	public function hasRepository()
	{
		return !empty($this->repository) AND class_exists($this->repository);
	}

	public static function repository()
	{
		$class = get_called_class();
		$entity = new $class();
		return $entity->getRepository();
	}

	/**
	 * Instanciate a new Repository for this Model.
	 *
	 * @return Repository
	 * @throws RepositoryNotSpecifiedException
	 */
	public function getRepository()
	{
		if($this->hasRepository()) {
			throw new RepositoryNotSpecifiedException('Could get repository of ' . get_class($this) . '. Please fill $repository property.');
		}

		return app($this->repository);
	}
}