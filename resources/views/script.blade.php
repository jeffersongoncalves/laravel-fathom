@php
    $cookieConsent = function_exists('cookie_consent_script_attributes') ? cookie_consent_script_attributes('fathom') : '';
@endphp
@php($settings = app(\JeffersonGoncalves\Fathom\Settings\FathomSettings::class))

@if(!empty($settings->website_id))
    <script{!! $cookieConsent !!} @if(\Illuminate\Support\Facades\Vite::cspNonce()) nonce="{{ \Illuminate\Support\Facades\Vite::cspNonce() }}" @endif src="https://cdn.usefathom.com/script.js" defer
            data-site="{{ $settings->website_id }}"
            @if($settings->canonical === false) data-canonical="false" @endif
            @if($settings->spa) data-spa="{{ $settings->spa }}" @endif
            @if($settings->honor_dnt) data-honor-dnt="true" @endif
            data-auto-track="{{ $settings->auto ? 'true' : 'false' }}">
    </script>
@endif
