{if $thread.object.variation_features}
    {include file="addons/product_variations/views/product_variations/components/variation_features.tpl"
        variation_features=$thread.object.variation_features
        features_split=true
        features_inline=true
    }
{/if}
