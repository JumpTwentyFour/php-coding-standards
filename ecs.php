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
use PhpCsFixer\Fixer\ArrayNotation\TrailingCommaInMultilineArrayFixer;
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
use Symplify\EasyCodingStandard\ValueObject\Option;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

ECSConfig::configure()
    ->withConfiguredRule(PhpUnitTestAnnotationFixer::class, [
        'style' => 'annotation',
    ])
    ->withPreparedSets(psr12: true, docblocks: true, cleanCode: true)
    // modify parallel run
    ->withParallel(timeoutSeconds: 120, maxNumberOfProcess: 32, jobSize: 20);

return static function (ECSConfig $ecsConfig): void {
    $parameters = $ecsConfig->parameters();

    $ecsConfig->import(SetList::CLEAN_CODE);
    $ecsConfig->import(SetList::DOCBLOCK);
    $ecsConfig->import(SetList::PSR_12);

    $ecsConfig->ruleWithConfiguration(PhpUnitTestAnnotationFixer::class, [
        'style' => 'annotation',
    ]);

    $parameters->set(Option::PATHS, [
        __DIR__ . '/ecs.php',
    ]);

    $parameters->set(Option::SKIP, [
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
    ]);

    $services = $ecsConfig->services();

    $services->set(CamelCapsFunctionNameSniff::class);

    $services->set(SpaceAfterCastSniff::class)
        ->property('spacing', 0);

    $services->set(SpaceAfterNotSniff::class)
        ->property('spacing', 0);

    $services->set(ForbiddenFunctionsSniff::class)
        ->property('forbiddenFunctions', [
            'dd' => null,
            'die' => null,
            'var_dump' => null,
            'print_r' => null,
            'ray' => null,
        ]);
    $services->set(BooleanOperatorPlacementSniff::class)
        ->property('allowOnly', 'first');

    $services->set(TrailingArrayCommaSniff::class);
    $services->set(ClassConstantVisibilitySniff::class);
    $services->set(EmptyCommentSniff::class);
    $services->set(UselessFunctionDocCommentSniff::class);
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
    $services->set(ControlSignatureSniff::class)
        ->property('requiredSpacesBeforeColon', 0);

    $services->set(CommentedOutCodeSniff::class, '25');
    $services->set(ConcatenationSpacingSniff::class)
        ->property('spacing', 1)
        ->property('ignoreNewlines', true);

    $services->set(\PhpCsFixer\Fixer\ControlStructure\TrailingCommaInMultilineFixer::class);
    $services->set(NoBlankLinesAfterClassOpeningFixer::class);
    $services->set(SelfAccessorFixer::class);
    $services->set(ArrayIndentationFixer::class);
    $services->set(ArrayOpenerAndCloserNewlineFixer::class);
    $services->set(DisallowEqualOperatorsSniff::class);
    $services->set(TraitUseDeclarationSniff::class);
    $services->set(DeclareStrictTypesSniff::class)
        ->property('spacesCountAroundEqualsSign', 0);

    $services->set(ReturnTypeHintSniff::class);
    $services->set(UselessTernaryOperatorSniff::class);
    $services->set(ParameterTypeHintSniff::class)
        ->property('enableMixedTypeHint', false);

    $services->set(SingleLineArrayWhitespaceSniff::class);
    $services->set(NamespaceSpacingSniff::class);
    $services->set(MethodSpacingSniff::class);
    $services->set(BackedEnumTypeSpacingSniff::class);
    $services->set(UnusedFunctionParameterSniff::class);
    $services->set(FinalControllerSniff::class);
    $services->set(ValidVariableNameSniff::class);
};
