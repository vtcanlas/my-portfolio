<?php

namespace PHPMaker2022\project1;

// Page object
$Pool2Add = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { pool2: currentTable } });
var currentForm, currentPageID;
var fpool2add;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fpool2add = new ew.Form("fpool2add", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fpool2add;

    // Add fields
    var fields = currentTable.fields;
    fpool2add.addFields([
        ["pool_name", [fields.pool_name.visible && fields.pool_name.required ? ew.Validators.required(fields.pool_name.caption) : null], fields.pool_name.isInvalid],
        ["pool_description", [fields.pool_description.visible && fields.pool_description.required ? ew.Validators.required(fields.pool_description.caption) : null], fields.pool_description.isInvalid],
        ["barangay", [fields.barangay.visible && fields.barangay.required ? ew.Validators.required(fields.barangay.caption) : null], fields.barangay.isInvalid],
        ["poolcat", [fields.poolcat.visible && fields.poolcat.required ? ew.Validators.required(fields.poolcat.caption) : null, ew.Validators.integer], fields.poolcat.isInvalid],
        ["address", [fields.address.visible && fields.address.required ? ew.Validators.required(fields.address.caption) : null], fields.address.isInvalid],
        ["contactno1", [fields.contactno1.visible && fields.contactno1.required ? ew.Validators.required(fields.contactno1.caption) : null], fields.contactno1.isInvalid],
        ["emailaddress", [fields.emailaddress.visible && fields.emailaddress.required ? ew.Validators.required(fields.emailaddress.caption) : null], fields.emailaddress.isInvalid],
        ["socmed", [fields.socmed.visible && fields.socmed.required ? ew.Validators.required(fields.socmed.caption) : null], fields.socmed.isInvalid],
        ["uname", [fields.uname.visible && fields.uname.required ? ew.Validators.required(fields.uname.caption) : null], fields.uname.isInvalid]
    ]);

    // Form_CustomValidate
    fpool2add.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fpool2add.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("fpool2add");
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
<form name="fpool2add" id="fpool2add" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="pool2">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->pool_name->Visible) { // pool_name ?>
    <div id="r_pool_name"<?= $Page->pool_name->rowAttributes() ?>>
        <label id="elh_pool2_pool_name" for="x_pool_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pool_name->caption() ?><?= $Page->pool_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->pool_name->cellAttributes() ?>>
<span id="el_pool2_pool_name">
<input type="<?= $Page->pool_name->getInputTextType() ?>" name="x_pool_name" id="x_pool_name" data-table="pool2" data-field="x_pool_name" value="<?= $Page->pool_name->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->pool_name->getPlaceHolder()) ?>"<?= $Page->pool_name->editAttributes() ?> aria-describedby="x_pool_name_help">
<?= $Page->pool_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->pool_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->pool_description->Visible) { // pool_description ?>
    <div id="r_pool_description"<?= $Page->pool_description->rowAttributes() ?>>
        <label id="elh_pool2_pool_description" for="x_pool_description" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pool_description->caption() ?><?= $Page->pool_description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->pool_description->cellAttributes() ?>>
<span id="el_pool2_pool_description">
<input type="<?= $Page->pool_description->getInputTextType() ?>" name="x_pool_description" id="x_pool_description" data-table="pool2" data-field="x_pool_description" value="<?= $Page->pool_description->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->pool_description->getPlaceHolder()) ?>"<?= $Page->pool_description->editAttributes() ?> aria-describedby="x_pool_description_help">
<?= $Page->pool_description->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->pool_description->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->barangay->Visible) { // barangay ?>
    <div id="r_barangay"<?= $Page->barangay->rowAttributes() ?>>
        <label id="elh_pool2_barangay" for="x_barangay" class="<?= $Page->LeftColumnClass ?>"><?= $Page->barangay->caption() ?><?= $Page->barangay->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->barangay->cellAttributes() ?>>
<span id="el_pool2_barangay">
<input type="<?= $Page->barangay->getInputTextType() ?>" name="x_barangay" id="x_barangay" data-table="pool2" data-field="x_barangay" value="<?= $Page->barangay->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->barangay->getPlaceHolder()) ?>"<?= $Page->barangay->editAttributes() ?> aria-describedby="x_barangay_help">
<?= $Page->barangay->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->barangay->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->poolcat->Visible) { // poolcat ?>
    <div id="r_poolcat"<?= $Page->poolcat->rowAttributes() ?>>
        <label id="elh_pool2_poolcat" for="x_poolcat" class="<?= $Page->LeftColumnClass ?>"><?= $Page->poolcat->caption() ?><?= $Page->poolcat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->poolcat->cellAttributes() ?>>
<span id="el_pool2_poolcat">
<input type="<?= $Page->poolcat->getInputTextType() ?>" name="x_poolcat" id="x_poolcat" data-table="pool2" data-field="x_poolcat" value="<?= $Page->poolcat->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->poolcat->getPlaceHolder()) ?>"<?= $Page->poolcat->editAttributes() ?> aria-describedby="x_poolcat_help">
<?= $Page->poolcat->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->poolcat->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->address->Visible) { // address ?>
    <div id="r_address"<?= $Page->address->rowAttributes() ?>>
        <label id="elh_pool2_address" for="x_address" class="<?= $Page->LeftColumnClass ?>"><?= $Page->address->caption() ?><?= $Page->address->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->address->cellAttributes() ?>>
<span id="el_pool2_address">
<input type="<?= $Page->address->getInputTextType() ?>" name="x_address" id="x_address" data-table="pool2" data-field="x_address" value="<?= $Page->address->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->address->getPlaceHolder()) ?>"<?= $Page->address->editAttributes() ?> aria-describedby="x_address_help">
<?= $Page->address->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->address->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->contactno1->Visible) { // contactno1 ?>
    <div id="r_contactno1"<?= $Page->contactno1->rowAttributes() ?>>
        <label id="elh_pool2_contactno1" for="x_contactno1" class="<?= $Page->LeftColumnClass ?>"><?= $Page->contactno1->caption() ?><?= $Page->contactno1->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->contactno1->cellAttributes() ?>>
<span id="el_pool2_contactno1">
<input type="<?= $Page->contactno1->getInputTextType() ?>" name="x_contactno1" id="x_contactno1" data-table="pool2" data-field="x_contactno1" value="<?= $Page->contactno1->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->contactno1->getPlaceHolder()) ?>"<?= $Page->contactno1->editAttributes() ?> aria-describedby="x_contactno1_help">
<?= $Page->contactno1->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->contactno1->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->emailaddress->Visible) { // emailaddress ?>
    <div id="r_emailaddress"<?= $Page->emailaddress->rowAttributes() ?>>
        <label id="elh_pool2_emailaddress" for="x_emailaddress" class="<?= $Page->LeftColumnClass ?>"><?= $Page->emailaddress->caption() ?><?= $Page->emailaddress->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->emailaddress->cellAttributes() ?>>
<span id="el_pool2_emailaddress">
<input type="<?= $Page->emailaddress->getInputTextType() ?>" name="x_emailaddress" id="x_emailaddress" data-table="pool2" data-field="x_emailaddress" value="<?= $Page->emailaddress->EditValue ?>" size="30" maxlength="250" placeholder="<?= HtmlEncode($Page->emailaddress->getPlaceHolder()) ?>"<?= $Page->emailaddress->editAttributes() ?> aria-describedby="x_emailaddress_help">
<?= $Page->emailaddress->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->emailaddress->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->socmed->Visible) { // socmed ?>
    <div id="r_socmed"<?= $Page->socmed->rowAttributes() ?>>
        <label id="elh_pool2_socmed" for="x_socmed" class="<?= $Page->LeftColumnClass ?>"><?= $Page->socmed->caption() ?><?= $Page->socmed->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->socmed->cellAttributes() ?>>
<span id="el_pool2_socmed">
<input type="<?= $Page->socmed->getInputTextType() ?>" name="x_socmed" id="x_socmed" data-table="pool2" data-field="x_socmed" value="<?= $Page->socmed->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->socmed->getPlaceHolder()) ?>"<?= $Page->socmed->editAttributes() ?> aria-describedby="x_socmed_help">
<?= $Page->socmed->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->socmed->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->uname->Visible) { // uname ?>
    <div id="r_uname"<?= $Page->uname->rowAttributes() ?>>
        <label id="elh_pool2_uname" for="x_uname" class="<?= $Page->LeftColumnClass ?>"><?= $Page->uname->caption() ?><?= $Page->uname->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->uname->cellAttributes() ?>>
<span id="el_pool2_uname">
<input type="<?= $Page->uname->getInputTextType() ?>" name="x_uname" id="x_uname" data-table="pool2" data-field="x_uname" value="<?= $Page->uname->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->uname->getPlaceHolder()) ?>"<?= $Page->uname->editAttributes() ?> aria-describedby="x_uname_help">
<?= $Page->uname->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->uname->getErrorMessage() ?></div>
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
    ew.addEventHandlers("pool2");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
