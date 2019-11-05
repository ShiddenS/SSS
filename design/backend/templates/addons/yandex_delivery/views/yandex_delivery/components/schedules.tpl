{if count($schedules) == 1}
    {assign var="day" value=$schedules[1]}

    {if $day['all_day']}
        {__('yandex_delivery_all_day')}
    {else}
        {__('yandex_delivery_every_day')} {$day['from']}&#8211;{$day['to']}
    {/if}

{else}

    {foreach $schedules as $day}

        {if $day['first_day'] == $day['last_day']}
            {__("weekday_`$day['first_day']`")} &#8212;
        {else}
            {__("weekday_`$day['first_day']`")}&#8211;{__("weekday_`$day['last_day']`")} &#8212;
        {/if}

        {if $day['schedule']}
            {$day['schedule']}<br>
        {elseif $day['from']}
            {$day['from']}&#8211;{$day['to']}<br>
        {else}
            {__('yandex_delivery_weekend')}<br>
        {/if}
    {/foreach}

{/if}
