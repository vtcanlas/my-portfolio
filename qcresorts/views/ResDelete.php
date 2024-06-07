<?php

namespace PHPMaker2023\project1;

// Page object
$ResDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { res: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fresdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fresdelete")
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
<form name="fresdelete" id="fresdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="res">
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
<?php if ($Page->Id->Visible) { // Id ?>
        <th class="<?= $Page->Id->headerCellClass() ?>"><span id="elh_res_Id" class="res_Id"><?= $Page->Id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->_Title->Visible) { // Title ?>
        <th class="<?= $Page->_Title->headerCellClass() ?>"><span id="elh_res__Title" class="res__Title"><?= $Page->_Title->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Start->Visible) { // Start ?>
        <th class="<?= $Page->Start->headerCellClass() ?>"><span id="elh_res_Start" class="res_Start"><?= $Page->Start->caption() ?></span></th>
<?php } ?>
<?php if ($Page->End->Visible) { // End ?>
        <th class="<?= $Page->End->headerCellClass() ?>"><span id="elh_res_End" class="res_End"><?= $Page->End->caption() ?></span></th>
<?php } ?>
<?php if ($Page->AllDay->Visible) { // AllDay ?>
        <th class="<?= $Page->AllDay->headerCellClass() ?>"><span id="elh_res_AllDay" class="res_AllDay"><?= $Page->AllDay->caption() ?></span></th>
<?php } ?>
<?php if ($Page->GroupId->Visible) { // GroupId ?>
        <th class="<?= $Page->GroupId->headerCellClass() ?>"><span id="elh_res_GroupId" class="res_GroupId"><?= $Page->GroupId->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Url->Visible) { // Url ?>
        <th class="<?= $Page->Url->headerCellClass() ?>"><span id="elh_res_Url" class="res_Url"><?= $Page->Url->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ClassNames->Visible) { // ClassNames ?>
        <th class="<?= $Page->ClassNames->headerCellClass() ?>"><span id="elh_res_ClassNames" class="res_ClassNames"><?= $Page->ClassNames->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Display->Visible) { // Display ?>
        <th class="<?= $Page->Display->headerCellClass() ?>"><span id="elh_res_Display" class="res_Display"><?= $Page->Display->caption() ?></span></th>
<?php } ?>
<?php if ($Page->BackgroundColor->Visible) { // BackgroundColor ?>
        <th class="<?= $Page->BackgroundColor->headerCellClass() ?>"><span id="elh_res_BackgroundColor" class="res_BackgroundColor"><?= $Page->BackgroundColor->caption() ?></span></th>
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
<?php if ($Page->Id->Visible) { // Id ?>
        <td<?= $Page->Id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_Id" class="el_res_Id">
<span<?= $Page->Id->viewAttributes() ?>>
<?= $Page->Id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->_Title->Visible) { // Title ?>
        <td<?= $Page->_Title->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res__Title" class="el_res__Title">
<span<?= $Page->_Title->viewAttributes() ?>>
<?= $Page->_Title->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Start->Visible) { // Start ?>
        <td<?= $Page->Start->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_Start" class="el_res_Start">
<span<?= $Page->Start->viewAttributes() ?>>
<?= $Page->Start->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->End->Visible) { // End ?>
        <td<?= $Page->End->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_End" class="el_res_End">
<span<?= $Page->End->viewAttributes() ?>>
<?= $Page->End->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->AllDay->Visible) { // AllDay ?>
        <td<?= $Page->AllDay->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_AllDay" class="el_res_AllDay">
<span<?= $Page->AllDay->viewAttributes() ?>>
<div class="form-check d-inline-block">
    <input type="checkbox" id="x_AllDay_<?= $Page->RowCount ?>" class="form-check-input" value="<?= $Page->AllDay->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->AllDay->CurrentValue)) { ?> checked<?php } ?>>
    <label class="form-check-label" for="x_AllDay_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
<?php } ?>
<?php if ($Page->GroupId->Visible) { // GroupId ?>
        <td<?= $Page->GroupId->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_GroupId" class="el_res_GroupId">
<span<?= $Page->GroupId->viewAttributes() ?>>
<?= $Page->GroupId->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Url->Visible) { // Url ?>
        <td<?= $Page->Url->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_Url" class="el_res_Url">
<span<?= $Page->Url->viewAttributes() ?>>
<?= $Page->Url->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ClassNames->Visible) { // ClassNames ?>
        <td<?= $Page->ClassNames->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_ClassNames" class="el_res_ClassNames">
<span<?= $Page->ClassNames->viewAttributes() ?>>
<?= $Page->ClassNames->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Display->Visible) { // Display ?>
        <td<?= $Page->Display->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_Display" class="el_res_Display">
<span<?= $Page->Display->viewAttributes() ?>>
<?= $Page->Display->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->BackgroundColor->Visible) { // BackgroundColor ?>
        <td<?= $Page->BackgroundColor->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_BackgroundColor" class="el_res_BackgroundColor">
<span<?= $Page->BackgroundColor->viewAttributes() ?>>
<?= $Page->BackgroundColor->getViewValue() ?></span>
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
