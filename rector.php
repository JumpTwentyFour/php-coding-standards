<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\CodeQuality\Rector\ClassMethod\ReturnTypeFromStrictScalarReturnExprRector;
use Rector\CodeQuality\Rector\Empty_\SimplifyEmptyCheckOnEmptyArrayRector;
use Rector\CodeQuality\Rector\FuncCall\StrvalToTypeCastRector;
use Rector\CodeQuality\Rector\FunctionLike\SimplifyUselessVariableRector;
use Rector\CodeQuality\Rector\Identical\FlipTypeControlToUseExclusiveTypeRector;
use Rector\CodeQuality\Rector\If_\CombineIfRector;
use Rector\CodeQuality\Rector\If_\ExplicitBoolCompareRector;
use Rector\CodeQuality\Rector\If_\ShortenElseIfRector;
use Rector\DeadCode\Rector\ClassMethod\RemoveUselessReturnTagRector;
use Rector\DeadCode\Rector\Property\RemoveUnusedPrivatePropertyRector;
use Rector\DeadCode\Rector\ClassMethod\RemoveUselessParamTagRector;
use Rector\DeadCode\Rector\Property\RemoveUselessVarTagRector;
use Rector\DeadCode\Rector\Stmt\RemoveUnreachableStatementRector;
use Rector\EarlyReturn\Rector\If_\ChangeAndIfToEarlyReturnRector;
use Rector\EarlyReturn\Rector\If_\ChangeNestedIfsToEarlyReturnRector;
use Rector\EarlyReturn\Rector\If_\RemoveAlwaysElseRector;
use Rector\EarlyReturn\Rector\Return_\PreparedValueToEarlyReturnRector;
use Rector\EarlyReturn\Rector\StmtsAwareInterface\ReturnEarlyIfVariableRector;
use Rector\Php71\Rector\FuncCall\CountOnNullRector;
use Rector\Php71\Rector\TryCatch\MultiExceptionCatchRector;
use Rector\Php73\Rector\FuncCall\JsonThrowOnErrorRector;
use Rector\Php74\Rector\Property\RestoreDefaultNullToNullableTypePropertyRector;
use Rector\Privatization\Rector\Class_\FinalizeClassesWithoutChildrenRector;
use Rector\Privatization\Rector\ClassMethod\PrivatizeFinalClassMethodRector;
use Rector\Privatization\Rector\Property\ChangeReadOnlyPropertyWithDefaultValueToConstantRector;
use Rector\Privatization\Rector\Property\PrivatizeFinalClassPropertyRector;
use Rector\Set\ValueObject\SetList;
use Rector\TypeDeclaration\Rector\BooleanAnd\BinaryOpNullableToInstanceofRector;
use Rector\TypeDeclaration\Rector\ClassMethod\AddVoidReturnTypeWhereNoReturnRector;
use Rector\TypeDeclaration\Rector\ClassMethod\ParamTypeByMethodCallTypeRector;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnNeverTypeRector;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromStrictTypedCallRector;
use Rector\TypeDeclaration\Rector\Closure\AddClosureReturnTypeRector;
use Rector\TypeDeclaration\Rector\FunctionLike\AddParamTypeSplFixedArrayRector;
use Rector\TypeDeclaration\Rector\Property\TypedPropertyFromStrictConstructorRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
        __DIR__ . '/app',
        __DIR__ . '/tests',
    ]);

    //Code Quality
    $rectorConfig->rule(CombineIfRector::class);
    $rectorConfig->rule(ExplicitBoolCompareRector::class);
    $rectorConfig->rule(FlipTypeControlToUseExclusiveTypeRector::class);
    $rectorConfig->rule(ReturnTypeFromStrictScalarReturnExprRector::class);
    $rectorConfig->rule(SimplifyEmptyCheckOnEmptyArrayRector::class);
    $rectorConfig->rule(SimplifyUselessVariableRector::class);
    $rectorConfig->rule(ShortenElseIfRector::class);
    $rectorConfig->rule(StrvalToTypeCastRector::class);

    //Dead Code
    $rectorConfig->rule(RemoveUnreachableStatementRector::class);
    $rectorConfig->rule(RemoveUnusedPrivatePropertyRector::class);
    $rectorConfig->rule(RemoveUselessParamTagRector::class);
    $rectorConfig->rule(RemoveUselessReturnTagRector::class);
    $rectorConfig->rule(RemoveUselessVarTagRector::class);

    //Early Return
    $rectorConfig->rule(ChangeAndIfToEarlyReturnRector::class);
    $rectorConfig->rule(ChangeNestedIfsToEarlyReturnRector::class);
    $rectorConfig->rule(PreparedValueToEarlyReturnRector::class);
    $rectorConfig->rule(RemoveAlwaysElseRector::class);
    $rectorConfig->rule(ReturnEarlyIfVariableRector::class);

    //Privatisation
    $rectorConfig->rule(ChangeReadOnlyPropertyWithDefaultValueToConstantRector::class);
    $rectorConfig->rule(FinalizeClassesWithoutChildrenRector::class);
    $rectorConfig->rule(PrivatizeFinalClassMethodRector::class);
    $rectorConfig->rule(PrivatizeFinalClassPropertyRector::class);

    //Type Declarations
    $rectorConfig->rule(AddClosureReturnTypeRector::class);
    $rectorConfig->rule(AddParamTypeSplFixedArrayRector::class);
    $rectorConfig->rule(AddVoidReturnTypeWhereNoReturnRector::class);
    $rectorConfig->rule(BinaryOpNullableToInstanceofRector::class);
    $rectorConfig->rule(ReturnNeverTypeRector::class);
    $rectorConfig->rule(ReturnTypeFromStrictTypedCallRector::class);
    $rectorConfig->rule(ParamTypeByMethodCallTypeRector::class);
    $rectorConfig->rule(TypedPropertyFromStrictConstructorRector::class);

    //PHP 7.1
    if (PHP_VERSION_ID >= 71000) {
        $rectorConfig->rule(CountOnNullRector::class);
        $rectorConfig->rule(MultiExceptionCatchRector::class);
    }

    //PHP 7.3
    if (PHP_VERSION_ID >= 73000) {
        $rectorConfig->rule(JsonThrowOnErrorRector::class);
    }

    //PHP 7.4
    if (PHP_VERSION_ID >= 74000) {
        $rectorConfig->rule(RestoreDefaultNullToNullableTypePropertyRector::class);
    }

    $sets = [];

    //PHP 8.0
    if (PHP_VERSION_ID >= 80000) {
        $sets[] = SetList::PHP_80;
    }

    //PHP 8.1
    if (PHP_VERSION_ID >= 81000) {
        $sets[] = SetList::PHP_81;
    }

    //PHP 8.2
    if (PHP_VERSION_ID >= 82000) {
        $sets[] = SetList::PHP_82;
    }

    $rectorConfig->sets($sets);
};
