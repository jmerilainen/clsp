<?php

use Jmerilainen\Clsp\Clsp;

it('can generate classes from array', function () {
    $test = Clsp::make('font-serif')
        ->variants([
            'shape' => [
                'rounded' => 'rounded',
                'pill' => 'rounded-4xl',
            ],
            'size' => [
                'md' => 'py-2 px-4',
                'sm' => 'py-1 px-3 text-xs',
            ],
            'variant' => [
                'primary' => 'bg-blue-500 text-whtie',
            ],
        ])
        ->compoundVariants([
            [
                ['variant' => 'tag', 'mode' => 'fill', ],
                'bg-blue-100 text-white hover:bg-blue-75 focus:bg-blue-75',
            ],
            [
                ['variant' => 'tag', 'mode' => 'outline', ],
                'border-2 border-blue-100 hover:bg-blue-100 hover:text-white',
            ],
        ]);

    $test->props([
        'variant' => 'tag',
        'mode' => 'fill',
        'size' => 'md',
    ]);

    $expected = 'font-serif py-2 px-4 bg-blue-100 text-white hover:bg-blue-75 focus:bg-blue-75';

    expect($test->__toString())->toBe($expected);
});

it('can generate classes from helper function', function () {
    $test = clsp()
        ->variants([
            'shape' => [
                'rounded' => 'rounded',
                'pill' => 'rounded-4xl',
            ],
            'size' => [
                'md' => 'py-2 px-4',
                'sm' => 'py-1 px-3 text-xs',
            ],
            'stretched' => [
                'default' => 'stretched',
            ],
        ])
        ->props([
            'shape' => 'rounded',
            'stretched' => true,
            'size' => 'lg',
        ]);

    $html = '<button class="'. $test .'">Test</button>';
    $expected = '<button class="rounded stretched">Test</button>';

    expect($html)->toBe($expected);
});


it('can generate from multiple compound variants', function () {
    $test = Clsp::make('font-sans')
        ->variants([
            'size' => [
                'md' => 'py-2 px-4',
                'sm' => 'py-1 px-3 text-xs',
            ],
            'variant' => [
                'tag' => 'my-tag-calss',
            ],
        ])
        ->compoundVariants([
            [
                ['variant' => 'tag', 'mode' => 'fill', ],
                'bg-blue-100',
            ],
            [
                ['variant' => 'tag', 'mode' => 'outline', ],
                'bg-blue-200',
            ],
            [
                ['variant' => 'tag', 'shape' => 'rounded', ],
                'rounded-full',
            ],
            [
                ['variant' => 'primary', 'shape' => 'rounded', ],
                'rounded-sm',
            ],
            [
                ['shape' => 'rounded', 'size' => 'md', 'variant' => 'tag' ],
                'shadow',
            ],
            [
                ['shape' => 'rounded', 'size' => 'lg',],
                'rounded-lg',
            ],
        ]);

    $test->props([
        'size' => 'md',
        'variant' => 'tag',
        'mode' => 'fill',
        'shape' => 'rounded',
    ]);

    $expected = 'font-sans py-2 px-4 my-tag-calss bg-blue-100 rounded-full shadow';

    expect($test->__toString())->toBe($expected);
});
