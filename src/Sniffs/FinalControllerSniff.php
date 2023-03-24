<?php

declare(strict_types=1);

namespace JumpTwentyFour\PhpCodingStandards\Sniffs;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use SlevomatCodingStandard\Helpers\TokenHelper;

class FinalControllerSniff implements Sniff
{
    public const CONTROLLER_NOT_FINAL = 'ControllerNotFinal';

    public function register(): array
    {
        return [
            T_CLASS,
        ];
    }

    public function process(File $phpcsFile, $classPointer): void
    {
        $previousPointer = TokenHelper::findPreviousEffective($phpcsFile, $classPointer - 1);

        $tokens = $phpcsFile->getTokens();

        $className = $phpcsFile->getDeclarationName($classPointer);

        if ($className === 'Controller') {
            return;
        }

        if (str_contains($className, 'Test')) {
            return;
        }

        if (str_contains($className, 'Controller') === false) {
            return;
        }

        if ($tokens[$previousPointer]['code'] === T_FINAL) {
            return;
        }

        $fix = $phpcsFile->addFixableError(
            'All controllers should be declared using "final" keyword.',
            $classPointer - 1,
            self::CONTROLLER_NOT_FINAL
        );

        if ($fix === false) {
            return;
        }

        $phpcsFile->fixer->beginChangeset();
        $phpcsFile->fixer->addContent($classPointer - 1, 'final ');
        $phpcsFile->fixer->endChangeset();
    }
}
