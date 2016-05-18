# Helloquent

Set of tools and behaviour for eloquent models.

## Usage

For the complete usage of the package extends `WhiteFrame\Helloquent\Model`.

```php
use WhiteFrame\Helloquent\Model;

class User extends Model {
    protected $presenter = 'App\Presenters\UserPresenter';
    protected $renderer = 'App\Renderers\UserRenderer';
    protected $transformer = 'App\Transformers\UserTransformer';
    protected $repository = 'App\Repositories\UserRepository';
    protected $endpoint = 'users';
    
    // Your stuff here ...
}
```

## Included in the package

#### [Presenter](https://github.com/white-frame/helloquent/wiki/Presenter)

Present your eloquent datas for your views using a flexible presenter.

#### [Transformer](https://github.com/white-frame/helloquent/wiki/Transformer)

Transform your models to powerfull arrays in your API.

#### [Resource](https://github.com/white-frame/helloquent/wiki/Resource)

Bind your model into and URL automatically.

#### [Repository](https://github.com/white-frame/helloquent/wiki/Repository)

Eloquent compatible repository pattern implementation for your application.

#### [Helpers](https://github.com/white-frame/helloquent/wiki/Helpers)

Some helpers built for the package.
