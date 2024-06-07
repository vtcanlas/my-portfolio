<?php

namespace PHPMaker2023\project1;

// Page object
$PoolratesEdit = &$Page;
?>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<form name="fpoolratesedit" id="fpoolratesedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { poolrates: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fpoolratesedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fpoolratesedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["ratename", [fields.ratename.visible && fields.ratename.required ? ew.Validators.required(fields.ratename.caption) : null], fields.ratename.isInvalid],
            ["ratedesc", [fields.ratedesc.visible && fields.ratedesc.required ? ew.Validators.required(fields.ratedesc.caption) : null], fields.ratedesc.isInvalid],
            ["rateprice", [fields.rateprice.visible && fields.rateprice.required ? ew.Validators.required(fields.rateprice.caption) : null], fields.rateprice.isInvalid],
            ["ratearrivaltime", [fields.ratearrivaltime.visible && fields.ratearrivaltime.required ? ew.Validators.required(fields.ratearrivaltime.caption) : null], fields.ratearrivaltime.isInvalid],
            ["ratedeparturetime", [fields.ratedeparturetime.visible && fields.ratedeparturetime.required ? ew.Validators.required(fields.ratedeparturetime.caption) : null], fields.ratedeparturetime.isInvalid],
            ["pool_id", [fields.pool_id.visible && fields.pool_id.required ? ew.Validators.required(fields.pool_id.caption) : null, ew.Validators.integer], fields.pool_id.isInvalid]
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
        })
        .build();
    window[form.id] = form;
    currentForm = form;
    loadjs.done(form.id);
});
</script>
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="poolrates">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "tbl_resort_details") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="tbl_resort_details">
<input type="hidden" name="fk_pool_id" value="<?= HtmlEncode($Page->pool_id->getSessionValue()) ?>">
<?php } ?>
<?php if ($Page->getCurrentMasterTable() == "pool") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="pool">
<input type="hidden" name="fk_pool_id" value="<?= HtmlEncode($Page->pool_id->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->ratename->Visible) { // ratename ?>
    <div id="r_ratename"<?= $Page->ratename->rowAttributes() ?>>
        <label id="elh_poolrates_ratename" for="x_ratename" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ratename->caption() ?><?= $Page->ratename->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->ratename->cellAttributes() ?>>
