@php($settings = app(\JeffersonGoncalves\Fathom\Settings\FathomSettings::class))

@if(!empty($settings->website_id))
    <script src="https://cdn.usefathom.com/script.js" defer
            data-site="{{ $settings->website_id }}"
            @if($settings->canonical === false) data-canonical="false" @endif
            @if($settings->spa) data-spa="{{ $settings->spa }}" @endif
            @if($settings->honor_dnt) data-honor-dnt="true" @endif
            data-auto-track="{{ $settings->auto ? 'true' : 'false' }}">
    </script>
@endif
