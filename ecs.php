<?php

declare(strict_types=1);

use PHP_CodeSniffer\Standards\Generic\Sniffs\Formatting\SpaceAfterCastSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Formatting\SpaceAfterNotSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\NamingConventions\CamelCapsFunctionNameSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\PHP\ForbiddenFunctionsSniff;
use PHP_CodeSniffer\Standards\PSR12\Sniffs\ControlStructures\BooleanOperatorPlacementSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\ControlStructures\ControlSignatureSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\PHP\CommentedOutCodeSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\Strings\ConcatenationSpacingSniff;
use SlevomatCodingStandard\Sniffs\Arrays\TrailingArrayCommaSniff;
use SlevomatCodingStandard\Sniffs\Classes\ClassConstantVisibilitySniff;
use SlevomatCodingStandard\Sniffs\Commenting\EmptyCommentSniff;
use SlevomatCodingStandard\Sniffs\ControlStructures\EarlyExitSniff;
use SlevomatCodingStandard\Sniffs\ControlStructures\NewWithParenthesesSniff;
use SlevomatCodingStandard\Sniffs\ControlStructures\RequireNullCoalesceOperatorSniff;
use SlevomatCodingStandard\Sniffs\Exceptions\DeadCatchSniff;
use SlevomatCodingStandard\Sniffs\Functions\UnusedInheritedVariablePassedToClosureSniff;
use SlevomatCodingStandard\Sniffs\Functions\UnusedParameterSniff;
use SlevomatCodingStandard\Sniffs\Functions\UselessParameterDefaultValueSniff;
use SlevomatCodingStandard\Sniffs\Namespaces\AlphabeticallySortedUsesSniff;
use SlevomatCodingStandard\Sniffs\Namespaces\MultipleUsesPerLineSniff;
use SlevomatCodingStandard\Sniffs\Namespaces\UnusedUsesSniff;
use SlevomatCodingStandard\Sniffs\Namespaces\UseFromSameNamespaceSniff;
use SlevomatCodingStandard\Sniffs\PHP\ShortListSniff;
use SlevomatCodingStandard\Sniffs\PHP\TypeCastSniff;
use SlevomatCodingStandard\Sniffs\PHP\UselessParenthesesSniff;
use SlevomatCodingStandard\Sniffs\PHP\UselessSemicolonSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\LongTypeHintsSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\NullableTypeForNullDefaultValueSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\ParameterTypeHintSpacingSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\ReturnTypeHintSpacingSniff;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\EasyCodingStandard\ValueObject\Option;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return static function (ContainerConfigurator $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();

    $parameters->set(Option::SETS, [SetList::CLEAN_CODE, SetList::COMMON, SetList::PSR_1, SetList::PSR_12]);

    $parameters->set(Option::PATHS, [
        __DIR__ . '/src',
        __DIR__ . '/ecs.php',
    ]);

    $parameters->set('exclude_files', [
        __DIR__ . '_ide_helper.php',
        __DIR__ . '_ide_helper_models.php',
        __DIR__ . '.phpstorm.meta.php',
        __DIR__ . 'server.php',
        __DIR__ . 'webpack.prod.js',
        __DIR__ . 'babel.config.js',
        '*\.blade\.php$',
        __DIR__ . 'bootstrap',
        __DIR__ . 'config',
        __DIR__ . 'database',
        __DIR__ . 'node_modules',
        __DIR__ . 'public',
        __DIR__ . 'resources',
        __DIR__ . 'storage',
        __DIR__ . 'vendor',
    ]);

    $parameters->set(Option::SKIP, [
        CamelCapsFunctionNameSniff::class => [
            __DIR__ . 'tests',
        ],
    ]);

    $services = $containerConfigurator->services();

    $services->set(SpaceAfterCastSniff::class)->property('spacing', 0);
    $services->set(SpaceAfterNotSniff::class)->property('spacing', 0);
    $services->set(ForbiddenFunctionsSniff::class)->property('forbiddenFunctions', [
        'dd' => null,
        'die' => null,
        'var_dump' => null,
        'print_r' => null,
    ]);
    $services->set(BooleanOperatorPlacementSniff::class)->property('allowOnly', 'first');

    $services->set(TrailingArrayCommaSniff::class);
    $services->set(ClassConstantVisibilitySniff::class);
    $services->set(EmptyCommentSniff::class);
    $services->set(EarlyExitSniff::class);
    $services->set(NewWithParenthesesSniff::class);
    $services->set(RequireNullCoalesceOperatorSniff::class);
    $services->set(DeadCatchSniff::class);
    $services->set(UnusedInheritedVariablePassedToClosureSniff::class);
    $services->set(UnusedParameterSniff::class);
    $services->set(UselessParameterDefaultValueSniff::class);
    $services->set(AlphabeticallySortedUsesSniff::class);
    $services->set(MultipleUsesPerLineSniff::class);
    $services->set(UnusedUsesSniff::class);
    $services->set(UseFromSameNamespaceSniff::class);
    $services->set(ShortListSniff::class);
    $services->set(TypeCastSniff::class);
    $services->set(UselessParenthesesSniff::class);
    $services->set(UselessSemicolonSniff::class);
    $services->set(LongTypeHintsSniff::class);
    $services->set(NullableTypeForNullDefaultValueSniff::class);
    $services->set(ParameterTypeHintSpacingSniff::class);
    $services->set(ReturnTypeHintSpacingSniff::class);

    $services->set(ControlSignatureSniff::class)->property('requiredSpacesBeforeColon', 0);
    $services->set(CommentedOutCodeSniff::class, '25');
    $services->set(ConcatenationSpacingSniff::class)
        ->property('spacing', 1)
        ->property('ignoreNewlines', true);
};
