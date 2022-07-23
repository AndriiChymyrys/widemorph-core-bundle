## EntityResolver

### Purpose
Fetch entity repository in bundles. After config all repositories and entities will be copied to `/src` folder, and you can not
refer to entity repository from another bundle directly.

To get correct entity repository you need to create `EntityResolver` for specific bundle and attach entities which you want to use.

For create `EntityResolver` there is `EntityResolverFactory`

```php
$entityResolverFactory
    ->forBundle(ImsProductBundle::class)
    ->attachEntity('Product')
    ->get();
```

In `forBundle` method you need to pass bundle namespace, and in `attachEntity` you need to pass entity name

> entity name should be relative `Infrastructure/Entity` folder if bundle have subfolders then entity name should be
> specified with subfolder name like `attachEntity('Subfolder/Product')`
