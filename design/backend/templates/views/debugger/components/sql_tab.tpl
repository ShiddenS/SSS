<div class="deb-tab-content" id="DebugToolbarTabSQLContent">
    {$warnings = []}
    {capture name="sql_tabs"}
    <div class="deb-sub-tab-content" id="DebugToolbarSubTabSQLList">
        {capture name="sql_list_table"}
        <div class="table-wrapper">
            <table class="deb-table" id="DebugToolbarSubTabSQLListTable">
                <caption>Queries
                    <small class="deb-font-gray">total time: {$data.totals.time|number_format:"5"} s.</small>
                </caption>
                <tr>
                    <th style="width: 35px;">{include file="backend:views/debugger/components/sorter.tpl" url="debugger.sql" text="№" field="number" order_by=$order_by direction=$direction debugger_hash=$debugger_hash target_id="DebugToolbarTabSQLContent"}</th>
                    <th>Query</th>
                    <th style="width: 60px;">{include file="backend:views/debugger/components/sorter.tpl" url="debugger.sql" text="Time" field="time" order_by=$order_by direction=$direction debugger_hash=$debugger_hash target_id="DebugToolbarTabSQLContent"}</th>
                    <th style="width: 70px;">Actions</th>
                </tr>

                {foreach from=$data.list item="query" key="key"}
                    {if $query.time > $long_query_time}
                        {assign var="color" value="deb-light-red"}
                        {$warnings.list = true}
                    {elseif $query.time > $medium_query_time}
                        {assign var="color" value="deb-light2-red"}
                    {else}
                        {assign var="color" value=false}
                    {/if}
                    <tr>
                        <td {if $color}class="{$color}"{/if}><strong>{$key+1}</strong></td>
                        <td class="{if $color}{$color}{/if}">
                                <pre><code>{$query.query}</code></pre>
                                <ul class="deb-backtrace"
                                    data-ca-query-backtrace="{$key}">
                                    <h4>Backtrace</h4>
                                    {foreach from=$query.backtrace item="backtrace_item"}
                                        <li class="deb-backtrace__item">
                                            <code class="deb-backtrace-item_who">{$backtrace_item.who}</code>
                                            <span class="deb-backtrace-item_where">{$backtrace_item.where}</span>
                                        </li>
                                    {/foreach}
                                </ul>
                            </td>
                        <td {if $color}class="{$color}"{/if}><strong>{$query.time|number_format:"5"}</strong></td>
                        <td class="deb-table__actions-cell">
                            <a href="{"debugger.sql_parse?debugger_hash=`$debugger_hash`&sql_id=`$key`"|fn_url}" data-ca-target-id="DebugToolbarSubTabSQLParse" class="cm-ajax cm-ajax-cache query deb-table__action-link">Re-run</a>
                            <a href="#" data-ca-query-backtrace-trigger="{$key}" class="deb-table__action-link">Backtrace</td>
                    </tr>
                {/foreach}
            </table>
        </div>
        {/capture}
        {if $warnings.list}
            <p class="deb-notice">
                <strong>Warning</strong>
                Some queries are taking longer than {$long_query_time} seconds to execute
            </p>
        {/if}
        {$smarty.capture.sql_list_table nofilter}
    </div>

    <div class="deb-sub-tab-content" id="DebugToolbarSubTabSQLCount">
        {capture name="sql_count_table"}
        <div class="table-wrapper">
            <table class="deb-table">
                <caption>Queries
                    <small class="deb-font-gray">max count: {$data.totals.rcount}</small>
                </caption>
                <tr>
                    <th>Query</th>
                    <th>Count</th>
                    <th>Min time</th>
                    <th>Max time</th>
                    <th>Average time</th>
                </tr>

                {foreach from=$data.count item="query"}
                    {if $query.count > 1}
                        {assign var="color" value="deb-light-red"}
                        {$warnings.count = true}
                    {else}
                        {assign var="color" value=false}
                    {/if}
                    {assign var="average_time" value=$query.total_time/$query.count_time}
                    <tr {if $query.backtrace}title="{$query.backtrace}"{/if}>
                        <td class="sql {if $color}{$color}{/if}">
                            <pre><code>{$query.query}</code></pre>
                        </td>
                        <td {if $color}class="{$color}"{/if} style="width: 60px;"><strong>{$query.count}</strong></td>
                        <td {if $color}class="{$color}"{/if} style="width: 60px;"><strong>{$query.min_time|number_format:"5"}</strong></td>
                        <td {if $color}class="{$color}"{/if} style="width: 60px;"><strong>{$query.max_time|number_format:"5"}</strong></td>
                        <td {if $color}class="{$color}"{/if} style="width: 120px;"><strong>{$average_time|number_format:"5"}</strong></td>
                    </tr>
                {/foreach}
            </table>
        </div>
        {/capture}
        {if $warnings.count}
            <p class="deb-notice">
                <strong>Warning</strong>
                Some queries are being executed multiple times
            </p>
        {/if}
        {$smarty.capture.sql_count_table nofilter}
    </div>

    <div class="deb-sub-tab-content" id="DebugToolbarSubTabSQLParse">
        <form action="{""|fn_url}" method="post" class="cm-ajax" id="DebugToolbarSqlParce">
            <input type="hidden" name="result_ids" value="DebugToolbarSubTabSQLParse" />
            <input type="hidden" name="dispatch[debugger.sql_parse]" value="save" />
            <input type="hidden" name="exec" value="N" />
            <div class="table-wrapper">
                <table width="100%">
                    <tr>
                        <td colspan="2"><textarea cols="100" rows="20" name="query"></textarea></td>
                    </tr>
                    <tr>
                        <td style="width: 100px; padding-top: 10px;">{include file="backend:buttons/button.tpl" but_text="Send" but_id="DebugToolbarSubTabSQLParseSubmit" id="DebugToolbarSubTabSQLParseSubmit" but_name="submit" but_role="submit" but_meta="btn-primary"}</td>
                        <td valign="middle">
                            <label><input type="checkbox" name="exec" value="Y" checked="checked" /> Sandbox</label>
                        </td>
                    </tr>
                </table>
            </div>
        </form>
    </div>
    {/capture}

    <div class="deb-sub-tab">
        <ul>
            <li class="active"><a data-sub-tab-id="DebugToolbarSubTabSQLList">Queries list{if $warnings.list} <span class="deb-warning">!</span>{/if}</a></li>
            <li><a data-sub-tab-id="DebugToolbarSubTabSQLCount">Queries count{if $warnings.count} <span class="deb-warning">!</span>{/if}</a></li>
            <li><a data-sub-tab-id="DebugToolbarSubTabSQLParse">Queries parse</a></li>
        </ul>
    </div>
    {$smarty.capture.sql_tabs nofilter}
    <!--DebugToolbarTabSQLContent--></div>
