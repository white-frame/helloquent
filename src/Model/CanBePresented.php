<?php namespace WhiteFrame\Helloquent\Model;

use WhiteFrame\Helloquent\Exceptions\PresenterNotSpecifiedException;
use WhiteFrame\Helloquent\Presenter;

/**
 * Trait CanBePresented
 * @package WhiteFrame\Helloquent\Model
 */
trait CanBePresented
{
	/**
	 * View presenter instance
	 *
	 * @var mixed
	 */
	protected $presenterInstance;

	/**
	 * Check if the Model has a valid presenter
	 *
	 * @return bool
	 */
	public function hasPresenter()
	{
		return !empty($this->presenter) AND class_exists($this->presenter);
	}

	/**
	 * Instanciate a new Presenter for this Model or get the previously cached one.
	 *
	 * @return Presenter
	 * @throws PresenterNotSpecifiedException
	 */
	protected function getPresenter()
	{
		if($this->hasPresenter()) {
			if(!$this->presenterInstance) {
				$this->presenterInstance = new $this->presenter($this);
			}

			return $this->presenterInstance;
		}
		else {
			throw new PresenterNotSpecifiedException('Could get presenter of ' . get_class($this) . '. Please fill $presenter property.');
		}
	}

	/**
	 * Get the Model Presenter.
	 *
	 * @return Presenter
	 */
	public function present()
	{
		return $this->getPresenter();
	}
}