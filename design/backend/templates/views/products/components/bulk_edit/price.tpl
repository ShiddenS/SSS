<div class="bulk-edit-inner bulk-edit-inner--price">
    <div class="bulk-edit-inner__header">
        <span>{__("bulk_edit.price_and_stock")}</span>
    </div>

    <div class="bulk-edit-inner__body">
        {hook name="products:bulk_edit_prices_block_body"}

        {hook name="products:bulk_edit_inputs"}
        <div class="bulk-edit-inner__input-group">
            <input type="number" 
                   step="any"
                   class="input-group__text" 
                   placeholder="{__("price")}"
                   data-ca-bulkedit-mod-changer
                   data-ca-bulkedit-mod-affect-on="[data-ca-bulkedit-mod-price]"
                   data-ca-bulkedit-mod-filter="[data-ca-bulkedit-mod-price-filter-p]"
                   data-ca-bulkedit-equal-field="[name='products_data[?][price]']"
                   data-ca-name="price"
            />
            <select class="input-group__modifier" data-ca-bulkedit-mod-price-filter-p>
                <option value="number">{$currencies.$primary_currency.symbol nofilter}</option>
                <option value="percent">%</option>
            </select>
        </div>

        <div class="bulk-edit-inner__input-group">
            <input type="number" 
                   step="any"
                   class="input-group__text" 
                   placeholder="{__("list_price")}"
                   data-ca-bulkedit-mod-changer
                   data-ca-bulkedit-mod-affect-on="[data-ca-bulkedit-mod-listprice]"
                   data-ca-bulkedit-mod-filter="[data-ca-bulkedit-mod-price-filter-lp]"
                   data-ca-bulkedit-equal-field="[name='products_data[?][list_price]']"
                   data-ca-name="list_price"
            />
            <select class="input-group__modifier" data-ca-bulkedit-mod-price-filter-lp>
                <option value="number">{$currencies.$primary_currency.symbol nofilter}</option>
                <option value="percent">%</option>
            </select>
        </div>

        <div class="bulk-edit-inner__input-group">
            <input type="number" 
                   class="input-group__text input-group__text--full" 
                   placeholder="{__("in_stock")}"
                   data-ca-bulkedit-mod-changer
                   data-ca-bulkedit-mod-affect-on="[data-ca-bulkedit-mod-instock]"
                   data-ca-bulkedit-mod-filter="[data-ca-bulkedit-mod-price-filter-is]"
                   data-ca-bulkedit-equal-field="[name='products_data[?][amount]']"
                   data-ca-name="amount"
            />
            <input type="hidden" value="number" data-ca-bulkedit-mod-price-filter-is/>
        </div>

        {/hook}

        <div class="bulk-edit-inner__hint">
            <span>{__("bulk_edit.decrease_hint")}</span>
        </div>

        <div class="bulk-edit-inner__example">
            <p class="bulk-edit-inner__example-title">{__("bulk_edit.example_of_modified_value")}</p>

            {hook name="products:bulk_edit_price_examples"}
            <p class="bulk-edit-inner__example-line">
                <span class="bulk-edit-inner__example-line--left">{__("price")}:</span>
                <span class="bulk-edit-inner__example-line--right" 
                      data-ca-bulkedit-mod-default-value="30.00"
                      data-ca-bulkedit-mod-affected-write-into=".bulk-edit-inner__example-line--red"
                      data-ca-bulkedit-mod-affected-old-value=".bulk-edit-inner__example-line--green"
                      data-ca-bulkedit-mod-price
                >
                    <span class="bulk-edit-inner__example-line--green">30.00</span>
                    <span class="bulk-edit-inner__example-line--red"></span>
                </span>
            </p>

            <p class="bulk-edit-inner__example-line">
                <span class="bulk-edit-inner__example-line--left">{__("list_price")}:</span>
                <span class="bulk-edit-inner__example-line--right"
                      data-ca-bulkedit-mod-default-value="31.00"
                      data-ca-bulkedit-mod-affected-write-into=".bulk-edit-inner__example-line--red"
                      data-ca-bulkedit-mod-affected-old-value=".bulk-edit-inner__example-line--green"
                      data-ca-bulkedit-mod-listprice
                >
                    <span class="bulk-edit-inner__example-line--green">31.00</span>
                    <span class="bulk-edit-inner__example-line--red"></span>
                </span>
            </p>

            <p class="bulk-edit-inner__example-line">
                <span class="bulk-edit-inner__example-line--left">{__("in_stock")}:</span>
                <span class="bulk-edit-inner__example-line--right"
                      data-ca-bulkedit-mod-default-value="10"
                      data-ca-bulkedit-mod-affected-write-into=".bulk-edit-inner__example-line--red"
                      data-ca-bulkedit-mod-affected-old-value=".bulk-edit-inner__example-line--green"
                      data-ca-bulkedit-mod-instock
                >
                    <span class="bulk-edit-inner__example-line--green">10</span>
                    <span class="bulk-edit-inner__example-line--red"></span>
                </span>
            </p>

            {/hook}
        </div>

        {/hook}
    </div>

    <div class="bulk-edit-inner__footer">
        <button class="btn bulk-edit-inner__btn bulkedit-mod-cancel" 
                role="button"
                data-ca-bulkedit-mod-cancel
                data-ca-bulkedit-mod-reset-changer="[data-ca-bulkedit-mod-changer]"
        >{__("reset")}</button>
        <button class="btn btn-primary bulk-edit-inner__btn bulkedit-mod-update" 
                role="button"
                data-ca-bulkedit-mod-update
                data-ca-bulkedit-mod-values="[data-ca-bulkedit-mod-changer]"
                data-ca-bulkedit-mod-target-form="[name=manage_products_form]"
                data-ca-bulkedit-mod-target-form-active-objects="tr.selected:has(input[type=checkbox].cm-item:checked)"
                data-ca-bulkedit-mod-dispatch="products.m_update_prices"
        >{__("apply")}</button>
    </div>
</div>