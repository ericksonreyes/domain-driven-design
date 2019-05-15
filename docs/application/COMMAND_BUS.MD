# Command Bus

## Initialization
```php
$bus = new EricksonReyes\DomainDrivenDesign\Application\CommandBus();
```

## Adding command handlers
```php
$customerRepository = new CustomerRepository();

$createCustomerHandler = new CreateCustomerHandler($customerRepository);
$renameCustomerHandler = new RenameCustomerHandler($customerRepository);
$deleteCustomerHandler = new DeleteCustomerHandler($customerRepository);

$bus->addHandler($createCustomerHandler, CreateCustomer::class);
$bus->addHandler($renameCustomerHandler, RenameCustomer::class);
$bus->addHandler($deleteCustomerHandler, DeleteCustomer::class);
```

## Executing commands
```php
# Creating a customer.
$createCustomer = new CreateCustomer('1', 'John Doe');
$bus->execute($createCustomer);

# Renaming a customer.
$renameCustomer = new RenameCustomer('1', 'Jane Doe');
$bus->execute($renameCustomer);

# Deleting a customer.
$deleteCustomer = new DeleteCustomer('1');
$bus->execute($deleteCustomer);
```