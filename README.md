# php-coding-standards
Our coding standards for PHP applications.

## Setup

Add the following to your `composer.json` file.
```
"repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/JumpTwentyFour/php-coding-standards"
        }
    ],
```

Then run the following commands:-

`composer require jumptwentyfour/php-coding-standards --dev`

## Running PHP Easy Coding Standard
`vendor/bin/ecs check`

## Extending the Base ecs.php file
Create a new `ecs.php` file like the following example:-
```
<?php

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\EasyCodingStandard\ValueObject\Option;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->import(__DIR__ . '/vendor/jumptwentyfour/php-coding-standards/ecs.php');

    $parameters = $containerConfigurator->parameters();
    
    $parameters->set(Option::PATHS, [
        __DIR__ . '/app',
        __DIR__ . '/tests',
    ]);
};
```