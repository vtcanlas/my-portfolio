<?php

namespace PHPMaker2022\project1;

// Page object
$CreateReservationEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { CreateReservation: currentTable } });
var currentForm, currentPageID;
var fCreateReservationedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fCreateReservationedit = new ew.Form("fCreateReservationedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fCreateReservationedit;

    // Add fields
    var fields = currentTable.fields;
    fCreateReservationedit.addFields([
        ["res_id", [fields.res_id.visible && fields.res_id.required ? ew.Validators.required(fields.res_id.caption) : null], fields.res_id.isInvalid],
        ["fname", [fields.fname.visible && fields.fname.required ? ew.Validators.required(fields.fname.caption) : null], fields.fname.isInvalid],
        ["lname", [fields.lname.visible && fields.lname.required ? ew.Validators.required(fields.lname.caption) : null], fields.lname.isInvalid],
        ["address", [fields.address.visible && fields.address.required ? ew.Validators.required(fields.address.caption) : null], fields.address.isInvalid],
        ["contactno", [fields.contactno.visible && fields.contactno.required ? ew.Validators.required(fields.contactno.caption) : null], fields.contactno.isInvalid],
        ["_email", [fields._email.visible && fields._email.required ? ew.Validators.required(fields._email.caption) : null], fields._email.isInvalid],
        ["pool_id", [fields.pool_id.visible && fields.pool_id.required ? ew.Validators.required(fields.pool_id.caption) : null], fields.pool_id.isInvalid],
        ["proofofpayment", [fields.proofofpayment.visible && fields.proofofpayment.required ? ew.Validators.fileRequired(fields.proofofpayment.caption) : null], fields.proofofpayment.isInvalid],
        ["date", [fields.date.visible && fields.date.required ? ew.Validators.required(fields.date.caption) : null, ew.Validators.datetime(fields.date.clientFormatPattern)], fields.date.isInvalid],
        ["rate_id", [fields.rate_id.visible && fields.rate_id.required ? ew.Validators.required(fields.rate_id.caption) : null, ew.Validators.integer], fields.rate_id.isInvalid],
        ["amountpaid", [fields.amountpaid.visible && fields.amountpaid.required ? ew.Validators.required(fields.amountpaid.caption) : null], fields.amountpaid.isInvalid],
        ["dateuploaded", [fields.dateuploaded.visible && fields.dateuploaded.required ? ew.Validators.required(fields.dateuploaded.caption) : null], fields.dateuploaded.isInvalid]
    ]);

    // Form_CustomValidate
    fCreateReservationedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fCreateReservationedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fCreateReservationedit.lists.pool_id = <?= $Page->pool_id->toClientList($Page) ?>;
    loadjs.done("fCreateReservationedit");
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
<form name="fCreateReservationedit" id="fCreateReservationedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="CreateReservation">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->res_id->Visible) { // res_id ?>
    <div id="r_res_id"<?= $Page->res_id->rowAttributes() ?>>
        <label id="elh_CreateReservation_res_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->res_id->caption() ?><?= $Page->res_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->res_id->cellAttributes() ?>>
<span id="el_CreateReservation_res_id">
<span<?= $Page->res_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->res_id->getDisplayValue($Page->res_id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="CreateReservation" data-field="x_res_id" data-hidden="1" name="x_res_id" id="x_res_id" value="<?= HtmlEncode($Page->res_id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->fname->Visible) { // fname ?>
    <div id="r_fname"<?= $Page->fname->rowAttributes() ?>>
        <label id="elh_CreateReservation_fname" for="x_fname" class="<?= $Page->LeftColumnClass ?>"><?= $Page->fname->caption() ?><?= $Page->fname->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->fname->cellAttributes() ?>>
<span id="el_CreateReservation_fname">
<input type="<?= $Page->fname->getInputTextType() ?>" name="x_fname" id="x_fname" data-table="CreateReservation" data-field="x_fname" value="<?= $Page->fname->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->fname->getPlaceHolder()) ?>"<?= $Page->fname->editAttributes() ?> aria-describedby="x_fname_help">
<?= $Page->fname->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->fname->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->lname->Visible) { // lname ?>
    <div id="r_lname"<?= $Page->lname->rowAttributes() ?>>
        <label id="elh_CreateReservation_lname" for="x_lname" class="<?= $Page->LeftColumnClass ?>"><?= $Page->lname->caption() ?><?= $Page->lname->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->lname->cellAttributes() ?>>
<span id="el_CreateReservation_lname">
<input type="<?= $Page->lname->getInputTextType() ?>" name="x_lname" id="x_lname" data-table="CreateReservation" data-field="x_lname" value="<?= $Page->lname->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->lname->getPlaceHolder()) ?>"<?= $Page->lname->editAttributes() ?> aria-describedby="x_lname_help">
<?= $Page->lname->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->lname->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->address->Visible) { // address ?>
    <div id="r_address"<?= $Page->address->rowAttributes() ?>>
        <label id="elh_CreateReservation_address" for="x_address" class="<?= $Page->LeftColumnClass ?>"><?= $Page->address->caption() ?><?= $Page->address->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->address->cellAttributes() ?>>
<span id="el_CreateReservation_address">
<input type="<?= $Page->address->getInputTextType() ?>" name="x_address" id="x_address" data-table="CreateReservation" data-field="x_address" value="<?= $Page->address->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->address->getPlaceHolder()) ?>"<?= $Page->address->editAttributes() ?> aria-describedby="x_address_help">
<?= $Page->address->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->address->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->contactno->Visible) { // contactno ?>
    <div id="r_contactno"<?= $Page->contactno->rowAttributes() ?>>
        <label id="elh_CreateReservation_contactno" for="x_contactno" class="<?= $Page->LeftColumnClass ?>"><?= $Page->contactno->caption() ?><?= $Page->contactno->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->contactno->cellAttributes() ?>>
<span id="el_CreateReservation_contactno">
<input type="<?= $Page->contactno->getInputTextType() ?>" name="x_contactno" id="x_contactno" data-table="CreateReservation" data-field="x_contactno" value="<?= $Page->contactno->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->contactno->getPlaceHolder()) ?>"<?= $Page->contactno->editAttributes() ?> aria-describedby="x_contactno_help">
<?= $Page->contactno->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->contactno->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
    <div id="r__email"<?= $Page->_email->rowAttributes() ?>>
        <label id="elh_CreateReservation__email" for="x__email" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_email->caption() ?><?= $Page->_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->_email->cellAttributes() ?>>
<span id="el_CreateReservation__email">
<input type="<?= $Page->_email->getInputTextType() ?>" name="x__email" id="x__email" data-table="CreateReservation" data-field="x__email" value="<?= $Page->_email->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->_email->getPlaceHolder()) ?>"<?= $Page->_email->editAttributes() ?> aria-describedby="x__email_help">
<?= $Page->_email->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_email->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->pool_id->Visible) { // pool_id ?>
    <div id="r_pool_id"<?= $Page->pool_id->rowAttributes() ?>>
        <label id="elh_CreateReservation_pool_id" for="x_pool_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pool_id->caption() ?><?= $Page->pool_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->pool_id->cellAttributes() ?>>
<span id="el_CreateReservation_pool_id">
    <select
        id="x_pool_id"
        name="x_pool_id"
        class="form-select ew-select<?= $Page->pool_id->isInvalidClass() ?>"
        data-select2-id="fCreateReservationedit_x_pool_id"
        data-table="CreateReservation"
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
loadjs.ready("fCreateReservationedit", function() {
    var options = { name: "x_pool_id", selectId: "fCreateReservationedit_x_pool_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fCreateReservationedit.lists.pool_id.lookupOptions.length) {
        options.data = { id: "x_pool_id", form: "fCreateReservationedit" };
    } else {
        options.ajax = { id: "x_pool_id", form: "fCreateReservationedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.CreateReservation.fields.pool_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->proofofpayment->Visible) { // proofofpayment ?>
    <div id="r_proofofpayment"<?= $Page->proofofpayment->rowAttributes() ?>>
        <label id="elh_CreateReservation_proofofpayment" class="<?= $Page->LeftColumnClass ?>"><?= $Page->proofofpayment->caption() ?><?= $Page->proofofpayment->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->proofofpayment->cellAttributes() ?>>
<span id="el_CreateReservation_proofofpayment">
<div id="fd_x_proofofpayment" class="fileinput-button ew-file-drop-zone">
    <input type="file" class="form-control ew-file-input" title="<?= $Page->proofofpayment->title() ?>" data-table="CreateReservation" data-field="x_proofofpayment" name="x_proofofpayment" id="x_proofofpayment" lang="<?= CurrentLanguageID() ?>"<?= $Page->proofofpayment->editAttributes() ?> aria-describedby="x_proofofpayment_help"<?= ($Page->proofofpayment->ReadOnly || $Page->proofofpayment->Disabled) ? " disabled" : "" ?>>
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<?= $Page->proofofpayment->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->proofofpayment->getErrorMessage() ?></div>
<input type="hidden" name="fn_x_proofofpayment" id= "fn_x_proofofpayment" value="<?= $Page->proofofpayment->Upload->FileName ?>">
<input type="hidden" name="fa_x_proofofpayment" id= "fa_x_proofofpayment" value="<?= (Post("fa_x_proofofpayment") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_proofofpayment" id= "fs_x_proofofpayment" value="0">
<input type="hidden" name="fx_x_proofofpayment" id= "fx_x_proofofpayment" value="<?= $Page->proofofpayment->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_proofofpayment" id= "fm_x_proofofpayment" value="<?= $Page->proofofpayment->UploadMaxFileSize ?>">
<table id="ft_x_proofofpayment" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->date->Visible) { // date ?>
    <div id="r_date"<?= $Page->date->rowAttributes() ?>>
        <label id="elh_CreateReservation_date" for="x_date" class="<?= $Page->LeftColumnClass ?>"><?= $Page->date->caption() ?><?= $Page->date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->date->cellAttributes() ?>>
<span id="el_CreateReservation_date">
<input type="<?= $Page->date->getInputTextType() ?>" name="x_date" id="x_date" data-table="CreateReservation" data-field="x_date" value="<?= $Page->date->EditValue ?>" placeholder="<?= HtmlEncode($Page->date->getPlaceHolder()) ?>"<?= $Page->date->editAttributes() ?> aria-describedby="x_date_help">
<?= $Page->date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->date->getErrorMessage() ?></div>
<?php if (!$Page->date->ReadOnly && !$Page->date->Disabled && !isset($Page->date->EditAttrs["readonly"]) && !isset($Page->date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fCreateReservationedit", "datetimepicker"], function () {
    let format = "<?= DateFormat(0) ?>",
        options = {
        localization: {
            locale: ew.LANGUAGE_ID,
            numberingSystem: ew.getNumberingSystem()
        },
        display: {
            format,
            components: {
                hours: !!format.match(/h/i),
                minutes: !!format.match(/m/),
                seconds: !!format.match(/s/i)
            },
            icons: {
                previous: ew.IS_RTL ? "fas fa-chevron-right" : "fas fa-chevron-left",
                next: ew.IS_RTL ? "fas fa-chevron-left" : "fas fa-chevron-right"
            }
        }
    };
    ew.createDateTimePicker("fCreateReservationedit", "x_date", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->rate_id->Visible) { // rate_id ?>
    <div id="r_rate_id"<?= $Page->rate_id->rowAttributes() ?>>
        <label id="elh_CreateReservation_rate_id" for="x_rate_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->rate_id->caption() ?><?= $Page->rate_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->rate_id->cellAttributes() ?>>
<span id="el_CreateReservation_rate_id">
<input type="<?= $Page->rate_id->getInputTextType() ?>" name="x_rate_id" id="x_rate_id" data-table="CreateReservation" data-field="x_rate_id" value="<?= $Page->rate_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->rate_id->getPlaceHolder()) ?>"<?= $Page->rate_id->editAttributes() ?> aria-describedby="x_rate_id_help">
<?= $Page->rate_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->rate_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->amountpaid->Visible) { // amountpaid ?>
    <div id="r_amountpaid"<?= $Page->amountpaid->rowAttributes() ?>>
        <label id="elh_CreateReservation_amountpaid" for="x_amountpaid" class="<?= $Page->LeftColumnClass ?>"><?= $Page->amountpaid->caption() ?><?= $Page->amountpaid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->amountpaid->cellAttributes() ?>>
<span id="el_CreateReservation_amountpaid">
<input type="<?= $Page->amountpaid->getInputTextType() ?>" name="x_amountpaid" id="x_amountpaid" data-table="CreateReservation" data-field="x_amountpaid" value="<?= $Page->amountpaid->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->amountpaid->getPlaceHolder()) ?>"<?= $Page->amountpaid->editAttributes() ?> aria-describedby="x_amountpaid_help">
<?= $Page->amountpaid->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->amountpaid->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->dateuploaded->Visible) { // dateuploaded ?>
    <div id="r_dateuploaded"<?= $Page->dateuploaded->rowAttributes() ?>>
        <label id="elh_CreateReservation_dateuploaded" for="x_dateuploaded" class="<?= $Page->LeftColumnClass ?>"><?= $Page->dateuploaded->caption() ?><?= $Page->dateuploaded->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->dateuploaded->cellAttributes() ?>>
<span id="el_CreateReservation_dateuploaded">
<input type="<?= $Page->dateuploaded->getInputTextType() ?>" name="x_dateuploaded" id="x_dateuploaded" data-table="CreateReservation" data-field="x_dateuploaded" value="<?= $Page->dateuploaded->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->dateuploaded->getPlaceHolder()) ?>"<?= $Page->dateuploaded->editAttributes() ?> aria-describedby="x_dateuploaded_help">
<?= $Page->dateuploaded->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->dateuploaded->getErrorMessage() ?></div>
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
    ew.addEventHandlers("CreateReservation");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
