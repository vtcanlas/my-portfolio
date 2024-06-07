<?php

namespace PHPMaker2022\project1;

// Page object
$PoolcatEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { poolcat: currentTable } });
var currentForm, currentPageID;
var fpoolcatedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fpoolcatedit = new ew.Form("fpoolcatedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fpoolcatedit;

    // Add fields
    var fields = currentTable.fields;
    fpoolcatedit.addFields([
        ["cat_id", [fields.cat_id.visible && fields.cat_id.required ? ew.Validators.required(fields.cat_id.caption) : null], fields.cat_id.isInvalid],
        ["category", [fields.category.visible && fields.category.required ? ew.Validators.required(fields.category.caption) : null], fields.category.isInvalid]
    ]);

    // Form_CustomValidate
    fpoolcatedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fpoolcatedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("fpoolcatedit");
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
<form name="fpoolcatedit" id="fpoolcatedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="poolcat">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->cat_id->Visible) { // cat_id ?>
    <div id="r_cat_id"<?= $Page->cat_id->rowAttributes() ?>>
        <label id="elh_poolcat_cat_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->cat_id->caption() ?><?= $Page->cat_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->cat_id->cellAttributes() ?>>
<span id="el_poolcat_cat_id">
<span<?= $Page->cat_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->cat_id->getDisplayValue($Page->cat_id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="poolcat" data-field="x_cat_id" data-hidden="1" name="x_cat_id" id="x_cat_id" value="<?= HtmlEncode($Page->cat_id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->category->Visible) { // category ?>
    <div id="r_category"<?= $Page->category->rowAttributes() ?>>
        <label id="elh_poolcat_category" for="x_category" class="<?= $Page->LeftColumnClass ?>"><?= $Page->category->caption() ?><?= $Page->category->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->category->cellAttributes() ?>>
<span id="el_poolcat_category">
<input type="<?= $Page->category->getInputTextType() ?>" name="x_category" id="x_category" data-table="poolcat" data-field="x_category" value="<?= $Page->category->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->category->getPlaceHolder()) ?>"<?= $Page->category->editAttributes() ?> aria-describedby="x_category_help">
<?= $Page->category->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->category->getErrorMessage() ?></div>
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
    ew.addEventHandlers("poolcat");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
