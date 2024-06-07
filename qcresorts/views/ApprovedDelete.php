<?php

namespace PHPMaker2022\project1;

// Page object
$ApprovedDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { approved: currentTable } });
var currentForm, currentPageID;
var fapproveddelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fapproveddelete = new ew.Form("fapproveddelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fapproveddelete;
    loadjs.done("fapproveddelete");
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
<form name="fapproveddelete" id="fapproveddelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="approved">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table table-hover table-sm ew-table">
    <thead>
    <tr class="ew-table-header">
<?php if ($Page->res_id->Visible) { // res_id ?>
        <th class="<?= $Page->res_id->headerCellClass() ?>"><span id="elh_approved_res_id" class="approved_res_id"><?= $Page->res_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->pool_id->Visible) { // pool_id ?>
        <th class="<?= $Page->pool_id->headerCellClass() ?>"><span id="elh_approved_pool_id" class="approved_pool_id"><?= $Page->pool_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date->Visible) { // date ?>
        <th class="<?= $Page->date->headerCellClass() ?>"><span id="elh_approved_date" class="approved_date"><?= $Page->date->caption() ?></span></th>
<?php } ?>
<?php if ($Page->rate_id->Visible) { // rate_id ?>
        <th class="<?= $Page->rate_id->headerCellClass() ?>"><span id="elh_approved_rate_id" class="approved_rate_id"><?= $Page->rate_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->fname->Visible) { // fname ?>
        <th class="<?= $Page->fname->headerCellClass() ?>"><span id="elh_approved_fname" class="approved_fname"><?= $Page->fname->caption() ?></span></th>
<?php } ?>
<?php if ($Page->lname->Visible) { // lname ?>
        <th class="<?= $Page->lname->headerCellClass() ?>"><span id="elh_approved_lname" class="approved_lname"><?= $Page->lname->caption() ?></span></th>
<?php } ?>
<?php if ($Page->address->Visible) { // address ?>
        <th class="<?= $Page->address->headerCellClass() ?>"><span id="elh_approved_address" class="approved_address"><?= $Page->address->caption() ?></span></th>
<?php } ?>
<?php if ($Page->contactno->Visible) { // contactno ?>
        <th class="<?= $Page->contactno->headerCellClass() ?>"><span id="elh_approved_contactno" class="approved_contactno"><?= $Page->contactno->caption() ?></span></th>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
        <th class="<?= $Page->_email->headerCellClass() ?>"><span id="elh_approved__email" class="approved__email"><?= $Page->_email->caption() ?></span></th>
<?php } ?>
<?php if ($Page->dateuploaded->Visible) { // dateuploaded ?>
        <th class="<?= $Page->dateuploaded->headerCellClass() ?>"><span id="elh_approved_dateuploaded" class="approved_dateuploaded"><?= $Page->dateuploaded->caption() ?></span></th>
<?php } ?>
<?php if ($Page->approved->Visible) { // approved ?>
        <th class="<?= $Page->approved->headerCellClass() ?>"><span id="elh_approved_approved" class="approved_approved"><?= $Page->approved->caption() ?></span></th>
<?php } ?>
<?php if ($Page->uname->Visible) { // uname ?>
        <th class="<?= $Page->uname->headerCellClass() ?>"><span id="elh_approved_uname" class="approved_uname"><?= $Page->uname->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_approved_res_id" class="el_approved_res_id">
<span<?= $Page->res_id->viewAttributes() ?>>
<?= $Page->res_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->pool_id->Visible) { // pool_id ?>
        <td<?= $Page->pool_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_approved_pool_id" class="el_approved_pool_id">
<span<?= $Page->pool_id->viewAttributes() ?>>
<?= $Page->pool_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->date->Visible) { // date ?>
        <td<?= $Page->date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_approved_date" class="el_approved_date">
<span<?= $Page->date->viewAttributes() ?>>
<?= $Page->date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->rate_id->Visible) { // rate_id ?>
        <td<?= $Page->rate_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_approved_rate_id" class="el_approved_rate_id">
<span<?= $Page->rate_id->viewAttributes() ?>>
<?= $Page->rate_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->fname->Visible) { // fname ?>
        <td<?= $Page->fname->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_approved_fname" class="el_approved_fname">
<span<?= $Page->fname->viewAttributes() ?>>
<?= $Page->fname->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->lname->Visible) { // lname ?>
        <td<?= $Page->lname->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_approved_lname" class="el_approved_lname">
<span<?= $Page->lname->viewAttributes() ?>>
<?= $Page->lname->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->address->Visible) { // address ?>
        <td<?= $Page->address->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_approved_address" class="el_approved_address">
<span<?= $Page->address->viewAttributes() ?>>
<?= $Page->address->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->contactno->Visible) { // contactno ?>
        <td<?= $Page->contactno->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_approved_contactno" class="el_approved_contactno">
<span<?= $Page->contactno->viewAttributes() ?>>
<?= $Page->contactno->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
        <td<?= $Page->_email->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_approved__email" class="el_approved__email">
<span<?= $Page->_email->viewAttributes() ?>>
<?= $Page->_email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->dateuploaded->Visible) { // dateuploaded ?>
        <td<?= $Page->dateuploaded->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_approved_dateuploaded" class="el_approved_dateuploaded">
<span<?= $Page->dateuploaded->viewAttributes() ?>>
<?= $Page->dateuploaded->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->approved->Visible) { // approved ?>
        <td<?= $Page->approved->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_approved_approved" class="el_approved_approved">
<span<?= $Page->approved->viewAttributes() ?>>
<?= $Page->approved->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->uname->Visible) { // uname ?>
        <td<?= $Page->uname->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_approved_uname" class="el_approved_uname">
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
