<?php

declare(strict_types=1);

test('no dump & die')
    ->expect(['dd', 'dump', 'var_dump', 'ray', 'dumpRawSql'])
    ->not->toBeUsed();

test('use strict types')
    ->expect(['App', 'Domain', 'Support'])
    ->toUseStrictTypes();
