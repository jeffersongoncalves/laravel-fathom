<?php

return [
    'website_id' => env('FATHOM_SITE'),
    // If there’s a canonical URL in place, we use it instead of the current URL. This is what most customers want, and it’s why it’s the default. If you want to use the current URL, even if there’s canonical (ignoring the canonical), then use data-canonical="false"
    'canonical' => true,
    // By default, we collect a page view every time a visitor to your website loads a page with our script on it. If you don’t want that functionality, you can turn it off by using data-auto="false"
    'auto' => true,
    // If there’s no Fathom integration for your specific javascript system, you can use our generic SPA mode. Most applications use HTML5 History API, so the following code will typically work as-is. This code checks if the History API is available, and if it’s not, it falls back to listening to hash changes
    'spa' => null, // Values: auto or history or hash
    // By default, we collect data on every visitor to your website, regardless of them having DNT turned on or not. That’s because Fathom is privacy-focused analytics, so nothing personal or identifiable is ever “tracked.” Plus, DNT is deprecated and no longer recommended by any browser. That said, if you would like to honor DNT then update your code to include data-honor-dnt="true":
    'honor_dnt' => null, // true or false
];
