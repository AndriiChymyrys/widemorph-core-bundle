## DataSource

### Select
To create Select DataSource you need to implement `SelectDataSourceDefinitionInterface` interface.

You need to implement methods:

`getConstraint()` - it returns class which implement `ConstraintValidationRulesInterface`

`getSource()` - it returns class which implement `SelectDataSourceInterface`

`getSourcePagination(InputDataCollectionInterface)` - it will take one argument it's your input data, and it should return 
pagination array `[page, perPage]` or `null` is you don't need pagination

All call which implements `SelectDataSourceDefinitionInterface` will be added automatically to `DataSourceRegistry`, and 
you can execute your data source by using `SelectDataSourceService` class.

```php
    $outputData = $selectDataSourceService->execute(YourSelectDataSourceClass::class);
    $outputData->getSourceData();
```

Method `execute(string $sourceName, ?array $input = null)` can accept second parameter it is your input data for data source
if second parameter is omitted input data will be taken from request.
This method return `OutputDataInterface` witch data returned from your source class `getSource()`, also if there will be errors
in constraint validation this object will contain them.
