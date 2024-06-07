<?php

namespace PHPMaker2023\project1;

// Set up and run Grid object
$Grid = Container("PoolratesGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fpoolratesgrid;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { poolrates: currentTable } });
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fpoolratesgrid")
        .setPageId("grid")
        .setFormKeyCountName("<?= $Grid->FormKeyCountName ?>")

        // Add fields
        .setFields([
            ["rateid", [fields.rateid.visible && fields.rateid.required ? ew.Validators.required(fields.rateid.caption) : null], fields.rateid.isInvalid],
            ["ratename", [fields.ratename.visible && fields.ratename.required ? ew.Validators.required(fields.ratename.caption) : null], fields.ratename.isInvalid],
            ["rateprice", [fields.rateprice.visible && fields.rateprice.required ? ew.Validators.required(fields.rateprice.caption) : null], fields.rateprice.isInvalid],
            ["ratearrivaltime", [fields.ratearrivaltime.visible && fields.ratearrivaltime.required ? ew.Validators.required(fields.ratearrivaltime.caption) : null], fields.ratearrivaltime.isInvalid],
            ["ratedeparturetime", [fields.ratedeparturetime.visible && fields.ratedeparturetime.required ? ew.Validators.required(fields.ratedeparturetime.caption) : null], fields.ratedeparturetime.isInvalid],
            ["pool_id", [fields.pool_id.visible && fields.pool_id.required ? ew.Validators.required(fields.pool_id.caption) : null, ew.Validators.integer], fields.pool_id.isInvalid]
        ])

        // Check empty row
        .setEmptyRow(
            function (rowIndex) {
                let fobj = this.getForm(),
                    fields = [["ratename",false],["rateprice",false],["ratearrivaltime",false],["ratedeparturetime",false],["pool_id",false]];
                if (fields.some(field => ew.valueChanged(fobj, rowIndex, ...field)))
                    return false;
                return true;
            }
        )

        // Form_CustomValidate
        .setCustomValidate(
            function (fobj) { // DO NOT CHANGE THIS LINE! (except for adding "async" keyword)!
                    // Your custom validation code here, return false if invalid.
                    return true;
                }
        )

        // Use JavaScript validation or not
        .setValidateRequired(ew.CLIENT_VALIDATE)

        // Dynamic selection lists
        .setLists({
        })
        .build();
    window[form.id] = form;
    loadjs.done(form.id);
});
</script>
<?php } ?>
<main class="list<?= ($Grid->TotalRecords == 0 && !$Grid->isAdd()) ? " ew-no-record" : "" ?>">
<div id="ew-list">
<?php if ($Grid->TotalRecords > 0 || $Grid->CurrentAction) { ?>
<div class="card ew-card ew-grid<?= $Grid->isAddOrEdit() ? " ew-grid-add-edit" : "" ?> <?= $Grid->TableGridClass ?>">
<div id="fpoolratesgrid" class="ew-form ew-list-form">
<div id="gmp_poolrates" class="card-body ew-grid-middle-panel <?= $Grid->TableContainerClass ?>" style="<?= $Grid->TableContainerStyle ?>">
<table id="tbl_poolratesgrid" class="<?= $Grid->TableClass ?>"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Grid->RowType = ROWTYPE_HEADER;

// Render list options
$Grid->renderListOptions();

// Render list options (header, left)
$Grid->ListOptions->render("header", "left");
?>
<?php if ($Grid->rateid->Visible) { // rateid ?>
        <th data-name="rateid" class="<?= $Grid->rateid->headerCellClass() ?>"><div id="elh_poolrates_rateid" class="poolrates_rateid"><?= $Grid->renderFieldHeader($Grid->rateid) ?></div></th>
<?php } ?>
<?php if ($Grid->ratename->Visible) { // ratename ?>
        <th data-name="ratename" class="<?= $Grid->ratename->headerCellClass() ?>"><div id="elh_poolrates_ratename" class="poolrates_ratename"><?= $Grid->renderFieldHeader($Grid->ratename) ?></div></th>
<?php } ?>
<?php if ($Grid->rateprice->Visible) { // rateprice ?>
        <th data-name="rateprice" class="<?= $Grid->rateprice->headerCellClass() ?>"><div id="elh_poolrates_rateprice" class="poolrates_rateprice"><?= $Grid->renderFieldHeader($Grid->rateprice) ?></div></th>
<?php } ?>
<?php if ($Grid->ratearrivaltime->Visible) { // ratearrivaltime ?>
        <th data-name="ratearrivaltime" class="<?= $Grid->ratearrivaltime->headerCellClass() ?>"><div id="elh_poolrates_ratearrivaltime" class="poolrates_ratearrivaltime"><?= $Grid->renderFieldHeader($Grid->ratearrivaltime) ?></div></th>
<?php } ?>
<?php if ($Grid->ratedeparturetime->Visible) { // ratedeparturetime ?>
        <th data-name="ratedeparturetime" class="<?= $Grid->ratedeparturetime->headerCellClass() ?>"><div id="elh_poolrates_ratedeparturetime" class="poolrates_ratedeparturetime"><?= $Grid->renderFieldHeader($Grid->ratedeparturetime) ?></div></th>
<?php } ?>
<?php if ($Grid->pool_id->Visible) { // pool_id ?>
        <th data-name="pool_id" class="<?= $Grid->pool_id->headerCellClass() ?>"><div id="elh_poolrates_pool_id" class="poolrates_pool_id"><?= $Grid->renderFieldHeader($Grid->pool_id) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Grid->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody data-page="<?= $Grid->getPageNumber() ?>">
<?php
$Grid->setupGrid();
while ($Grid->RecordCount < $Grid->StopRecord) {
    $Grid->RecordCount++;
    if ($Grid->RecordCount >= $Grid->StartRecord) {
        $Grid->setupRow();

        // Skip 1) delete row / empty row for confirm page, 2) hidden row
        if (
            $Grid->RowAction != "delete" &&
            $Grid->RowAction != "insertdelete" &&
            !($Grid->RowAction == "insert" && $Grid->isConfirm() && $Grid->emptyRow()) &&
            $Grid->RowAction != "hide"
        ) {
?>
    <tr <?= $Grid->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Grid->ListOptions->render("body", "left", $Grid->RowCount);
?>
    <?php if ($Grid->rateid->Visible) { // rateid ?>
        <td data-name="rateid"<?= $Grid->rateid->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_poolrates_rateid" class="el_poolrates_rateid"></span>
<input type="hidden" data-table="poolrates" data-field="x_rateid" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_rateid" id="o<?= $Grid->RowIndex ?>_rateid" value="<?= HtmlEncode($Grid->rateid->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_poolrates_rateid" class="el_poolrates_rateid">
<span<?= $Grid->rateid->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->rateid->getDisplayValue($Grid->rateid->EditValue))) ?>"></span>
<input type="hidden" data-table="poolrates" data-field="x_rateid" data-hidden="1" name="x<?= $Grid->RowIndex ?>_rateid" id="x<?= $Grid->RowIndex ?>_rateid" value="<?= HtmlEncode($Grid->rateid->CurrentValue) ?>">
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_poolrates_rateid" class="el_poolrates_rateid">
<span<?= $Grid->rateid->viewAttributes() ?>>
<?= $Grid->rateid->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="poolrates" data-field="x_rateid" data-hidden="1" name="fpoolratesgrid$x<?= $Grid->RowIndex ?>_rateid" id="fpoolratesgrid$x<?= $Grid->RowIndex ?>_rateid" value="<?= HtmlEncode($Grid->rateid->FormValue) ?>">
<input type="hidden" data-table="poolrates" data-field="x_rateid" data-hidden="1" data-old name="fpoolratesgrid$o<?= $Grid->RowIndex ?>_rateid" id="fpoolratesgrid$o<?= $Grid->RowIndex ?>_rateid" value="<?= HtmlEncode($Grid->rateid->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="poolrates" data-field="x_rateid" data-hidden="1" name="x<?= $Grid->RowIndex ?>_rateid" id="x<?= $Grid->RowIndex ?>_rateid" value="<?= HtmlEncode($Grid->rateid->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Grid->ratename->Visible) { // ratename ?>
        <td data-name="ratename"<?= $Grid->ratename->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_poolrates_ratename" class="el_poolrates_ratename">
<input type="<?= $Grid->ratename->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_ratename" id="x<?= $Grid->RowIndex ?>_ratename" data-table="poolrates" data-field="x_ratename" value="<?= $Grid->ratename->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->ratename->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->ratename->formatPattern()) ?>"<?= $Grid->ratename->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ratename->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="poolrates" data-field="x_ratename" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_ratename" id="o<?= $Grid->RowIndex ?>_ratename" value="<?= HtmlEncode($Grid->ratename->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_poolrates_ratename" class="el_poolrates_ratename">
<input type="<?= $Grid->ratename->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_ratename" id="x<?= $Grid->RowIndex ?>_ratename" data-table="poolrates" data-field="x_ratename" value="<?= $Grid->ratename->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->ratename->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->ratename->formatPattern()) ?>"<?= $Grid->ratename->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ratename->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_poolrates_ratename" class="el_poolrates_ratename">
<span<?= $Grid->ratename->viewAttributes() ?>>
<?= $Grid->ratename->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="poolrates" data-field="x_ratename" data-hidden="1" name="fpoolratesgrid$x<?= $Grid->RowIndex ?>_ratename" id="fpoolratesgrid$x<?= $Grid->RowIndex ?>_ratename" value="<?= HtmlEncode($Grid->ratename->FormValue) ?>">
<input type="hidden" data-table="poolrates" data-field="x_ratename" data-hidden="1" data-old name="fpoolratesgrid$o<?= $Grid->RowIndex ?>_ratename" id="fpoolratesgrid$o<?= $Grid->RowIndex ?>_ratename" value="<?= HtmlEncode($Grid->ratename->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->rateprice->Visible) { // rateprice ?>
        <td data-name="rateprice"<?= $Grid->rateprice->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_poolrates_rateprice" class="el_poolrates_rateprice">
<input type="<?= $Grid->rateprice->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_rateprice" id="x<?= $Grid->RowIndex ?>_rateprice" data-table="poolrates" data-field="x_rateprice" value="<?= $Grid->rateprice->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->rateprice->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->rateprice->formatPattern()) ?>"<?= $Grid->rateprice->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rateprice->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="poolrates" data-field="x_rateprice" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_rateprice" id="o<?= $Grid->RowIndex ?>_rateprice" value="<?= HtmlEncode($Grid->rateprice->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_poolrates_rateprice" class="el_poolrates_rateprice">
<input type="<?= $Grid->rateprice->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_rateprice" id="x<?= $Grid->RowIndex ?>_rateprice" data-table="poolrates" data-field="x_rateprice" value="<?= $Grid->rateprice->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->rateprice->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->rateprice->formatPattern()) ?>"<?= $Grid->rateprice->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rateprice->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_poolrates_rateprice" class="el_poolrates_rateprice">
<span<?= $Grid->rateprice->viewAttributes() ?>>
<?= $Grid->rateprice->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="poolrates" data-field="x_rateprice" data-hidden="1" name="fpoolratesgrid$x<?= $Grid->RowIndex ?>_rateprice" id="fpoolratesgrid$x<?= $Grid->RowIndex ?>_rateprice" value="<?= HtmlEncode($Grid->rateprice->FormValue) ?>">
<input type="hidden" data-table="poolrates" data-field="x_rateprice" data-hidden="1" data-old name="fpoolratesgrid$o<?= $Grid->RowIndex ?>_rateprice" id="fpoolratesgrid$o<?= $Grid->RowIndex ?>_rateprice" value="<?= HtmlEncode($Grid->rateprice->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->ratearrivaltime->Visible) { // ratearrivaltime ?>
        <td data-name="ratearrivaltime"<?= $Grid->ratearrivaltime->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_poolrates_ratearrivaltime" class="el_poolrates_ratearrivaltime">
<input type="<?= $Grid->ratearrivaltime->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_ratearrivaltime" id="x<?= $Grid->RowIndex ?>_ratearrivaltime" data-table="poolrates" data-field="x_ratearrivaltime" value="<?= $Grid->ratearrivaltime->EditValue ?>" size="30" maxlength="7" placeholder="<?= HtmlEncode($Grid->ratearrivaltime->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->ratearrivaltime->formatPattern()) ?>"<?= $Grid->ratearrivaltime->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ratearrivaltime->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="poolrates" data-field="x_ratearrivaltime" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_ratearrivaltime" id="o<?= $Grid->RowIndex ?>_ratearrivaltime" value="<?= HtmlEncode($Grid->ratearrivaltime->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_poolrates_ratearrivaltime" class="el_poolrates_ratearrivaltime">
<input type="<?= $Grid->ratearrivaltime->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_ratearrivaltime" id="x<?= $Grid->RowIndex ?>_ratearrivaltime" data-table="poolrates" data-field="x_ratearrivaltime" value="<?= $Grid->ratearrivaltime->EditValue ?>" size="30" maxlength="7" placeholder="<?= HtmlEncode($Grid->ratearrivaltime->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->ratearrivaltime->formatPattern()) ?>"<?= $Grid->ratearrivaltime->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ratearrivaltime->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_poolrates_ratearrivaltime" class="el_poolrates_ratearrivaltime">
<span<?= $Grid->ratearrivaltime->viewAttributes() ?>>
<?= $Grid->ratearrivaltime->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="poolrates" data-field="x_ratearrivaltime" data-hidden="1" name="fpoolratesgrid$x<?= $Grid->RowIndex ?>_ratearrivaltime" id="fpoolratesgrid$x<?= $Grid->RowIndex ?>_ratearrivaltime" value="<?= HtmlEncode($Grid->ratearrivaltime->FormValue) ?>">
<input type="hidden" data-table="poolrates" data-field="x_ratearrivaltime" data-hidden="1" data-old name="fpoolratesgrid$o<?= $Grid->RowIndex ?>_ratearrivaltime" id="fpoolratesgrid$o<?= $Grid->RowIndex ?>_ratearrivaltime" value="<?= HtmlEncode($Grid->ratearrivaltime->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->ratedeparturetime->Visible) { // ratedeparturetime ?>
        <td data-name="ratedeparturetime"<?= $Grid->ratedeparturetime->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_poolrates_ratedeparturetime" class="el_poolrates_ratedeparturetime">
<input type="<?= $Grid->ratedeparturetime->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_ratedeparturetime" id="x<?= $Grid->RowIndex ?>_ratedeparturetime" data-table="poolrates" data-field="x_ratedeparturetime" value="<?= $Grid->ratedeparturetime->EditValue ?>" size="30" maxlength="7" placeholder="<?= HtmlEncode($Grid->ratedeparturetime->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->ratedeparturetime->formatPattern()) ?>"<?= $Grid->ratedeparturetime->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ratedeparturetime->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="poolrates" data-field="x_ratedeparturetime" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_ratedeparturetime" id="o<?= $Grid->RowIndex ?>_ratedeparturetime" value="<?= HtmlEncode($Grid->ratedeparturetime->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_poolrates_ratedeparturetime" class="el_poolrates_ratedeparturetime">
<input type="<?= $Grid->ratedeparturetime->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_ratedeparturetime" id="x<?= $Grid->RowIndex ?>_ratedeparturetime" data-table="poolrates" data-field="x_ratedeparturetime" value="<?= $Grid->ratedeparturetime->EditValue ?>" size="30" maxlength="7" placeholder="<?= HtmlEncode($Grid->ratedeparturetime->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->ratedeparturetime->formatPattern()) ?>"<?= $Grid->ratedeparturetime->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ratedeparturetime->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_poolrates_ratedeparturetime" class="el_poolrates_ratedeparturetime">
<span<?= $Grid->ratedeparturetime->viewAttributes() ?>>
<?= $Grid->ratedeparturetime->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="poolrates" data-field="x_ratedeparturetime" data-hidden="1" name="fpoolratesgrid$x<?= $Grid->RowIndex ?>_ratedeparturetime" id="fpoolratesgrid$x<?= $Grid->RowIndex ?>_ratedeparturetime" value="<?= HtmlEncode($Grid->ratedeparturetime->FormValue) ?>">
<input type="hidden" data-table="poolrates" data-field="x_ratedeparturetime" data-hidden="1" data-old name="fpoolratesgrid$o<?= $Grid->RowIndex ?>_ratedeparturetime" id="fpoolratesgrid$o<?= $Grid->RowIndex ?>_ratedeparturetime" value="<?= HtmlEncode($Grid->ratedeparturetime->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->pool_id->Visible) { // pool_id ?>
        <td data-name="pool_id"<?= $Grid->pool_id->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($Grid->pool_id->getSessionValue() != "") { ?>
<span<?= $Grid->pool_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->pool_id->getDisplayValue($Grid->pool_id->ViewValue))) ?>"></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_pool_id" name="x<?= $Grid->RowIndex ?>_pool_id" value="<?= HtmlEncode($Grid->pool_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_poolrates_pool_id" class="el_poolrates_pool_id">
<input type="<?= $Grid->pool_id->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_pool_id" id="x<?= $Grid->RowIndex ?>_pool_id" data-table="poolrates" data-field="x_pool_id" value="<?= $Grid->pool_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->pool_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->pool_id->formatPattern()) ?>"<?= $Grid->pool_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->pool_id->getErrorMessage() ?></div>
</span>
<?php } ?>
<input type="hidden" data-table="poolrates" data-field="x_pool_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_pool_id" id="o<?= $Grid->RowIndex ?>_pool_id" value="<?= HtmlEncode($Grid->pool_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($Grid->pool_id->getSessionValue() != "") { ?>
<span<?= $Grid->pool_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->pool_id->getDisplayValue($Grid->pool_id->ViewValue))) ?>"></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_pool_id" name="x<?= $Grid->RowIndex ?>_pool_id" value="<?= HtmlEncode($Grid->pool_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_poolrates_pool_id" class="el_poolrates_pool_id">
<input type="<?= $Grid->pool_id->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_pool_id" id="x<?= $Grid->RowIndex ?>_pool_id" data-table="poolrates" data-field="x_pool_id" value="<?= $Grid->pool_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->pool_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->pool_id->formatPattern()) ?>"<?= $Grid->pool_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->pool_id->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_poolrates_pool_id" class="el_poolrates_pool_id">
<span<?= $Grid->pool_id->viewAttributes() ?>>
<?= $Grid->pool_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="poolrates" data-field="x_pool_id" data-hidden="1" name="fpoolratesgrid$x<?= $Grid->RowIndex ?>_pool_id" id="fpoolratesgrid$x<?= $Grid->RowIndex ?>_pool_id" value="<?= HtmlEncode($Grid->pool_id->FormValue) ?>">
<input type="hidden" data-table="poolrates" data-field="x_pool_id" data-hidden="1" data-old name="fpoolratesgrid$o<?= $Grid->RowIndex ?>_pool_id" id="fpoolratesgrid$o<?= $Grid->RowIndex ?>_pool_id" value="<?= HtmlEncode($Grid->pool_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowCount);
?>
    </tr>
<?php if ($Grid->RowType == ROWTYPE_ADD || $Grid->RowType == ROWTYPE_EDIT) { ?>
<script data-rowindex="<?= $Grid->RowIndex ?>">
loadjs.ready(["fpoolratesgrid","load"], () => fpoolratesgrid.updateLists(<?= $Grid->RowIndex ?><?= $Grid->RowIndex === '$rowindex$' ? ", true" : "" ?>));
</script>
<?php } ?>
<?php
    }
    } // End delete row checking
    if (
        $Grid->Recordset &&
        !$Grid->Recordset->EOF &&
        $Grid->RowIndex !== '$rowindex$' &&
        (!$Grid->isGridAdd() || $Grid->CurrentMode == "copy") &&
        (!(($Grid->isCopy() || $Grid->isAdd()) && $Grid->RowIndex == 0))
    ) {
        $Grid->Recordset->moveNext();
    }
    // Reset for template row
    if ($Grid->RowIndex === '$rowindex$') {
        $Grid->RowIndex = 0;
    }
    // Reset inline add/copy row
    if (($Grid->isCopy() || $Grid->isAdd()) && $Grid->RowIndex == 0) {
        $Grid->RowIndex = 1;
    }
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php if ($Grid->CurrentMode == "add" || $Grid->CurrentMode == "copy") { ?>
<input type="hidden" name="<?= $Grid->FormKeyCountName ?>" id="<?= $Grid->FormKeyCountName ?>" value="<?= $Grid->KeyCount ?>">
<?= $Grid->MultiSelectKey ?>
<?php } ?>
<?php if ($Grid->CurrentMode == "edit") { ?>
<input type="hidden" name="<?= $Grid->FormKeyCountName ?>" id="<?= $Grid->FormKeyCountName ?>" value="<?= $Grid->KeyCount ?>">
<?= $Grid->MultiSelectKey ?>
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if ($Grid->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fpoolratesgrid">
</div><!-- /.ew-list-form -->
<?php
// Close recordset
if ($Grid->Recordset) {
    $Grid->Recordset->close();
}
?>
<?php if ($Grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $Grid->OtherOptions->render("body", "bottom") ?>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } else { ?>
<div class="ew-list-other-options">
<?php $Grid->OtherOptions->render("body") ?>
</div>
<?php } ?>
</div>
</main>
<?php if (!$Grid->isExport()) { ?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("poolrates");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
