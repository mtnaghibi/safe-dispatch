# Ensuring Reliable Dispatch of Jobs to the Queue

In Laravel, when attempting to dispatch a job to a queue, there is a possibility of connection failures such as a downed broker, an unresponsive database, or a broken Redis connection. In such cases, it is important to handle the job as a failed job appropriately, and prevent the exception from propagating to the client.
## Installation

You can install the package via composer:

```bash
composer require mtnaghibi/safe-dispatch
```

## Usage

```php
To use it, simply replace `Dispatchable` with `SafeDispatchable` in your jobs.
```

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email naghibi.mohammadtaghi@gmail.com instead of using the issue tracker.

## Credits

-   [MohammadTaghi Naghibi](https://github.com/mtnaghibi)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
