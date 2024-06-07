<?php

namespace PHPMaker2022\project1;

// Page object
$ResrateTime2Edit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { resrate_time2: currentTable } });
var currentForm, currentPageID;
var fresrate_time2edit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fresrate_time2edit = new ew.Form("fresrate_time2edit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fresrate_time2edit;

    // Add fields
    var fields = currentTable.fields;
    fresrate_time2edit.addFields([
        ["time_id", [fields.time_id.visible && fields.time_id.required ? ew.Validators.required(fields.time_id.caption) : null], fields.time_id.isInvalid],
        ["pool_id", [fields.pool_id.visible && fields.pool_id.required ? ew.Validators.required(fields.pool_id.caption) : null, ew.Validators.integer], fields.pool_id.isInvalid],
        ["time", [fields.time.visible && fields.time.required ? ew.Validators.required(fields.time.caption) : null], fields.time.isInvalid]
    ]);

    // Form_CustomValidate
    fresrate_time2edit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fresrate_time2edit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("fresrate_time2edit");
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
<form name="fresrate_time2edit" id="fresrate_time2edit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="resrate_time2">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->time_id->Visible) { // time_id ?>
    <div id="r_time_id"<?= $Page->time_id->rowAttributes() ?>>
        <label id="elh_resrate_time2_time_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->time_id->caption() ?><?= $Page->time_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->time_id->cellAttributes() ?>>
<span id="el_resrate_time2_time_id">
<span<?= $Page->time_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->time_id->getDisplayValue($Page->time_id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="resrate_time2" data-field="x_time_id" data-hidden="1" name="x_time_id" id="x_time_id" value="<?= HtmlEncode($Page->time_id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->pool_id->Visible) { // pool_id ?>
    <div id="r_pool_id"<?= $Page->pool_id->rowAttributes() ?>>
        <label id="elh_resrate_time2_pool_id" for="x_pool_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pool_id->caption() ?><?= $Page->pool_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->pool_id->cellAttributes() ?>>
<span id="el_resrate_time2_pool_id">
<input type="<?= $Page->pool_id->getInputTextType() ?>" name="x_pool_id" id="x_pool_id" data-table="resrate_time2" data-field="x_pool_id" value="<?= $Page->pool_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->pool_id->getPlaceHolder()) ?>"<?= $Page->pool_id->editAttributes() ?> aria-describedby="x_pool_id_help">
<?= $Page->pool_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->pool_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->time->Visible) { // time ?>
    <div id="r_time"<?= $Page->time->rowAttributes() ?>>
        <label id="elh_resrate_time2_time" for="x_time" class="<?= $Page->LeftColumnClass ?>"><?= $Page->time->caption() ?><?= $Page->time->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->time->cellAttributes() ?>>
<span id="el_resrate_time2_time">
<input type="<?= $Page->time->getInputTextType() ?>" name="x_time" id="x_time" data-table="resrate_time2" data-field="x_time" value="<?= $Page->time->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->time->getPlaceHolder()) ?>"<?= $Page->time->editAttributes() ?> aria-describedby="x_time_help">
<?= $Page->time->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->time->getErrorMessage() ?></div>
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
    ew.addEventHandlers("resrate_time2");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
