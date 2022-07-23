## DataFilter

### Purpose
Make doctrine query overridable

Add `DoctrineDataFilterContext` which can be created by using factory `DoctrineDataFilterContextFactory`

Each condition in query should be written in separate file called strategy in implement `DoctrineDataFilterStrategyInterface`

### Overriding
Each context has `contextName` and before to execute the context event `DoctrineDataFilterEvent` will be fired.

You can listen to the event of specific context. Event name will be `doctrine.data.filter.$contextName`

In event object you can delete or override specific filter strategies also you can set result object in which
query will be passed after all strategies has applied, and you can leverage it.

### Result
Result object can be overridden in two-way through event see below, and result object can be passed directly in execute method
of `DoctrineDataFilterContextInterface` interface.

Default result class is `DoctrineDataFilterResult` from this class you can get simple result or paginated result.

For paginated result you need to set `$page`, `$perPage` through method `setPagination(int $page, int $perPage)`.
For paginated result under the hood we use `knplabs/knp-paginator-bundle`, so if you set paginated result method 
`getResult()` of class `DoctrineDataFilterResult` will return instance of `PaginationInterface` interface.
