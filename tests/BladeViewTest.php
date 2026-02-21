<?php

use JeffersonGoncalves\Fathom\Settings\FathomSettings;

it('renders the script tag when website_id is set', function () {
    $settings = app(FathomSettings::class);
    $settings->website_id = 'TESTSITE';
    $settings->save();

    $view = $this->blade('@include("fathom::script")');

    $view->assertSee('https://cdn.usefathom.com/script.js', false)
        ->assertSee('data-site="TESTSITE"', false);
});

it('does not render the script tag when website_id is empty', function () {
    $settings = app(FathomSettings::class);
    $settings->website_id = null;
    $settings->save();

    $view = $this->blade('@include("fathom::script")');

    $view->assertDontSee('cdn.usefathom.com', false);
});

it('renders data-spa attribute when spa is set', function () {
    $settings = app(FathomSettings::class);
    $settings->website_id = 'TESTSITE';
    $settings->spa = 'history';
    $settings->save();

    $view = $this->blade('@include("fathom::script")');

    $view->assertSee('data-spa="history"', false);
});

it('does not render data-spa attribute when spa is null', function () {
    $settings = app(FathomSettings::class);
    $settings->website_id = 'TESTSITE';
    $settings->spa = null;
    $settings->save();

    $view = $this->blade('@include("fathom::script")');

    $view->assertDontSee('data-spa', false);
});

it('renders data-honor-dnt when honor_dnt is true', function () {
    $settings = app(FathomSettings::class);
    $settings->website_id = 'TESTSITE';
    $settings->honor_dnt = true;
    $settings->save();

    $view = $this->blade('@include("fathom::script")');

    $view->assertSee('data-honor-dnt="true"', false);
});

it('does not render data-honor-dnt when honor_dnt is null', function () {
    $settings = app(FathomSettings::class);
    $settings->website_id = 'TESTSITE';
    $settings->honor_dnt = null;
    $settings->save();

    $view = $this->blade('@include("fathom::script")');

    $view->assertDontSee('data-honor-dnt', false);
});

it('renders data-canonical="false" when canonical is false', function () {
    $settings = app(FathomSettings::class);
    $settings->website_id = 'TESTSITE';
    $settings->canonical = false;
    $settings->save();

    $view = $this->blade('@include("fathom::script")');

    $view->assertSee('data-canonical="false"', false);
});

it('does not render data-canonical when canonical is true (default)', function () {
    $settings = app(FathomSettings::class);
    $settings->website_id = 'TESTSITE';
    $settings->canonical = true;
    $settings->save();

    $view = $this->blade('@include("fathom::script")');

    $view->assertDontSee('data-canonical', false);
});

it('renders data-auto-track="false" when auto is false', function () {
    $settings = app(FathomSettings::class);
    $settings->website_id = 'TESTSITE';
    $settings->auto = false;
    $settings->save();

    $view = $this->blade('@include("fathom::script")');

    $view->assertSee('data-auto-track="false"', false);
});

it('renders data-auto-track="true" when auto is true', function () {
    $settings = app(FathomSettings::class);
    $settings->website_id = 'TESTSITE';
    $settings->auto = true;
    $settings->save();

    $view = $this->blade('@include("fathom::script")');

    $view->assertSee('data-auto-track="true"', false);
});
