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

## Extending the Base PHPCS File
Create a new `phpcs.xml` file with the following:-
```
<?xml version="1.0"?>
<ruleset>
    <rule ref="vendor/jumptwentyfour/php-coding-standards/phpcs.xml"/>
</ruleset>
```