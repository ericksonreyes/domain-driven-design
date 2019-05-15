# Domain Driven Design Classes and Interfaces
A collection of Domain Driven Design inspired Classes and Interfaces.

[![Build Status](https://img.shields.io/travis/ericksonreyes/domain-driven-design.svg)](https://travis-ci.org/ericksonreyes/domain-driven-design)
[![Code Coverage](https://img.shields.io/coveralls/github/ericksonreyes/domain-driven-design.svg)](https://coveralls.io/github/ericksonreyes/domain-driven-design?branch=master)
[![License](https://img.shields.io/github/license/ericksonreyes/domain-driven-design.svg)](LICENSE.MD)
[![Packagist Version](https://img.shields.io/packagist/v/ericksonreyes/domain-driven-design.svg?ver=1)](https://packagist.org/packages/ericksonreyes/domain-driven-design)
[![Last Commit](https://img.shields.io/github/last-commit/ericksonreyes/domain-driven-design.svg)](https://github.com/ericksonreyes/domain-driven-design/commits/master)
[![Stable Version](https://img.shields.io/github/tag/ericksonreyes/domain-driven-design.svg?ver=1)](https://github.com/ericksonreyes/domain-driven-design/tags)
[![PHP Version](https://img.shields.io/packagist/php-v/ericksonreyes/domain-driven-design.svg)](https://github.com/ericksonreyes/domain-driven-design/tags)
[![Downloads](https://img.shields.io/github/downloads/ericksonreyes/domain-driven-design/total.svg)](https://github.com/ericksonreyes/domain-driven-design/tags)
[![Installations](https://img.shields.io/packagist/dm/ericksonreyes/domain-driven-design.svg)](https://packagist.org/packages/ericksonreyes/domain-driven-design)

## Installation
```bash
composer require ericksonreyes/domain-driven-design
```

## Usage
* [Command Bus](docs/application/COMMAND_BUS.MD)
* [Event Bus](docs/application/EVENT_BUS.MD)
* [Country Factory](docs/common/factory/COUNTRY_FACTORY.MD)
* [Class Composition Validator](docs/common/validation/CLASS_COMPOSITION_VALIDATOR.MD)

## Value Objects
* [Address](src/EricksonReyes/DomainDrivenDesign/Common/ValueObject/Address.php)
* [Country](src/EricksonReyes/DomainDrivenDesign/Common/ValueObject/Country.php)
* [Currency](src/EricksonReyes/DomainDrivenDesign/Common/ValueObject/Currency.php)
* [Email](src/EricksonReyes/DomainDrivenDesign/Common/ValueObject/Email.php)
* [Float](src/EricksonReyes/DomainDrivenDesign/Common/ValueObject/FloatValue.php)
* [Integer](src/EricksonReyes/DomainDrivenDesign/Common/ValueObject/IntegerValue.php)
* [Money](src/EricksonReyes/DomainDrivenDesign/Common/ValueObject/Address.php)
* [Person Name](src/EricksonReyes/DomainDrivenDesign/Common/ValueObject/PersonName.php)
* [String Value](src/EricksonReyes/DomainDrivenDesign/Common/ValueObject/StringValue.php)

## Examples
* [Domain Entity](src/EricksonReyes/DomainDrivenDesign/Example/Domain/DomainEntity.php)
* [Domain Event](src/EricksonReyes/DomainDrivenDesign/Example/Domain/DomainEntityWasDeletedEvent.php)
* [Event Sourced Domain Entity](src/EricksonReyes/DomainDrivenDesign/Example/Domain/EventSourcedDomainEntity.php)

## Interfaces
* [Command Bus](src/EricksonReyes/DomainDrivenDesign/Infrastructure/CommandBus.php)
* [Event Bus](src/EricksonReyes/DomainDrivenDesign/Infrastructure/EventBus.php)
* [Event Handler](src/EricksonReyes/DomainDrivenDesign/Infrastructure/EventHandler.php)
* [Event Publisher](src/EricksonReyes/DomainDrivenDesign/Infrastructure/EventPublisher.php)
* [Event Repository](src/EricksonReyes/DomainDrivenDesign/Infrastructure/EventRepository.php)
* [Exception Handler](src/EricksonReyes/DomainDrivenDesign/Infrastructure/ExceptionHandler.php)
* [Identity Generator](src/EricksonReyes/DomainDrivenDesign/Infrastructure/IdentityGenerator.php)

## Abstract Exceptions
* [AuthenticationFailureException](src/EricksonReyes/DomainDrivenDesign/Common/Exception/AuthenticationFailureException.php) - Authentication/Login failed.
* [PermissionDeniedException](src/EricksonReyes/DomainDrivenDesign/Common/Exception/PermissionDeniedException.php) - Authorization failed. No permission to access a record or execute a command.
* [RecordConflictException](src/EricksonReyes/DomainDrivenDesign/Common/Exception/RecordConflictException.php) - Saving an existing record or overwriting a record with state that has been changed.
* [DeletedRecordException](src/EricksonReyes/DomainDrivenDesign/Common/Exception/DeletedRecordException.php) - Accessing or deleting a record that has been deleted already.
* [RecordNotFoundException](src/EricksonReyes/DomainDrivenDesign/Common/Exception/RecordNotFoundException.php) - Accessing or deleting a record that never existed.
* [MissingActionPerformerException](src/EricksonReyes/DomainDrivenDesign/Common/Exception/MissingActionPerformerException.php) - Commands that has no action performer for accountability.
* [EmptyIdentifierException](src/EricksonReyes/DomainDrivenDesign/Common/Exception/EmptyIdentifierException.php) - Entity or aggregate with an empty identifier value.

## Exceptions
* [MissingEventReplayMethodException](src/EricksonReyes/DomainDrivenDesign/Common/Exception/MissingEventReplayMethodException.php) - Event sourced entity or aggregate does not have the required event replay method.
* [DomainEventOwnershipException](src/EricksonReyes/DomainDrivenDesign/Common/Exception/DomainEventOwnershipException.php) - Replaying an event that does not belong to the entity or aggregate. 