<span id="el_poolrates_ratename">
<input type="<?= $Page->ratename->getInputTextType() ?>" name="x_ratename" id="x_ratename" data-table="poolrates" data-field="x_ratename" value="<?= $Page->ratename->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->ratename->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->ratename->formatPattern()) ?>"<?= $Page->ratename->editAttributes() ?> aria-describedby="x_ratename_help">
<?= $Page->ratename->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ratename->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ratedesc->Visible) { // ratedesc ?>
    <div id="r_ratedesc"<?= $Page->ratedesc->rowAttributes() ?>>
        <label id="elh_poolrates_ratedesc" for="x_ratedesc" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ratedesc->caption() ?><?= $Page->ratedesc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->ratedesc->cellAttributes() ?>>
<span id="el_poolrates_ratedesc">
<textarea data-table="poolrates" data-field="x_ratedesc" name="x_ratedesc" id="x_ratedesc" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->ratedesc->getPlaceHolder()) ?>"<?= $Page->ratedesc->editAttributes() ?> aria-describedby="x_ratedesc_help"><?= $Page->ratedesc->EditValue ?></textarea>
<?= $Page->ratedesc->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ratedesc->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->rateprice->Visible) { // rateprice ?>
    <div id="r_rateprice"<?= $Page->rateprice->rowAttributes() ?>>
        <label id="elh_poolrates_rateprice" for="x_rateprice" class="<?= $Page->LeftColumnClass ?>"><?= $Page->rateprice->caption() ?><?= $Page->rateprice->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->rateprice->cellAttributes() ?>>
<span id="el_poolrates_rateprice">
<input type="<?= $Page->rateprice->getInputTextType() ?>" name="x_rateprice" id="x_rateprice" data-table="poolrates" data-field="x_rateprice" value="<?= $Page->rateprice->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->rateprice->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->rateprice->formatPattern()) ?>"<?= $Page->rateprice->editAttributes() ?> aria-describedby="x_rateprice_help">
<?= $Page->rateprice->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->rateprice->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ratearrivaltime->Visible) { // ratearrivaltime ?>
    <div id="r_ratearrivaltime"<?= $Page->ratearrivaltime->rowAttributes() ?>>
        <label id="elh_poolrates_ratearrivaltime" for="x_ratearrivaltime" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ratearrivaltime->caption() ?><?= $Page->ratearrivaltime->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->ratearrivaltime->cellAttributes() ?>>
<span id="el_poolrates_ratearrivaltime">
<input type="<?= $Page->ratearrivaltime->getInputTextType() ?>" name="x_ratearrivaltime" id="x_ratearrivaltime" data-table="poolrates" data-field="x_ratearrivaltime" value="<?= $Page->ratearrivaltime->EditValue ?>" size="30" maxlength="7" placeholder="<?= HtmlEncode($Page->ratearrivaltime->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->ratearrivaltime->formatPattern()) ?>"<?= $Page->ratearrivaltime->editAttributes() ?> aria-describedby="x_ratearrivaltime_help">
<?= $Page->ratearrivaltime->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ratearrivaltime->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ratedeparturetime->Visible) { // ratedeparturetime ?>
    <div id="r_ratedeparturetime"<?= $Page->ratedeparturetime->rowAttributes() ?>>
        <label id="elh_poolrates_ratedeparturetime" for="x_ratedeparturetime" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ratedeparturetime->caption() ?><?= $Page->ratedeparturetime->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->ratedeparturetime->cellAttributes() ?>>
<span id="el_poolrates_ratedeparturetime">
<input type="<?= $Page->ratedeparturetime->getInputTextType() ?>" name="x_ratedeparturetime" id="x_ratedeparturetime" data-table="poolrates" data-field="x_ratedeparturetime" value="<?= $Page->ratedeparturetime->EditValue ?>" size="30" maxlength="7" placeholder="<?= HtmlEncode($Page->ratedeparturetime->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->ratedeparturetime->formatPattern()) ?>"<?= $Page->ratedeparturetime->editAttributes() ?> aria-describedby="x_ratedeparturetime_help">
<?= $Page->ratedeparturetime->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ratedeparturetime->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->pool_id->Visible) { // pool_id ?>
    <div id="r_pool_id"<?= $Page->pool_id->rowAttributes() ?>>
        <label id="elh_poolrates_pool_id" for="x_pool_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pool_id->caption() ?><?= $Page->pool_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->pool_id->cellAttributes() ?>>
<?php if ($Page->pool_id->getSessionValue() != "") { ?>
<span<?= $Page->pool_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->pool_id->getDisplayValue($Page->pool_id->ViewValue))) ?>"></span>
<input type="hidden" id="x_pool_id" name="x_pool_id" value="<?= HtmlEncode($Page->pool_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el_poolrates_pool_id">
<input type="<?= $Page->pool_id->getInputTextType() ?>" name="x_pool_id" id="x_pool_id" data-table="poolrates" data-field="x_pool_id" value="<?= $Page->pool_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->pool_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->pool_id->formatPattern()) ?>"<?= $Page->pool_id->editAttributes() ?> aria-describedby="x_pool_id_help">
<?= $Page->pool_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->pool_id->getErrorMessage() ?></div>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
    <input type="hidden" data-table="poolrates" data-field="x_rateid" data-hidden="1" name="x_rateid" id="x_rateid" value="<?= HtmlEncode($Page->rateid->CurrentValue) ?>">
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fpoolratesedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fpoolratesedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
<?php } ?>
    </div><!-- /buttons offset -->
<?= $Page->IsModal ? "</template>" : "</div>" ?><!-- /buttons .row -->
</form>
</main>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
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
