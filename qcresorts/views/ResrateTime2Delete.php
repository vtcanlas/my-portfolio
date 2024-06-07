<?php

namespace PHPMaker2022\project1;

// Page object
$ResrateTime2Delete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { resrate_time2: currentTable } });
var currentForm, currentPageID;
var fresrate_time2delete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fresrate_time2delete = new ew.Form("fresrate_time2delete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fresrate_time2delete;
    loadjs.done("fresrate_time2delete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fresrate_time2delete" id="fresrate_time2delete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="resrate_time2">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table table-bordered table-hover table-sm ew-table">
    <thead>
    <tr class="ew-table-header">
<?php if ($Page->time_id->Visible) { // time_id ?>
        <th class="<?= $Page->time_id->headerCellClass() ?>"><span id="elh_resrate_time2_time_id" class="resrate_time2_time_id"><?= $Page->time_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->pool_id->Visible) { // pool_id ?>
        <th class="<?= $Page->pool_id->headerCellClass() ?>"><span id="elh_resrate_time2_pool_id" class="resrate_time2_pool_id"><?= $Page->pool_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->time->Visible) { // time ?>
        <th class="<?= $Page->time->headerCellClass() ?>"><span id="elh_resrate_time2_time" class="resrate_time2_time"><?= $Page->time->caption() ?></span></th>
<?php } ?>
    </tr>
    </thead>
    <tbody>
<?php
$Page->RecordCount = 0;
$i = 0;
while (!$Page->Recordset->EOF) {
    $Page->RecordCount++;
    $Page->RowCount++;

    // Set row properties
    $Page->resetAttributes();
    $Page->RowType = ROWTYPE_VIEW; // View

    // Get the field contents
    $Page->loadRowValues($Page->Recordset);

    // Render row
    $Page->renderRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php if ($Page->time_id->Visible) { // time_id ?>
        <td<?= $Page->time_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resrate_time2_time_id" class="el_resrate_time2_time_id">
<span<?= $Page->time_id->viewAttributes() ?>>
<?= $Page->time_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->pool_id->Visible) { // pool_id ?>
        <td<?= $Page->pool_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resrate_time2_pool_id" class="el_resrate_time2_pool_id">
<span<?= $Page->pool_id->viewAttributes() ?>>
<?= $Page->pool_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->time->Visible) { // time ?>
        <td<?= $Page->time->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resrate_time2_time" class="el_resrate_time2_time">
<span<?= $Page->time->viewAttributes() ?>>
<?= $Page->time->getViewValue() ?></span>
</span>
</td>
<?php } ?>
    </tr>
<?php
    $Page->Recordset->moveNext();
}
$Page->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
