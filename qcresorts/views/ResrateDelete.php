<?php

namespace PHPMaker2022\project1;

// Page object
$ResrateDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { resrate: currentTable } });
var currentForm, currentPageID;
var fresratedelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fresratedelete = new ew.Form("fresratedelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fresratedelete;
    loadjs.done("fresratedelete");
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
<form name="fresratedelete" id="fresratedelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="resrate">
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
<?php if ($Page->resrate_id->Visible) { // resrate_id ?>
        <th class="<?= $Page->resrate_id->headerCellClass() ?>"><span id="elh_resrate_resrate_id" class="resrate_resrate_id"><?= $Page->resrate_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->pool_id->Visible) { // pool_id ?>
        <th class="<?= $Page->pool_id->headerCellClass() ?>"><span id="elh_resrate_pool_id" class="resrate_pool_id"><?= $Page->pool_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->priceadult->Visible) { // priceadult ?>
        <th class="<?= $Page->priceadult->headerCellClass() ?>"><span id="elh_resrate_priceadult" class="resrate_priceadult"><?= $Page->priceadult->caption() ?></span></th>
<?php } ?>
<?php if ($Page->pricechild->Visible) { // pricechild ?>
        <th class="<?= $Page->pricechild->headerCellClass() ?>"><span id="elh_resrate_pricechild" class="resrate_pricechild"><?= $Page->pricechild->caption() ?></span></th>
<?php } ?>
<?php if ($Page->priceadultspecial->Visible) { // priceadultspecial ?>
        <th class="<?= $Page->priceadultspecial->headerCellClass() ?>"><span id="elh_resrate_priceadultspecial" class="resrate_priceadultspecial"><?= $Page->priceadultspecial->caption() ?></span></th>
<?php } ?>
<?php if ($Page->pricechildspecial->Visible) { // pricechildspecial ?>
        <th class="<?= $Page->pricechildspecial->headerCellClass() ?>"><span id="elh_resrate_pricechildspecial" class="resrate_pricechildspecial"><?= $Page->pricechildspecial->caption() ?></span></th>
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
<?php if ($Page->resrate_id->Visible) { // resrate_id ?>
        <td<?= $Page->resrate_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resrate_resrate_id" class="el_resrate_resrate_id">
<span<?= $Page->resrate_id->viewAttributes() ?>>
<?= $Page->resrate_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->pool_id->Visible) { // pool_id ?>
        <td<?= $Page->pool_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resrate_pool_id" class="el_resrate_pool_id">
<span<?= $Page->pool_id->viewAttributes() ?>>
<?= $Page->pool_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->priceadult->Visible) { // priceadult ?>
        <td<?= $Page->priceadult->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resrate_priceadult" class="el_resrate_priceadult">
<span<?= $Page->priceadult->viewAttributes() ?>>
<?= $Page->priceadult->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->pricechild->Visible) { // pricechild ?>
        <td<?= $Page->pricechild->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resrate_pricechild" class="el_resrate_pricechild">
<span<?= $Page->pricechild->viewAttributes() ?>>
<?= $Page->pricechild->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->priceadultspecial->Visible) { // priceadultspecial ?>
        <td<?= $Page->priceadultspecial->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resrate_priceadultspecial" class="el_resrate_priceadultspecial">
<span<?= $Page->priceadultspecial->viewAttributes() ?>>
<?= $Page->priceadultspecial->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->pricechildspecial->Visible) { // pricechildspecial ?>
        <td<?= $Page->pricechildspecial->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resrate_pricechildspecial" class="el_resrate_pricechildspecial">
<span<?= $Page->pricechildspecial->viewAttributes() ?>>
<?= $Page->pricechildspecial->getViewValue() ?></span>
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
