Yii2 View Replacer
===========================

## Установка

```json
"mihaildev/yii2-view-replacer": "*"
```

## Использование

Допустим вы хотите использовать сторонний модуль пользователей, но админ часть вас не устраивает!
вы можете создать своё расширение которое просто добавит правильные замены шаблонов!

```php
class Bootstrap implements BootstrapInterface
{

    /**
     * Bootstrap method to be called during application bootstrap stage.
     * @param Application $app the application currently running
     */
    public function bootstrap($app)
    {
        ViewReplacer::replace('@app/some/path', '@app/to/path');
        ViewReplacer::replace([
            '@app/some/path' => '@app/to/path',
            '@app/some/path' => [
                '@app/to/path',
                '@app/to/path'
            ]
        ]);
    }
}
```