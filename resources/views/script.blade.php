@if(!empty(config('fathom.website_id')))
    <script src="https://cdn.usefathom.com/script.js" defer data-site="{{ config('fathom.site') }}"
            @if(config('fathom.spa')) data-spa="{{ config('fathom.spa') }}" @endif
            @if(config('fathom.honor_dnt')) data-honor-dnt="{{ config('fathom.honor_dnt') }}" @endif
            data-auto-track="{{ config('fathom.auto') ? 'true' : 'false' }}">
    </script>
@endif
