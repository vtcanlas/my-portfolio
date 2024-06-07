<?php

namespace PHPMaker2023\project1;

// Page object
$Resdetails2Delete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { resdetails2: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fresdetails2delete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fresdetails2delete")
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
<form name="fresdetails2delete" id="fresdetails2delete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="resdetails2">
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
<?php if ($Page->date->Visible) { // date ?>
        <th class="<?= $Page->date->headerCellClass() ?>"><span id="elh_resdetails2_date" class="resdetails2_date"><?= $Page->date->caption() ?></span></th>
<?php } ?>
<?php if ($Page->rate_id->Visible) { // rate_id ?>
        <th class="<?= $Page->rate_id->headerCellClass() ?>"><span id="elh_resdetails2_rate_id" class="resdetails2_rate_id"><?= $Page->rate_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->fname->Visible) { // fname ?>
        <th class="<?= $Page->fname->headerCellClass() ?>"><span id="elh_resdetails2_fname" class="resdetails2_fname"><?= $Page->fname->caption() ?></span></th>
<?php } ?>
<?php if ($Page->lname->Visible) { // lname ?>
        <th class="<?= $Page->lname->headerCellClass() ?>"><span id="elh_resdetails2_lname" class="resdetails2_lname"><?= $Page->lname->caption() ?></span></th>
<?php } ?>
<?php if ($Page->dateuploaded->Visible) { // dateuploaded ?>
        <th class="<?= $Page->dateuploaded->headerCellClass() ?>"><span id="elh_resdetails2_dateuploaded" class="resdetails2_dateuploaded"><?= $Page->dateuploaded->caption() ?></span></th>
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
<?php if ($Page->date->Visible) { // date ?>
        <td<?= $Page->date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resdetails2_date" class="el_resdetails2_date">
<span<?= $Page->date->viewAttributes() ?>>
<?= $Page->date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->rate_id->Visible) { // rate_id ?>
        <td<?= $Page->rate_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resdetails2_rate_id" class="el_resdetails2_rate_id">
<span<?= $Page->rate_id->viewAttributes() ?>>
<?= $Page->rate_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->fname->Visible) { // fname ?>
        <td<?= $Page->fname->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resdetails2_fname" class="el_resdetails2_fname">
<span<?= $Page->fname->viewAttributes() ?>>
<?= $Page->fname->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->lname->Visible) { // lname ?>
        <td<?= $Page->lname->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resdetails2_lname" class="el_resdetails2_lname">
<span<?= $Page->lname->viewAttributes() ?>>
<?= $Page->lname->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->dateuploaded->Visible) { // dateuploaded ?>
        <td<?= $Page->dateuploaded->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resdetails2_dateuploaded" class="el_resdetails2_dateuploaded">
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
