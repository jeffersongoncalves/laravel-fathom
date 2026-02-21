<?php

use JeffersonGoncalves\Fathom\Settings\FathomSettings;

it('can resolve FathomSettings from the container', function () {
    $settings = app(FathomSettings::class);

    expect($settings)->toBeInstanceOf(FathomSettings::class);
});

it('has correct default values', function () {
    $settings = app(FathomSettings::class);

    expect($settings->website_id)->toBeNull()
        ->and($settings->canonical)->toBeTrue()
        ->and($settings->auto)->toBeTrue()
        ->and($settings->spa)->toBeNull()
        ->and($settings->honor_dnt)->toBeNull();
});

it('can update and persist settings', function () {
    $settings = app(FathomSettings::class);
    $settings->website_id = 'ABCDEFGH';
    $settings->canonical = false;
    $settings->auto = false;
    $settings->spa = 'history';
    $settings->honor_dnt = true;
    $settings->save();

    $fresh = app(FathomSettings::class);

    expect($fresh->website_id)->toBe('ABCDEFGH')
        ->and($fresh->canonical)->toBeFalse()
        ->and($fresh->auto)->toBeFalse()
        ->and($fresh->spa)->toBe('history')
        ->and($fresh->honor_dnt)->toBeTrue();
});

it('belongs to the fathom group', function () {
    expect(FathomSettings::group())->toBe('fathom');
});

it('can be accessed via the helper function', function () {
    $settings = fathom_settings();

    expect($settings)->toBeInstanceOf(FathomSettings::class);
});
