<?php

namespace PHPMaker2022\project1;

// Page object
$Poolpics2Add = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { poolpics2: currentTable } });
var currentForm, currentPageID;
var fpoolpics2add;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fpoolpics2add = new ew.Form("fpoolpics2add", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fpoolpics2add;

    // Add fields
    var fields = currentTable.fields;
    fpoolpics2add.addFields([
        ["img", [fields.img.visible && fields.img.required ? ew.Validators.fileRequired(fields.img.caption) : null], fields.img.isInvalid],
        ["active", [fields.active.visible && fields.active.required ? ew.Validators.required(fields.active.caption) : null, ew.Validators.integer], fields.active.isInvalid]
    ]);

    // Form_CustomValidate
    fpoolpics2add.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fpoolpics2add.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("fpoolpics2add");
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
<form name="fpoolpics2add" id="fpoolpics2add" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="poolpics2">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->img->Visible) { // img ?>
    <div id="r_img"<?= $Page->img->rowAttributes() ?>>
        <label id="elh_poolpics2_img" class="<?= $Page->LeftColumnClass ?>"><?= $Page->img->caption() ?><?= $Page->img->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->img->cellAttributes() ?>>
<span id="el_poolpics2_img">
<div id="fd_x_img" class="fileinput-button ew-file-drop-zone">
    <input type="file" class="form-control ew-file-input" title="<?= $Page->img->title() ?>" data-table="poolpics2" data-field="x_img" name="x_img" id="x_img" lang="<?= CurrentLanguageID() ?>"<?= $Page->img->editAttributes() ?> aria-describedby="x_img_help"<?= ($Page->img->ReadOnly || $Page->img->Disabled) ? " disabled" : "" ?>>
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<?= $Page->img->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->img->getErrorMessage() ?></div>
<input type="hidden" name="fn_x_img" id= "fn_x_img" value="<?= $Page->img->Upload->FileName ?>">
<input type="hidden" name="fa_x_img" id= "fa_x_img" value="0">
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
        <label id="elh_poolpics2_active" for="x_active" class="<?= $Page->LeftColumnClass ?>"><?= $Page->active->caption() ?><?= $Page->active->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->active->cellAttributes() ?>>
<span id="el_poolpics2_active">
<input type="<?= $Page->active->getInputTextType() ?>" name="x_active" id="x_active" data-table="poolpics2" data-field="x_active" value="<?= $Page->active->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->active->getPlaceHolder()) ?>"<?= $Page->active->editAttributes() ?> aria-describedby="x_active_help">
<?= $Page->active->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->active->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Page->IsModal) { ?>
<div class="row"><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("AddBtn") ?></button>
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
    ew.addEventHandlers("poolpics2");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
