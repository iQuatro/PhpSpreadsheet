<?php

declare(strict_types=1);

namespace PhpOffice\PhpSpreadsheetTests\Calculation\Functions\Statistical;

use PhpOffice\PhpSpreadsheet\Calculation\Calculation;

class ChiDistRightTailTest extends AllSetupTeardown
{
    #[\PHPUnit\Framework\Attributes\DataProvider('providerCHIDIST')]
    public function testCHIDIST(mixed $expectedResult, mixed ...$args): void
    {
        $this->runTestCaseReference('CHISQ.DIST.RT', $expectedResult, ...$args);
    }

    public static function providerCHIDIST(): array
    {
        return require 'tests/data/Calculation/Statistical/CHIDISTRightTail.php';
    }

    #[\PHPUnit\Framework\Attributes\DataProvider('providerChiDistRightTailArray')]
    public function testChiDistRightTailArray(array $expectedResult, string $values, string $degrees): void
    {
        $calculation = Calculation::getInstance();

        $formula = "=CHISQ.DIST.RT({$values}, {$degrees})";
        $result = $calculation->_calculateFormulaValue($formula);
        self::assertEqualsWithDelta($expectedResult, $result, 1.0e-14);
    }

    public static function providerChiDistRightTailArray(): array
    {
        return [
            'row/column vectors' => [
                [
                    [0.8850022316431506, 0.6599632296942824, 0.33259390259930777],
                    [0.9955440192247521, 0.9579789618046938, 0.7851303870304048],
                ],
                '{3, 5, 8}',
                '{7; 12}',
            ],
        ];
    }
}
