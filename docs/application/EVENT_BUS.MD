# Event Bus

## Initialization
```php
$bus = new EricksonReyes\DomainDrivenDesign\Application\EventBus();
```

## Adding event handlers
Event handlers must implement the [event handler](../src/EricksonReyes/DomainDrivenDesign/Infrastructure/EventHandler.php) interface.
```php
$customerRepository = new CustomerRepository();

$newCustomerProjector = new AddNewCustomerToDatabase();
$newCustomerManagementNotifier = new NotifyManagementAboutNewCustomers();

$renamedCustomerProjector = new RenameCustomerInDatabase();
$customerWasDeletedEventHandler = new RemoveCustomerFromDatabase();
$removedCustomerManagementNotifier = new NotifyManagementAboutCustomerRemoval();

$bus->register($newCustomerProjector);
$bus->register($newCustomerManagementNotifier);
$bus->register($renamedCustomerProjector);
$bus->register($customerWasDeletedEventHandler);
$bus->register($removedCustomerManagementNotifier);
```

## Adding an optional exception handler
The event bus normally ignores exceptions thrown by the event handlers. 
This is to make the event bus proceed with other event handlers that are interested in the raised event.

You can register one or many exception handlers for logging or reporting.
Exception handlers must implement the [exception handler](../src/EricksonReyes/DomainDrivenDesign/Infrastructure/ExceptionHandler.php) interface.
```php
$bus->registerExceptionHandler(new FileSystemWritingExceptionLogger());
$bus->registerExceptionHandler(new SentryReportingExceptionLogger());
$bus->registerExceptionHandler(new BugzillaReportingExceptionLogger());
```

## Dispatching events
```php
# Customer was created.
$bus->dispatch(new CustomerWasCreatedEvent());

# Customer was renamed.
$bus->dispatch(new CustomerWasRenamedEvent());

# Customer was deleted.
$bus->dispatch(new CustomerWasDeletedEvent());
```