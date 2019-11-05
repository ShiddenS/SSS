<div class="upgrade-center_notice">
    <div class="upgrade-center_error">
        <h4>{__("upgrade_center.validation_issue")}</h4>
        <p>{__("upgrade_center.validator_fail_result", ["[validator_name]" => $validator_name])}</p>
    </div>
    <div class="upgrade-center_notice-table all">
        <div class="table-responsive-wrapper">
            <table class="table table-condensed table-responsive">
                <thead>
                    <tr>
                        <th>{__("file")}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td data-th="{__("file")}">
                            {$data nofilter}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>