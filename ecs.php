<?php

declare(strict_types=1);

use JumpTwentyFour\PhpCodingStandards\Sniffs\FinalControllerSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\CodeAnalysis\UnusedFunctionParameterSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Formatting\SpaceAfterCastSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Formatting\SpaceAfterNotSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\NamingConventions\CamelCapsFunctionNameSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\PHP\ForbiddenFunctionsSniff;
use PHP_CodeSniffer\Standards\PSR12\Sniffs\ControlStructures\BooleanOperatorPlacementSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\ControlStructures\ControlSignatureSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\NamingConventions\ValidVariableNameSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\PHP\CommentedOutCodeSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\Strings\ConcatenationSpacingSniff;
use PhpCsFixer\Fixer\ClassNotation\NoBlankLinesAfterClassOpeningFixer;
use PhpCsFixer\Fixer\ClassNotation\SelfAccessorFixer;
use PhpCsFixer\Fixer\PhpUnit\PhpUnitTestAnnotationFixer;
use PhpCsFixer\Fixer\Whitespace\ArrayIndentationFixer;
use SlevomatCodingStandard\Sniffs\Arrays\SingleLineArrayWhitespaceSniff;
use SlevomatCodingStandard\Sniffs\Arrays\TrailingArrayCommaSniff;
use SlevomatCodingStandard\Sniffs\Classes\BackedEnumTypeSpacingSniff;
use SlevomatCodingStandard\Sniffs\Classes\ClassConstantVisibilitySniff;
use SlevomatCodingStandard\Sniffs\Classes\MethodSpacingSniff;
use SlevomatCodingStandard\Sniffs\Classes\TraitUseDeclarationSniff;
use SlevomatCodingStandard\Sniffs\Commenting\EmptyCommentSniff;
use SlevomatCodingStandard\Sniffs\Commenting\UselessFunctionDocCommentSniff;
use SlevomatCodingStandard\Sniffs\ControlStructures\EarlyExitSniff;
use SlevomatCodingStandard\Sniffs\ControlStructures\NewWithParenthesesSniff;
use SlevomatCodingStandard\Sniffs\ControlStructures\RequireNullCoalesceOperatorSniff;
use SlevomatCodingStandard\Sniffs\ControlStructures\UselessTernaryOperatorSniff;
use SlevomatCodingStandard\Sniffs\Exceptions\DeadCatchSniff;
use SlevomatCodingStandard\Sniffs\Functions\UnusedInheritedVariablePassedToClosureSniff;
use SlevomatCodingStandard\Sniffs\Functions\UnusedParameterSniff;
use SlevomatCodingStandard\Sniffs\Functions\UselessParameterDefaultValueSniff;
use SlevomatCodingStandard\Sniffs\Namespaces\AlphabeticallySortedUsesSniff;
use SlevomatCodingStandard\Sniffs\Namespaces\MultipleUsesPerLineSniff;
use SlevomatCodingStandard\Sniffs\Namespaces\NamespaceSpacingSniff;
use SlevomatCodingStandard\Sniffs\Namespaces\UnusedUsesSniff;
use SlevomatCodingStandard\Sniffs\Namespaces\UseFromSameNamespaceSniff;
use SlevomatCodingStandard\Sniffs\Operators\DisallowEqualOperatorsSniff;
use SlevomatCodingStandard\Sniffs\PHP\ShortListSniff;
use SlevomatCodingStandard\Sniffs\PHP\TypeCastSniff;
use SlevomatCodingStandard\Sniffs\PHP\UselessParenthesesSniff;
use SlevomatCodingStandard\Sniffs\PHP\UselessSemicolonSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\DeclareStrictTypesSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\LongTypeHintsSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\NullableTypeForNullDefaultValueSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\ParameterTypeHintSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\ParameterTypeHintSpacingSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\ReturnTypeHintSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\ReturnTypeHintSpacingSniff;
use Symplify\CodingStandard\Fixer\ArrayNotation\ArrayOpenerAndCloserNewlineFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;
use PhpCsFixer\Fixer\ControlStructure\TrailingCommaInMultilineFixer;

