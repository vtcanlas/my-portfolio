<?php

namespace PHPMaker2022\project1;

// Page object
$Pool2Delete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { pool2: currentTable } });
var currentForm, currentPageID;
var fpool2delete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fpool2delete = new ew.Form("fpool2delete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fpool2delete;
    loadjs.done("fpool2delete");
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
<form name="fpool2delete" id="fpool2delete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="pool2">
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
<?php if ($Page->pool_id->Visible) { // pool_id ?>
        <th class="<?= $Page->pool_id->headerCellClass() ?>"><span id="elh_pool2_pool_id" class="pool2_pool_id"><?= $Page->pool_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->pool_name->Visible) { // pool_name ?>
        <th class="<?= $Page->pool_name->headerCellClass() ?>"><span id="elh_pool2_pool_name" class="pool2_pool_name"><?= $Page->pool_name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->pool_description->Visible) { // pool_description ?>
        <th class="<?= $Page->pool_description->headerCellClass() ?>"><span id="elh_pool2_pool_description" class="pool2_pool_description"><?= $Page->pool_description->caption() ?></span></th>
<?php } ?>
<?php if ($Page->barangay->Visible) { // barangay ?>
        <th class="<?= $Page->barangay->headerCellClass() ?>"><span id="elh_pool2_barangay" class="pool2_barangay"><?= $Page->barangay->caption() ?></span></th>
<?php } ?>
<?php if ($Page->poolcat->Visible) { // poolcat ?>
        <th class="<?= $Page->poolcat->headerCellClass() ?>"><span id="elh_pool2_poolcat" class="pool2_poolcat"><?= $Page->poolcat->caption() ?></span></th>
<?php } ?>
<?php if ($Page->address->Visible) { // address ?>
        <th class="<?= $Page->address->headerCellClass() ?>"><span id="elh_pool2_address" class="pool2_address"><?= $Page->address->caption() ?></span></th>
<?php } ?>
<?php if ($Page->contactno1->Visible) { // contactno1 ?>
        <th class="<?= $Page->contactno1->headerCellClass() ?>"><span id="elh_pool2_contactno1" class="pool2_contactno1"><?= $Page->contactno1->caption() ?></span></th>
<?php } ?>
<?php if ($Page->emailaddress->Visible) { // emailaddress ?>
        <th class="<?= $Page->emailaddress->headerCellClass() ?>"><span id="elh_pool2_emailaddress" class="pool2_emailaddress"><?= $Page->emailaddress->caption() ?></span></th>
<?php } ?>
<?php if ($Page->socmed->Visible) { // socmed ?>
        <th class="<?= $Page->socmed->headerCellClass() ?>"><span id="elh_pool2_socmed" class="pool2_socmed"><?= $Page->socmed->caption() ?></span></th>
<?php } ?>
<?php if ($Page->uname->Visible) { // uname ?>
        <th class="<?= $Page->uname->headerCellClass() ?>"><span id="elh_pool2_uname" class="pool2_uname"><?= $Page->uname->caption() ?></span></th>
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
<?php if ($Page->pool_id->Visible) { // pool_id ?>
        <td<?= $Page->pool_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pool2_pool_id" class="el_pool2_pool_id">
<span<?= $Page->pool_id->viewAttributes() ?>>
<?= $Page->pool_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->pool_name->Visible) { // pool_name ?>
        <td<?= $Page->pool_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pool2_pool_name" class="el_pool2_pool_name">
<span<?= $Page->pool_name->viewAttributes() ?>>
<?= $Page->pool_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->pool_description->Visible) { // pool_description ?>
        <td<?= $Page->pool_description->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pool2_pool_description" class="el_pool2_pool_description">
<span<?= $Page->pool_description->viewAttributes() ?>>
<?= $Page->pool_description->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->barangay->Visible) { // barangay ?>
        <td<?= $Page->barangay->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pool2_barangay" class="el_pool2_barangay">
<span<?= $Page->barangay->viewAttributes() ?>>
<?= $Page->barangay->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->poolcat->Visible) { // poolcat ?>
        <td<?= $Page->poolcat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pool2_poolcat" class="el_pool2_poolcat">
<span<?= $Page->poolcat->viewAttributes() ?>>
<?= $Page->poolcat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->address->Visible) { // address ?>
        <td<?= $Page->address->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pool2_address" class="el_pool2_address">
<span<?= $Page->address->viewAttributes() ?>>
<?= $Page->address->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->contactno1->Visible) { // contactno1 ?>
        <td<?= $Page->contactno1->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pool2_contactno1" class="el_pool2_contactno1">
<span<?= $Page->contactno1->viewAttributes() ?>>
<?= $Page->contactno1->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->emailaddress->Visible) { // emailaddress ?>
        <td<?= $Page->emailaddress->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pool2_emailaddress" class="el_pool2_emailaddress">
<span<?= $Page->emailaddress->viewAttributes() ?>>
<?= $Page->emailaddress->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->socmed->Visible) { // socmed ?>
        <td<?= $Page->socmed->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pool2_socmed" class="el_pool2_socmed">
<span<?= $Page->socmed->viewAttributes() ?>>
<?= $Page->socmed->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->uname->Visible) { // uname ?>
        <td<?= $Page->uname->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pool2_uname" class="el_pool2_uname">
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
