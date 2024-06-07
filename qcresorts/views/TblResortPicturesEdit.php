<?php

namespace PHPMaker2022\project1;

// Page object
$TblResortPicturesEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { tbl_resort_pictures: currentTable } });
var currentForm, currentPageID;
var ftbl_resort_picturesedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    ftbl_resort_picturesedit = new ew.Form("ftbl_resort_picturesedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = ftbl_resort_picturesedit;

    // Add fields
    var fields = currentTable.fields;
    ftbl_resort_picturesedit.addFields([
        ["pic_id", [fields.pic_id.visible && fields.pic_id.required ? ew.Validators.required(fields.pic_id.caption) : null], fields.pic_id.isInvalid],
        ["img", [fields.img.visible && fields.img.required ? ew.Validators.fileRequired(fields.img.caption) : null], fields.img.isInvalid],
        ["active", [fields.active.visible && fields.active.required ? ew.Validators.required(fields.active.caption) : null], fields.active.isInvalid],
        ["pool_id", [fields.pool_id.visible && fields.pool_id.required ? ew.Validators.required(fields.pool_id.caption) : null], fields.pool_id.isInvalid]
    ]);

    // Form_CustomValidate
    ftbl_resort_picturesedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    ftbl_resort_picturesedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    ftbl_resort_picturesedit.lists.active = <?= $Page->active->toClientList($Page) ?>;
    ftbl_resort_picturesedit.lists.pool_id = <?= $Page->pool_id->toClientList($Page) ?>;
    loadjs.done("ftbl_resort_picturesedit");
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
<form name="ftbl_resort_picturesedit" id="ftbl_resort_picturesedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="tbl_resort_pictures">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->pic_id->Visible) { // pic_id ?>
    <div id="r_pic_id"<?= $Page->pic_id->rowAttributes() ?>>
        <label id="elh_tbl_resort_pictures_pic_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pic_id->caption() ?><?= $Page->pic_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->pic_id->cellAttributes() ?>>
<span id="el_tbl_resort_pictures_pic_id">
<span<?= $Page->pic_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->pic_id->getDisplayValue($Page->pic_id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="tbl_resort_pictures" data-field="x_pic_id" data-hidden="1" name="x_pic_id" id="x_pic_id" value="<?= HtmlEncode($Page->pic_id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->img->Visible) { // img ?>
    <div id="r_img"<?= $Page->img->rowAttributes() ?>>
        <label id="elh_tbl_resort_pictures_img" class="<?= $Page->LeftColumnClass ?>"><?= $Page->img->caption() ?><?= $Page->img->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->img->cellAttributes() ?>>
<span id="el_tbl_resort_pictures_img">
<div id="fd_x_img" class="fileinput-button ew-file-drop-zone">
    <input type="file" class="form-control ew-file-input" title="<?= $Page->img->title() ?>" data-table="tbl_resort_pictures" data-field="x_img" name="x_img" id="x_img" lang="<?= CurrentLanguageID() ?>"<?= $Page->img->editAttributes() ?> aria-describedby="x_img_help"<?= ($Page->img->ReadOnly || $Page->img->Disabled) ? " disabled" : "" ?>>
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<?= $Page->img->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->img->getErrorMessage() ?></div>
<input type="hidden" name="fn_x_img" id= "fn_x_img" value="<?= $Page->img->Upload->FileName ?>">
<input type="hidden" name="fa_x_img" id= "fa_x_img" value="<?= (Post("fa_x_img") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_img" id= "fs_x_img" value="0">
<input type="hidden" name="fx_x_img" id= "fx_x_img" value="<?= $Page->img->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_img" id= "fm_x_img" value="<?= $Page->img->UploadMaxFileSize ?>">
<table id="ft_x_img" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->active->Visible) { // active ?>
    <div id="r_active"<?= $Page->active->rowAttributes() ?>>
        <label id="elh_tbl_resort_pictures_active" class="<?= $Page->LeftColumnClass ?>"><?= $Page->active->caption() ?><?= $Page->active->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->active->cellAttributes() ?>>
<span id="el_tbl_resort_pictures_active">
<template id="tp_x_active">
    <div class="form-check">
        <input type="checkbox" class="form-check-input" data-table="tbl_resort_pictures" data-field="x_active" name="x_active" id="x_active"<?= $Page->active->editAttributes() ?>>
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
    data-bs-target="dsl_x_active"
    data-repeatcolumn="5"
    class="form-control<?= $Page->active->isInvalidClass() ?>"
    data-table="tbl_resort_pictures"
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
        <label id="elh_tbl_resort_pictures_pool_id" for="x_pool_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pool_id->caption() ?><?= $Page->pool_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->pool_id->cellAttributes() ?>>
<span id="el_tbl_resort_pictures_pool_id">
    <select
        id="x_pool_id"
        name="x_pool_id"
        class="form-select ew-select<?= $Page->pool_id->isInvalidClass() ?>"
        data-select2-id="ftbl_resort_picturesedit_x_pool_id"
        data-table="tbl_resort_pictures"
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
loadjs.ready("ftbl_resort_picturesedit", function() {
    var options = { name: "x_pool_id", selectId: "ftbl_resort_picturesedit_x_pool_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (ftbl_resort_picturesedit.lists.pool_id.lookupOptions.length) {
        options.data = { id: "x_pool_id", form: "ftbl_resort_picturesedit" };
    } else {
        options.ajax = { id: "x_pool_id", form: "ftbl_resort_picturesedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.tbl_resort_pictures.fields.pool_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Page->IsModal) { ?>
<div class="row"><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
    </div><!-- /buttons offset -->
</div><!-- /buttons .row -->
<?php } ?>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("tbl_resort_pictures");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
