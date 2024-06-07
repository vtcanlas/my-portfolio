<?php

namespace PHPMaker2022\project1;

// Page object
$CreateReservationDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { CreateReservation: currentTable } });
var currentForm, currentPageID;
var fCreateReservationdelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fCreateReservationdelete = new ew.Form("fCreateReservationdelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fCreateReservationdelete;
    loadjs.done("fCreateReservationdelete");
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
<form name="fCreateReservationdelete" id="fCreateReservationdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="CreateReservation">
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
<?php if ($Page->res_id->Visible) { // res_id ?>
        <th class="<?= $Page->res_id->headerCellClass() ?>"><span id="elh_CreateReservation_res_id" class="CreateReservation_res_id"><?= $Page->res_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->fname->Visible) { // fname ?>
        <th class="<?= $Page->fname->headerCellClass() ?>"><span id="elh_CreateReservation_fname" class="CreateReservation_fname"><?= $Page->fname->caption() ?></span></th>
<?php } ?>
<?php if ($Page->lname->Visible) { // lname ?>
        <th class="<?= $Page->lname->headerCellClass() ?>"><span id="elh_CreateReservation_lname" class="CreateReservation_lname"><?= $Page->lname->caption() ?></span></th>
<?php } ?>
<?php if ($Page->address->Visible) { // address ?>
        <th class="<?= $Page->address->headerCellClass() ?>"><span id="elh_CreateReservation_address" class="CreateReservation_address"><?= $Page->address->caption() ?></span></th>
<?php } ?>
<?php if ($Page->contactno->Visible) { // contactno ?>
        <th class="<?= $Page->contactno->headerCellClass() ?>"><span id="elh_CreateReservation_contactno" class="CreateReservation_contactno"><?= $Page->contactno->caption() ?></span></th>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
        <th class="<?= $Page->_email->headerCellClass() ?>"><span id="elh_CreateReservation__email" class="CreateReservation__email"><?= $Page->_email->caption() ?></span></th>
<?php } ?>
<?php if ($Page->pool_id->Visible) { // pool_id ?>
        <th class="<?= $Page->pool_id->headerCellClass() ?>"><span id="elh_CreateReservation_pool_id" class="CreateReservation_pool_id"><?= $Page->pool_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date->Visible) { // date ?>
        <th class="<?= $Page->date->headerCellClass() ?>"><span id="elh_CreateReservation_date" class="CreateReservation_date"><?= $Page->date->caption() ?></span></th>
<?php } ?>
<?php if ($Page->rate_id->Visible) { // rate_id ?>
        <th class="<?= $Page->rate_id->headerCellClass() ?>"><span id="elh_CreateReservation_rate_id" class="CreateReservation_rate_id"><?= $Page->rate_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->amountpaid->Visible) { // amountpaid ?>
        <th class="<?= $Page->amountpaid->headerCellClass() ?>"><span id="elh_CreateReservation_amountpaid" class="CreateReservation_amountpaid"><?= $Page->amountpaid->caption() ?></span></th>
<?php } ?>
<?php if ($Page->dateuploaded->Visible) { // dateuploaded ?>
        <th class="<?= $Page->dateuploaded->headerCellClass() ?>"><span id="elh_CreateReservation_dateuploaded" class="CreateReservation_dateuploaded"><?= $Page->dateuploaded->caption() ?></span></th>
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
<?php if ($Page->res_id->Visible) { // res_id ?>
        <td<?= $Page->res_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_CreateReservation_res_id" class="el_CreateReservation_res_id">
<span<?= $Page->res_id->viewAttributes() ?>>
<?= $Page->res_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->fname->Visible) { // fname ?>
        <td<?= $Page->fname->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_CreateReservation_fname" class="el_CreateReservation_fname">
<span<?= $Page->fname->viewAttributes() ?>>
<?= $Page->fname->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->lname->Visible) { // lname ?>
        <td<?= $Page->lname->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_CreateReservation_lname" class="el_CreateReservation_lname">
<span<?= $Page->lname->viewAttributes() ?>>
<?= $Page->lname->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->address->Visible) { // address ?>
        <td<?= $Page->address->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_CreateReservation_address" class="el_CreateReservation_address">
<span<?= $Page->address->viewAttributes() ?>>
<?= $Page->address->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->contactno->Visible) { // contactno ?>
        <td<?= $Page->contactno->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_CreateReservation_contactno" class="el_CreateReservation_contactno">
<span<?= $Page->contactno->viewAttributes() ?>>
<?= $Page->contactno->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
        <td<?= $Page->_email->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_CreateReservation__email" class="el_CreateReservation__email">
<span<?= $Page->_email->viewAttributes() ?>>
<?= $Page->_email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->pool_id->Visible) { // pool_id ?>
        <td<?= $Page->pool_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_CreateReservation_pool_id" class="el_CreateReservation_pool_id">
<span<?= $Page->pool_id->viewAttributes() ?>>
<?= $Page->pool_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->date->Visible) { // date ?>
        <td<?= $Page->date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_CreateReservation_date" class="el_CreateReservation_date">
<span<?= $Page->date->viewAttributes() ?>>
<?= $Page->date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->rate_id->Visible) { // rate_id ?>
        <td<?= $Page->rate_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_CreateReservation_rate_id" class="el_CreateReservation_rate_id">
<span<?= $Page->rate_id->viewAttributes() ?>>
<?= $Page->rate_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->amountpaid->Visible) { // amountpaid ?>
        <td<?= $Page->amountpaid->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_CreateReservation_amountpaid" class="el_CreateReservation_amountpaid">
<span<?= $Page->amountpaid->viewAttributes() ?>>
<?= $Page->amountpaid->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->dateuploaded->Visible) { // dateuploaded ?>
        <td<?= $Page->dateuploaded->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_CreateReservation_dateuploaded" class="el_CreateReservation_dateuploaded">
<span<?= $Page->dateuploaded->viewAttributes() ?>>
<?= $Page->dateuploaded->getViewValue() ?></span>
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