return ECSConfig::configure()
    ->withConfiguredRule(PhpUnitTestAnnotationFixer::class, [
        'style' => 'annotation',
    ])
    ->withPaths([
        __DIR__ . '/ecs.php',
    ])
    ->withSkip([
        CamelCapsFunctionNameSniff::class => [
            '/tests/**',
        ],
        'PHP_CodeSniffer\Standards\Squiz\Sniffs\NamingConventions\ValidVariableNameSniff.PrivateNoUnderscore',
        'PHP_CodeSniffer\Standards\Squiz\Sniffs\NamingConventions\ValidVariableNameSniff.MemberNotCamelCaps',
        'SlevomatCodingStandard\Sniffs\TypeHints\ReturnTypeHintSniff.MissingTraversableTypeHintSpecification',
        'SlevomatCodingStandard\Sniffs\TypeHints\ParameterTypeHintSniff.MissingTraversableTypeHintSpecification',
        'SlevomatCodingStandard\Sniffs\TypeHints\ParameterTypeHintSniff.MissingNativeTypeHint',
        'SlevomatCodingStandard\Sniffs\TypeHints\ReturnTypeHintSniff.MissingNativeTypeHint',
        'SlevomatCodingStandard\Sniffs\TypeHints\ParameterTypeHintSniff.UselessAnnotation',
        'SlevomatCodingStandard\Sniffs\TypeHints\ReturnTypeHintSniff.UselessAnnotation',
    ])
    ->withRules(
        [
            CamelCapsFunctionNameSniff::class,
            TrailingArrayCommaSniff::class,
            ClassConstantVisibilitySniff::class,
            EmptyCommentSniff::class,
            UselessFunctionDocCommentSniff::class,
            EarlyExitSniff::class,
            NewWithParenthesesSniff::class,
            RequireNullCoalesceOperatorSniff::class,
            DeadCatchSniff::class,
            UnusedInheritedVariablePassedToClosureSniff::class,
            UnusedParameterSniff::class,
            UselessParameterDefaultValueSniff::class,
            AlphabeticallySortedUsesSniff::class,
            MultipleUsesPerLineSniff::class,
            UnusedUsesSniff::class,
            UseFromSameNamespaceSniff::class,
            ShortListSniff::class,
            TypeCastSniff::class,
            UselessParenthesesSniff::class,
            UselessSemicolonSniff::class,
            LongTypeHintsSniff::class,
            NullableTypeForNullDefaultValueSniff::class,
            ParameterTypeHintSpacingSniff::class,
            ReturnTypeHintSpacingSniff::class,
            TrailingCommaInMultilineFixer::class,
            NoBlankLinesAfterClassOpeningFixer::class,
            SelfAccessorFixer::class,
            ArrayIndentationFixer::class,
            ArrayOpenerAndCloserNewlineFixer::class,
            DisallowEqualOperatorsSniff::class,
            TraitUseDeclarationSniff::class,
            DeclareStrictTypesSniff::class,
            ReturnTypeHintSniff::class,
            UselessTernaryOperatorSniff::class,
            SingleLineArrayWhitespaceSniff::class,
            NamespaceSpacingSniff::class,
            MethodSpacingSniff::class,
            BackedEnumTypeSpacingSniff::class,
            UnusedFunctionParameterSniff::class,
            FinalControllerSniff::class,
            ValidVariableNameSniff::class,
        ])
    ->withConfiguredRule(SpaceAfterCastSniff::class, [
        'spacing' => 0,
    ])
    ->withConfiguredRule(SpaceAfterNotSniff::class, [
        'spacing' => 0,
    ])
    ->withConfiguredRule(ForbiddenFunctionsSniff::class, [
        'forbiddenFunctions' => [
                'dd' => null,
                'die' => null,
                'var_dump' => null,
                'print_r' => null,
                'ray' => null,
        ]
    ])
    ->withConfiguredRule(BooleanOperatorPlacementSniff::class, [
        'allowOnly' => 'first',
    ])
    ->withConfiguredRule(ControlSignatureSniff::class, [
        'requiredSpacesBeforeColon' => 0,
    ])
    ->withConfiguredRule(CommentedOutCodeSniff::class, ['maxPercentage' => 25])
    ->withConfiguredRule(ConcatenationSpacingSniff::class, [
        'spacing' => 1,
        'ignoreNewlines' => true,
    ])
    ->withConfiguredRule(DeclareStrictTypesSniff::class, [
        'spacesCountAroundEqualsSign' => 0,
    ])
    ->withConfiguredRule(ParameterTypeHintSniff::class, [
        'enableMixedTypeHint' => false,
    ])
    ->withPreparedSets(psr12: true, docblocks: true, cleanCode: true)
    // modify parallel run
    ->withParallel(timeoutSeconds: 120, maxNumberOfProcess: 32, jobSize: 20);