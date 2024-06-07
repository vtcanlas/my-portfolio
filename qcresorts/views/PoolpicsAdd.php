<?php

namespace PHPMaker2023\project1;

// Page object
$PoolpicsAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { poolpics: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fpoolpicsadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fpoolpicsadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["img", [fields.img.visible && fields.img.required ? ew.Validators.fileRequired(fields.img.caption) : null], fields.img.isInvalid],
            ["active", [fields.active.visible && fields.active.required ? ew.Validators.required(fields.active.caption) : null], fields.active.isInvalid],
            ["pool_id", [fields.pool_id.visible && fields.pool_id.required ? ew.Validators.required(fields.pool_id.caption) : null], fields.pool_id.isInvalid]
        ])

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
            "active": <?= $Page->active->toClientList($Page) ?>,
            "pool_id": <?= $Page->pool_id->toClientList($Page) ?>,
        })
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
<form name="fpoolpicsadd" id="fpoolpicsadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="poolpics">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "pool") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="pool">
<input type="hidden" name="fk_pool_id" value="<?= HtmlEncode($Page->pool_id->getSessionValue()) ?>">
<?php } ?>
<?php if ($Page->getCurrentMasterTable() == "tbl_resort_details") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="tbl_resort_details">
<input type="hidden" name="fk_pool_id" value="<?= HtmlEncode($Page->pool_id->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->img->Visible) { // img ?>
    <div id="r_img"<?= $Page->img->rowAttributes() ?>>
        <label id="elh_poolpics_img" class="<?= $Page->LeftColumnClass ?>"><?= $Page->img->caption() ?><?= $Page->img->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->img->cellAttributes() ?>>
<span id="el_poolpics_img">
<div id="fd_x_img" class="fileinput-button ew-file-drop-zone">
    <input
        type="file"
        id="x_img"
        name="x_img"
        class="form-control ew-file-input"
        title="<?= $Page->img->title() ?>"
        lang="<?= CurrentLanguageID() ?>"
        data-table="poolpics"
        data-field="x_img"
        data-size="0"
        data-accept-file-types="<?= $Page->img->acceptFileTypes() ?>"
        data-max-file-size="<?= $Page->img->UploadMaxFileSize ?>"
        data-max-number-of-files="null"
        data-disable-image-crop="<?= $Page->img->ImageCropper ? 0 : 1 ?>"
        aria-describedby="x_img_help"
        <?= ($Page->img->ReadOnly || $Page->img->Disabled) ? " disabled" : "" ?>
        <?= $Page->img->editAttributes() ?>
    >
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<?= $Page->img->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->img->getErrorMessage() ?></div>
<input type="hidden" name="fn_x_img" id= "fn_x_img" value="<?= $Page->img->Upload->FileName ?>">
<input type="hidden" name="fa_x_img" id= "fa_x_img" value="0">
<table id="ft_x_img" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->active->Visible) { // active ?>
    <div id="r_active"<?= $Page->active->rowAttributes() ?>>
        <label id="elh_poolpics_active" class="<?= $Page->LeftColumnClass ?>"><?= $Page->active->caption() ?><?= $Page->active->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->active->cellAttributes() ?>>
<span id="el_poolpics_active">
<template id="tp_x_active">
    <div class="form-check">
        <input type="checkbox" class="form-check-input" data-table="poolpics" data-field="x_active" name="x_active" id="x_active"<?= $Page->active->editAttributes() ?>>
        <label class="form-check-label"></label>
    </div>
</template>
<div id="dsl_x_active" class="ew-item-list"></div>
<selection-list hidden
    id="x_active[]"
    name="x_active[]"
    value="<?= HtmlEncode($Page->active->CurrentValue) ?>"
    data-type="select-multiple"
    data-template="tp_x_active"
    data-target="dsl_x_active"
    data-repeatcolumn="5"
    class="form-control<?= $Page->active->isInvalidClass() ?>"
    data-table="poolpics"
    data-field="x_active"
    data-value-separator="<?= $Page->active->displayValueSeparatorAttribute() ?>"
    <?= $Page->active->editAttributes() ?>></selection-list>
<?= $Page->active->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->active->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->pool_id->Visible) { // pool_id ?>
    <div id="r_pool_id"<?= $Page->pool_id->rowAttributes() ?>>
        <label id="elh_poolpics_pool_id" for="x_pool_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pool_id->caption() ?><?= $Page->pool_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->pool_id->cellAttributes() ?>>
<?php if ($Page->pool_id->getSessionValue() != "") { ?>
<span<?= $Page->pool_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Page->pool_id->getDisplayValue($Page->pool_id->ViewValue) ?></span></span>
<input type="hidden" id="x_pool_id" name="x_pool_id" value="<?= HtmlEncode($Page->pool_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el_poolpics_pool_id">
    <select
        id="x_pool_id"
        name="x_pool_id"
        class="form-select ew-select<?= $Page->pool_id->isInvalidClass() ?>"
        data-select2-id="fpoolpicsadd_x_pool_id"
        data-table="poolpics"
        data-field="x_pool_id"
        data-value-separator="<?= $Page->pool_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->pool_id->getPlaceHolder()) ?>"
        <?= $Page->pool_id->editAttributes() ?>>
        <?= $Page->pool_id->selectOptionListHtml("x_pool_id") ?>
    </select>
    <?= $Page->pool_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->pool_id->getErrorMessage() ?></div>
<?= $Page->pool_id->Lookup->getParamTag($Page, "p_x_pool_id") ?>
<script>
loadjs.ready("fpoolpicsadd", function() {
    var options = { name: "x_pool_id", selectId: "fpoolpicsadd_x_pool_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fpoolpicsadd.lists.pool_id?.lookupOptions.length) {
        options.data = { id: "x_pool_id", form: "fpoolpicsadd" };
    } else {
        options.ajax = { id: "x_pool_id", form: "fpoolpicsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.poolpics.fields.pool_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fpoolpicsadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fpoolpicsadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
<?php } ?>
    </div><!-- /buttons offset -->
<?= $Page->IsModal ? "</template>" : "</div>" ?><!-- /buttons .row -->
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
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
