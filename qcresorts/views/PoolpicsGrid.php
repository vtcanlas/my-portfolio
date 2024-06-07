<?php

namespace PHPMaker2023\project1;

// Set up and run Grid object
$Grid = Container("PoolpicsGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fpoolpicsgrid;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { poolpics: currentTable } });
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fpoolpicsgrid")
        .setPageId("grid")
        .setFormKeyCountName("<?= $Grid->FormKeyCountName ?>")

        // Add fields
        .setFields([
            ["img", [fields.img.visible && fields.img.required ? ew.Validators.fileRequired(fields.img.caption) : null], fields.img.isInvalid],
            ["active", [fields.active.visible && fields.active.required ? ew.Validators.required(fields.active.caption) : null], fields.active.isInvalid]
        ])

        // Check empty row
        .setEmptyRow(
            function (rowIndex) {
                let fobj = this.getForm(),
                    fields = [["img",false],["active[]",false]];
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
            "active": <?= $Grid->active->toClientList($Grid) ?>,
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
<div id="fpoolpicsgrid" class="ew-form ew-list-form">
<div id="gmp_poolpics" class="card-body ew-grid-middle-panel <?= $Grid->TableContainerClass ?>" style="<?= $Grid->TableContainerStyle ?>">
<table id="tbl_poolpicsgrid" class="<?= $Grid->TableClass ?>"><!-- .ew-table -->
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
<?php if ($Grid->img->Visible) { // img ?>
        <th data-name="img" class="<?= $Grid->img->headerCellClass() ?>"><div id="elh_poolpics_img" class="poolpics_img"><?= $Grid->renderFieldHeader($Grid->img) ?></div></th>
<?php } ?>
<?php if ($Grid->active->Visible) { // active ?>
        <th data-name="active" class="<?= $Grid->active->headerCellClass() ?>"><div id="elh_poolpics_active" class="poolpics_active"><?= $Grid->renderFieldHeader($Grid->active) ?></div></th>
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
    <?php if ($Grid->img->Visible) { // img ?>
        <td data-name="img"<?= $Grid->img->cellAttributes() ?>>
<?php if ($Grid->RowAction == "insert") { // Add record ?>
<?php if (!$Grid->isConfirm()) { ?>
<span id="el<?= $rowIndex ?>_poolpics_img" class="el_poolpics_img">
<div id="fd_x<?= $Grid->RowIndex ?>_img" class="fileinput-button ew-file-drop-zone">
    <input
        type="file"
        id="x<?= $Grid->RowIndex ?>_img"
        name="x<?= $Grid->RowIndex ?>_img"
        class="form-control ew-file-input"
        title="<?= $Grid->img->title() ?>"
        lang="<?= CurrentLanguageID() ?>"
        data-table="poolpics"
        data-field="x_img"
        data-size="0"
        data-accept-file-types="<?= $Grid->img->acceptFileTypes() ?>"
        data-max-file-size="<?= $Grid->img->UploadMaxFileSize ?>"
        data-max-number-of-files="null"
        data-disable-image-crop="<?= $Grid->img->ImageCropper ? 0 : 1 ?>"
        <?= ($Grid->img->ReadOnly || $Grid->img->Disabled) ? " disabled" : "" ?>
        <?= $Grid->img->editAttributes() ?>
    >
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<div class="invalid-feedback"><?= $Grid->img->getErrorMessage() ?></div>
<input type="hidden" name="fn_x<?= $Grid->RowIndex ?>_img" id= "fn_x<?= $Grid->RowIndex ?>_img" value="<?= $Grid->img->Upload->FileName ?>">
<input type="hidden" name="fa_x<?= $Grid->RowIndex ?>_img" id= "fa_x<?= $Grid->RowIndex ?>_img" value="0">
<table id="ft_x<?= $Grid->RowIndex ?>_img" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php } else { ?>
<span id="el<?= $rowIndex ?>_poolpics_img" class="el_poolpics_img">
<div id="fd_x<?= $Grid->RowIndex ?>_img">
    <input
        type="file"
        id="x<?= $Grid->RowIndex ?>_img"
        name="x<?= $Grid->RowIndex ?>_img"
        class="form-control ew-file-input d-none"
        title="<?= $Grid->img->title() ?>"
        lang="<?= CurrentLanguageID() ?>"
        data-table="poolpics"
        data-field="x_img"
        data-size="0"
        data-accept-file-types="<?= $Grid->img->acceptFileTypes() ?>"
        data-max-file-size="<?= $Grid->img->UploadMaxFileSize ?>"
        data-max-number-of-files="null"
        data-disable-image-crop="<?= $Grid->img->ImageCropper ? 0 : 1 ?>"
        <?= $Grid->img->editAttributes() ?>
    >
</div>
<div class="invalid-feedback"><?= $Grid->img->getErrorMessage() ?></div>
<input type="hidden" name="fn_x<?= $Grid->RowIndex ?>_img" id= "fn_x<?= $Grid->RowIndex ?>_img" value="<?= $Grid->img->Upload->FileName ?>">
<input type="hidden" name="fa_x<?= $Grid->RowIndex ?>_img" id= "fa_x<?= $Grid->RowIndex ?>_img" value="0">
<table id="ft_x<?= $Grid->RowIndex ?>_img" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php } ?>
<input type="hidden" data-table="poolpics" data-field="x_img" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_img" id="o<?= $Grid->RowIndex ?>_img" value="<?= HtmlEncode($Grid->img->OldValue) ?>">
<?php } elseif ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_poolpics_img" class="el_poolpics_img">
<span>
<?= GetFileViewTag($Grid->img, $Grid->img->getViewValue(), false) ?>
</span>
</span>
<?php } else  { // Edit record ?>
<?php if (!$Grid->isConfirm()) { ?>
<span id="el<?= $Grid->RowCount ?>_poolpics_img" class="el_poolpics_img">
<div id="fd_x<?= $Grid->RowIndex ?>_img">
    <input
        type="file"
        id="x<?= $Grid->RowIndex ?>_img"
        name="x<?= $Grid->RowIndex ?>_img"
        class="form-control ew-file-input d-none"
        title="<?= $Grid->img->title() ?>"
        lang="<?= CurrentLanguageID() ?>"
        data-table="poolpics"
        data-field="x_img"
        data-size="0"
        data-accept-file-types="<?= $Grid->img->acceptFileTypes() ?>"
        data-max-file-size="<?= $Grid->img->UploadMaxFileSize ?>"
        data-max-number-of-files="null"
        data-disable-image-crop="<?= $Grid->img->ImageCropper ? 0 : 1 ?>"
        <?= $Grid->img->editAttributes() ?>
    >
</div>
<div class="invalid-feedback"><?= $Grid->img->getErrorMessage() ?></div>
<input type="hidden" name="fn_x<?= $Grid->RowIndex ?>_img" id= "fn_x<?= $Grid->RowIndex ?>_img" value="<?= $Grid->img->Upload->FileName ?>">
<input type="hidden" name="fa_x<?= $Grid->RowIndex ?>_img" id= "fa_x<?= $Grid->RowIndex ?>_img" value="<?= (Post("fa_x<?= $Grid->RowIndex ?>_img") == "0") ? "0" : "1" ?>">
<table id="ft_x<?= $Grid->RowIndex ?>_img" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_poolpics_img" class="el_poolpics_img">
<div id="fd_x<?= $Grid->RowIndex ?>_img">
    <input
        type="file"
        id="x<?= $Grid->RowIndex ?>_img"
        name="x<?= $Grid->RowIndex ?>_img"
        class="form-control ew-file-input d-none"
        title="<?= $Grid->img->title() ?>"
        lang="<?= CurrentLanguageID() ?>"
        data-table="poolpics"
        data-field="x_img"
        data-size="0"
        data-accept-file-types="<?= $Grid->img->acceptFileTypes() ?>"
        data-max-file-size="<?= $Grid->img->UploadMaxFileSize ?>"
        data-max-number-of-files="null"
        data-disable-image-crop="<?= $Grid->img->ImageCropper ? 0 : 1 ?>"
        <?= $Grid->img->editAttributes() ?>
    >
</div>
<div class="invalid-feedback"><?= $Grid->img->getErrorMessage() ?></div>
<input type="hidden" name="fn_x<?= $Grid->RowIndex ?>_img" id= "fn_x<?= $Grid->RowIndex ?>_img" value="<?= $Grid->img->Upload->FileName ?>">
<input type="hidden" name="fa_x<?= $Grid->RowIndex ?>_img" id= "fa_x<?= $Grid->RowIndex ?>_img" value="<?= (Post("fa_x<?= $Grid->RowIndex ?>_img") == "0") ? "0" : "1" ?>">
<table id="ft_x<?= $Grid->RowIndex ?>_img" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->active->Visible) { // active ?>
        <td data-name="active"<?= $Grid->active->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_poolpics_active" class="el_poolpics_active">
<template id="tp_x<?= $Grid->RowIndex ?>_active">
    <div class="form-check">
        <input type="checkbox" class="form-check-input" data-table="poolpics" data-field="x_active" name="x<?= $Grid->RowIndex ?>_active" id="x<?= $Grid->RowIndex ?>_active"<?= $Grid->active->editAttributes() ?>>
        <label class="form-check-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_active" class="ew-item-list"></div>
<selection-list hidden
    id="x<?= $Grid->RowIndex ?>_active[]"
    name="x<?= $Grid->RowIndex ?>_active[]"
    value="<?= HtmlEncode($Grid->active->CurrentValue) ?>"
    data-type="select-multiple"
    data-template="tp_x<?= $Grid->RowIndex ?>_active"
    data-target="dsl_x<?= $Grid->RowIndex ?>_active"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->active->isInvalidClass() ?>"
    data-table="poolpics"
    data-field="x_active"
    data-value-separator="<?= $Grid->active->displayValueSeparatorAttribute() ?>"
    <?= $Grid->active->editAttributes() ?>></selection-list>
<div class="invalid-feedback"><?= $Grid->active->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="poolpics" data-field="x_active" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_active[]" id="o<?= $Grid->RowIndex ?>_active[]" value="<?= HtmlEncode($Grid->active->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_poolpics_active" class="el_poolpics_active">
<template id="tp_x<?= $Grid->RowIndex ?>_active">
    <div class="form-check">
        <input type="checkbox" class="form-check-input" data-table="poolpics" data-field="x_active" name="x<?= $Grid->RowIndex ?>_active" id="x<?= $Grid->RowIndex ?>_active"<?= $Grid->active->editAttributes() ?>>
        <label class="form-check-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_active" class="ew-item-list"></div>
<selection-list hidden
    id="x<?= $Grid->RowIndex ?>_active[]"
    name="x<?= $Grid->RowIndex ?>_active[]"
    value="<?= HtmlEncode($Grid->active->CurrentValue) ?>"
    data-type="select-multiple"
    data-template="tp_x<?= $Grid->RowIndex ?>_active"
    data-target="dsl_x<?= $Grid->RowIndex ?>_active"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->active->isInvalidClass() ?>"
    data-table="poolpics"
    data-field="x_active"
    data-value-separator="<?= $Grid->active->displayValueSeparatorAttribute() ?>"
    <?= $Grid->active->editAttributes() ?>></selection-list>
<div class="invalid-feedback"><?= $Grid->active->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_poolpics_active" class="el_poolpics_active">
<span<?= $Grid->active->viewAttributes() ?>>
<?= $Grid->active->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="poolpics" data-field="x_active" data-hidden="1" name="fpoolpicsgrid$x<?= $Grid->RowIndex ?>_active" id="fpoolpicsgrid$x<?= $Grid->RowIndex ?>_active" value="<?= HtmlEncode($Grid->active->FormValue) ?>">
<input type="hidden" data-table="poolpics" data-field="x_active" data-hidden="1" data-old name="fpoolpicsgrid$o<?= $Grid->RowIndex ?>_active[]" id="fpoolpicsgrid$o<?= $Grid->RowIndex ?>_active[]" value="<?= HtmlEncode($Grid->active->OldValue) ?>">
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
loadjs.ready(["fpoolpicsgrid","load"], () => fpoolpicsgrid.updateLists(<?= $Grid->RowIndex ?><?= $Grid->RowIndex === '$rowindex$' ? ", true" : "" ?>));
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
<input type="hidden" name="detailpage" value="fpoolpicsgrid">
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
    ew.addEventHandlers("poolpics");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
