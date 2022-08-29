## EntityResolver

### Purpose
Get entity namespace from `/src` project folder. 

To get correct entity repository you need to create `EntityResolver` for specific bundle and attach entities which you want to use.

For create `EntityResolver` there is `EntityResolverFactory`

```php
$entityResolver = $entityResolverFactory
    ->forBundle(ImsProductBundle::class)
    ->attachEntity('Product')
    ->get();
```

In `forBundle` method you need to pass bundle namespace, and in `attachEntity` you need to pass entity name

> entity name should be relative to `Infrastructure/Entity` folder if bundle have subfolders then entity name should be
> specified with subfolder name like `attachEntity('Subfolder/Product')`

### Get Entity Name
```php
$entityName = $entityResolver->getEntityName('Product');
```
### Get Entity Repository
```php
$entityRepository = $entityResolver->getEntityRepository('Product');
```
