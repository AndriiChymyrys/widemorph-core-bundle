## DataSource

### Select
To create SelectDataSource you need to implement `SelectDataSourceDefinitionInterface` interface.

You need to implement methods:

`getSource()` - Will return class which implement `SelectDataSourceInterface`

`getSourcePagination(InputDataCollectionInterface)` - it will take one argument it's your input data, and it should return 
pagination array `[page, perPage]` or `null` is you don't need pagination

```php
    $outputData = $selectDataSourceService->execute(YourSelectDataSourceClass::class);
    $outputData->getSourceData();
```

Method `execute(string $sourceName, ?array $input = null)`

> can accept second parameter it is your input data for data source if second parameter is omitted input data will be taken from request.

### Create
To create CreateDataSource you need to implement `CreateDataSourceDefinitionInterface` interface.

You need to implement:

* `getSource()` - Will return `CreateDataSourceInterface`

```php
    $outputData = $createDataSourceService->execute(YourCreateDataSourceClass::class);
    $outputData->getSourceData();
```

### Update
To create UpdateDataSource you need to implement `UpdateDataSourceDefinitionInterface` interface.

You need to implement:
* `getSource()` - Will return `UpdateDataSourceInterface`
* `getUpdateItem(array $data)` - Which return item or data which you want to update. This data will be passed to `UpdateDataSourceInterface::update(InputDataCollectionInterface $inputDataCollection, mixed $target)` as `$target` param

Method `execute(string $sourceName, ?array $input = null, ?array $options = [])`
Third parameter is $options which will be passed to `getUpdateItem` method
> can accept second parameter it is your input data for data source if second parameter is omitted input data will be taken from request.

```php
    $outputData = $updateDataSourceService->execute(YourUpdateDataSourceClass::class);
    $outputData->getSourceData();
```

### Delete
To create DeleteDataSource you need to implement `DeleteDataSourceDefinitionInterface` interface.

You need to implement:
* `getSource()` - Will return `DeleteDataSourceInterface`
* `getDeleteItem(array $data)` - Which return item or data which you want to delete. 
   This data will be passed to `DeleteDataSourceInterface::delete(InputDataCollectionInterface $inputDataCollection, mixed $target)` as `$target` param

```php
    $outputData = $deleteDataSourceService->execute(YourDeleteDataSourceClass::class);
    $outputData->getSourceData();
```

### OutputData
All `execute(...)` methods will return `OutputDataInterface` with data which you will return from your sources method `getSource()`.

### DataValidation
You can validate your input data with symfony constraints or form. 
To validate with constraints your DataSource should implement `ConstraintDataSourceDefinitionInterface`
* `getConstraint()` - which should return class which implement `ConstraintValidationRulesInterface`. You can extend
  abstract class `ConstraintValidationRule` which implement almost all methods from `ConstraintValidationRulesInterface`
  by default, or you can implement all methods from `ConstraintValidationRulesInterface` by yourself.
---
To validate with from your DataSource should implement `FormDataSourceDefinitionInterface`.
* `getForm()` - Will return symfony form type class name.
* `getFormOptions()` - Will return from options which will be passed to form builder. Return empty array if options in not needed.

> Form class should be registered in services with tag `form.type`

In case error validation happened you can check this and get errors from `OutputDataInterface` methods `hasErrors()` `getErrors()`
