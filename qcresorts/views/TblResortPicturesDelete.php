<?php

namespace PHPMaker2022\project1;

// Page object
$TblResortPicturesDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { tbl_resort_pictures: currentTable } });
var currentForm, currentPageID;
var ftbl_resort_picturesdelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    ftbl_resort_picturesdelete = new ew.Form("ftbl_resort_picturesdelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = ftbl_resort_picturesdelete;
    loadjs.done("ftbl_resort_picturesdelete");
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
<form name="ftbl_resort_picturesdelete" id="ftbl_resort_picturesdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="tbl_resort_pictures">
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
<?php if ($Page->pic_id->Visible) { // pic_id ?>
        <th class="<?= $Page->pic_id->headerCellClass() ?>"><span id="elh_tbl_resort_pictures_pic_id" class="tbl_resort_pictures_pic_id"><?= $Page->pic_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->active->Visible) { // active ?>
        <th class="<?= $Page->active->headerCellClass() ?>"><span id="elh_tbl_resort_pictures_active" class="tbl_resort_pictures_active"><?= $Page->active->caption() ?></span></th>
<?php } ?>
<?php if ($Page->pool_id->Visible) { // pool_id ?>
        <th class="<?= $Page->pool_id->headerCellClass() ?>"><span id="elh_tbl_resort_pictures_pool_id" class="tbl_resort_pictures_pool_id"><?= $Page->pool_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->user_id->Visible) { // user_id ?>
        <th class="<?= $Page->user_id->headerCellClass() ?>"><span id="elh_tbl_resort_pictures_user_id" class="tbl_resort_pictures_user_id"><?= $Page->user_id->caption() ?></span></th>
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
<?php if ($Page->pic_id->Visible) { // pic_id ?>
        <td<?= $Page->pic_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_tbl_resort_pictures_pic_id" class="el_tbl_resort_pictures_pic_id">
<span<?= $Page->pic_id->viewAttributes() ?>>
<?= $Page->pic_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->active->Visible) { // active ?>
        <td<?= $Page->active->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_tbl_resort_pictures_active" class="el_tbl_resort_pictures_active">
<span<?= $Page->active->viewAttributes() ?>>
<?= $Page->active->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->pool_id->Visible) { // pool_id ?>
        <td<?= $Page->pool_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_tbl_resort_pictures_pool_id" class="el_tbl_resort_pictures_pool_id">
<span<?= $Page->pool_id->viewAttributes() ?>>
<?= $Page->pool_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->user_id->Visible) { // user_id ?>
        <td<?= $Page->user_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_tbl_resort_pictures_user_id" class="el_tbl_resort_pictures_user_id">
<span<?= $Page->user_id->viewAttributes() ?>>
<?= $Page->user_id->getViewValue() ?></span>
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
