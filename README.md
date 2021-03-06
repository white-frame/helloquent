# Helloquent

Set of tools and behaviour for eloquent models.

## Usage

For the complete usage of the package extends `WhiteFrame\Helloquent\Model`.

```php
use WhiteFrame\Helloquent\Model;

class User extends Model {
    protected $presenter = 'App\Presenters\UserPresenter';
    protected $transformer = 'App\Transformers\UserTransformer';
    protected $repository = 'App\Repositories\UserRepository';
    protected $controller = 'App\Http\Controllers\UserController';
    
    // Your stuff here ...
}
```

## Model Objects

#### [Presenter](https://github.com/white-frame/helloquent/wiki/Presenter)

Present your eloquent datas for your views using a flexible presenter.

#### [Transformer](https://github.com/white-frame/helloquent/wiki/Transformer)

Transform your models to powerfull arrays in your API.

#### [Repository](https://github.com/white-frame/helloquent/wiki/Repository)

Eloquent compatible repository pattern implementation for your application.

#### [IsResource](https://github.com/white-frame/helloquent/wiki/IsResource)

Bind controller access to your Model.

## More stuff

#### [Helpers](https://github.com/white-frame/helloquent/wiki/Helpers)

Some helpers built for the package.
