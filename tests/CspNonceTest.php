<?php

use Illuminate\Support\Facades\Vite;
use JeffersonGoncalves\Fathom\Settings\FathomSettings;

it('stamps the CSP nonce on every script tag', function () {
    Vite::useCspNonce('test-nonce');
    $settings = app(FathomSettings::class);
    $settings->website_id = 'TESTSITE';
    $settings->save();
    $html = (string) $this->blade('@include("fathom::script")');

    preg_match_all('/<script\b[^>]*>/', $html, $tags);

    expect($tags[0])->not->toBeEmpty()->each->toContain('nonce="test-nonce"');
});

it('renders no nonce attribute when the app uses none', function () {
    $settings = app(FathomSettings::class);
    $settings->website_id = 'TESTSITE';
    $settings->save();
    $html = (string) $this->blade('@include("fathom::script")');

    expect($html)->toContain('<script')->not->toContain('nonce=');
});
