<div id="DebugToolbarSubTabSQLParse">
    <form action="{""|fn_url}" method="post" class="cm-ajax">
        <input type="hidden" name="result_ids" value="DebugToolbarSubTabSQLParse">
        <input type="hidden" name="dispatch" value="debugger.sql_parse">
        <table width="100%" style="height:50px;">
            <tr>
                <td style="width: 100px; vertical-top: top;">{include file="backend:buttons/button.tpl" but_text="Send" but_id="DebugToolbarSubTabSQLParseSubmit" id="DebugToolbarSubTabSQLParseSubmit" but_name="submit" but_role="submit" but_meta="btn-primary"}</td>
                <td valign="top">
                    <label><input type="checkbox" name="exec" value="Y" checked="checked" /> Sandbox</label>
                </td>
            </tr>
        </table>

        <input type="hidden" name="query" id="DebugToolbarSQLQuery">
        <table class="deb-table ty-width-full">
            <tr>
                <td><div><pre id="DebugToolbarSQLQueryValue" contenteditable="true"><code>{$query nofilter}</code></pre></div></td>
            </tr>
        </table>

    </form>

    {if $stop_exec}
        <h4>Query is invalid</h4>
    {/if}

    {if $query_time}
        <h4>Query time </small>{$query_time}</small></h4>
    {/if}

    {if $explain}
        <table class="deb-table ty-width-full">
            <caption>Explain</caption>
            <tr>
                <th>id</th>
                <th>select_type</th>
                <th>table</th>
                <th>type</th>
                <th>possible_keys</th>
                <th>key</th>
                <th>key_len</th>
                <th>ref</th>
                <th>rows</th>
                <th>Extra</th>
            </tr>
            {foreach from=$explain item="exp"}
                <tr>
                    <td>{$exp.id}</td>
                    <td>{$exp.select_type}</td>
                    <td>{$exp.table}</td>
                    <td>{$exp.type}</td>
                    <td>{$exp.possible_keys}</td>
                    <td>{$exp.key}</td>
                    <td>{$exp.key_len}</td>
                    <td>{$exp.ref}</td>
                    <td>{$exp.rows}</td>
                    <td>{$exp.Extra}</td>
                </tr>
            {/foreach}
        </table>
    {/if}

    {if $json_explain}
        <h3>JSON explain</h3>
        <p><pre><code>{$json_explain}</code></pre></p>
    {/if}

    {if $result}
        <div class="table-wrapper">
            <table class="deb-table ty-width-full">
                <h3>Result</h3>
                {if $result_columns}
                    <tr>
                        {foreach from=$result_columns item="column"}
                            <th>{$column}</th>
                        {/foreach}
                    </tr>
                    {foreach from=$result item="row"}
                        <tr>
                            {foreach from=$row item="value"}
                                <td>{$value}</td>
                            {/foreach}
                        </tr>
                    {/foreach}
                {else}
                    <tr>
                        <td> <div><pre><code>{$result|var_dump}</code></pre></div></td>
                    </tr>
                {/if}
            </table>
        </div>
    {/if}

    {if $backtrace}
        <div class="table-wrapper">
            <table class="deb-table ty-width-full">
                <h3>Backtrace</h3>
                <tr>
                    <th>#</th>
                    <th>Location</th>
                    <th>Function</th>
                    <th>Line</th>
                </tr>
                {foreach from=$backtrace item="item" key="key"}
                    <tr>
                        <td>{$key}</td>
                        {foreach from="#"|explode:$item item="col"}
                            <td>{$col}</td>
                        {/foreach}
                    </tr>
                {/foreach}
            </table>
        </div>
    {/if}
    <!--DebugToolbarSubTabSQLParse--></div>
