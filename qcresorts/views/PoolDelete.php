<?php

namespace PHPMaker2023\project1;

// Page object
$PoolDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { pool: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fpooldelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fpooldelete")
        .setPageId("delete")
        .build();
    window[form.id] = form;
    currentForm = form;
    loadjs.done(form.id);
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
<form name="fpooldelete" id="fpooldelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="pool">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid <?= $Page->TableGridClass ?>">
<div class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>" style="<?= $Page->TableContainerStyle ?>">
<table class="<?= $Page->TableClass ?>">
    <thead>
    <tr class="ew-table-header">
<?php if ($Page->pool_name->Visible) { // pool_name ?>
        <th class="<?= $Page->pool_name->headerCellClass() ?>"><span id="elh_pool_pool_name" class="pool_pool_name"><?= $Page->pool_name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->barangay->Visible) { // barangay ?>
        <th class="<?= $Page->barangay->headerCellClass() ?>"><span id="elh_pool_barangay" class="pool_barangay"><?= $Page->barangay->caption() ?></span></th>
<?php } ?>
<?php if ($Page->uname->Visible) { // uname ?>
        <th class="<?= $Page->uname->headerCellClass() ?>"><span id="elh_pool_uname" class="pool_uname"><?= $Page->uname->caption() ?></span></th>
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
<?php if ($Page->pool_name->Visible) { // pool_name ?>
        <td<?= $Page->pool_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pool_pool_name" class="el_pool_pool_name">
<span<?= $Page->pool_name->viewAttributes() ?>>
<?= $Page->pool_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->barangay->Visible) { // barangay ?>
        <td<?= $Page->barangay->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pool_barangay" class="el_pool_barangay">
<span<?= $Page->barangay->viewAttributes() ?>>
<?= $Page->barangay->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->uname->Visible) { // uname ?>
        <td<?= $Page->uname->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pool_uname" class="el_pool_uname">
<span<?= $Page->uname->viewAttributes() ?>>
<?= $Page->uname->getViewValue() ?></span>
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
<div class="ew-buttons ew-desktop-buttons">
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
