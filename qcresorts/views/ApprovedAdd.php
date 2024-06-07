<?php

namespace PHPMaker2022\project1;

// Page object
$ApprovedAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { approved: currentTable } });
var currentForm, currentPageID;
var fapprovedadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fapprovedadd = new ew.Form("fapprovedadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fapprovedadd;

    // Add fields
    var fields = currentTable.fields;
    fapprovedadd.addFields([
        ["pool_id", [fields.pool_id.visible && fields.pool_id.required ? ew.Validators.required(fields.pool_id.caption) : null, ew.Validators.integer], fields.pool_id.isInvalid],
        ["date", [fields.date.visible && fields.date.required ? ew.Validators.required(fields.date.caption) : null, ew.Validators.datetime(fields.date.clientFormatPattern)], fields.date.isInvalid],
        ["rate_id", [fields.rate_id.visible && fields.rate_id.required ? ew.Validators.required(fields.rate_id.caption) : null, ew.Validators.integer], fields.rate_id.isInvalid],
        ["fname", [fields.fname.visible && fields.fname.required ? ew.Validators.required(fields.fname.caption) : null], fields.fname.isInvalid],
        ["lname", [fields.lname.visible && fields.lname.required ? ew.Validators.required(fields.lname.caption) : null], fields.lname.isInvalid],
        ["address", [fields.address.visible && fields.address.required ? ew.Validators.required(fields.address.caption) : null], fields.address.isInvalid],
        ["contactno", [fields.contactno.visible && fields.contactno.required ? ew.Validators.required(fields.contactno.caption) : null], fields.contactno.isInvalid],
        ["_email", [fields._email.visible && fields._email.required ? ew.Validators.required(fields._email.caption) : null], fields._email.isInvalid],
        ["proofofpayment", [fields.proofofpayment.visible && fields.proofofpayment.required ? ew.Validators.fileRequired(fields.proofofpayment.caption) : null], fields.proofofpayment.isInvalid],
        ["dateuploaded", [fields.dateuploaded.visible && fields.dateuploaded.required ? ew.Validators.required(fields.dateuploaded.caption) : null], fields.dateuploaded.isInvalid],
        ["approved", [fields.approved.visible && fields.approved.required ? ew.Validators.required(fields.approved.caption) : null, ew.Validators.integer], fields.approved.isInvalid],
        ["uname", [fields.uname.visible && fields.uname.required ? ew.Validators.required(fields.uname.caption) : null], fields.uname.isInvalid]
    ]);

    // Form_CustomValidate
    fapprovedadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fapprovedadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("fapprovedadd");
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
<form name="fapprovedadd" id="fapprovedadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="approved">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->pool_id->Visible) { // pool_id ?>
    <div id="r_pool_id"<?= $Page->pool_id->rowAttributes() ?>>
        <label id="elh_approved_pool_id" for="x_pool_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pool_id->caption() ?><?= $Page->pool_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->pool_id->cellAttributes() ?>>
<span id="el_approved_pool_id">
<input type="<?= $Page->pool_id->getInputTextType() ?>" name="x_pool_id" id="x_pool_id" data-table="approved" data-field="x_pool_id" value="<?= $Page->pool_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->pool_id->getPlaceHolder()) ?>"<?= $Page->pool_id->editAttributes() ?> aria-describedby="x_pool_id_help">
<?= $Page->pool_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->pool_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->date->Visible) { // date ?>
    <div id="r_date"<?= $Page->date->rowAttributes() ?>>
        <label id="elh_approved_date" for="x_date" class="<?= $Page->LeftColumnClass ?>"><?= $Page->date->caption() ?><?= $Page->date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->date->cellAttributes() ?>>
<span id="el_approved_date">
<input type="<?= $Page->date->getInputTextType() ?>" name="x_date" id="x_date" data-table="approved" data-field="x_date" value="<?= $Page->date->EditValue ?>" placeholder="<?= HtmlEncode($Page->date->getPlaceHolder()) ?>"<?= $Page->date->editAttributes() ?> aria-describedby="x_date_help">
<?= $Page->date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->date->getErrorMessage() ?></div>
<?php if (!$Page->date->ReadOnly && !$Page->date->Disabled && !isset($Page->date->EditAttrs["readonly"]) && !isset($Page->date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fapprovedadd", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fapprovedadd", "x_date", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->rate_id->Visible) { // rate_id ?>
    <div id="r_rate_id"<?= $Page->rate_id->rowAttributes() ?>>
        <label id="elh_approved_rate_id" for="x_rate_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->rate_id->caption() ?><?= $Page->rate_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->rate_id->cellAttributes() ?>>
<span id="el_approved_rate_id">
<input type="<?= $Page->rate_id->getInputTextType() ?>" name="x_rate_id" id="x_rate_id" data-table="approved" data-field="x_rate_id" value="<?= $Page->rate_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->rate_id->getPlaceHolder()) ?>"<?= $Page->rate_id->editAttributes() ?> aria-describedby="x_rate_id_help">
<?= $Page->rate_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->rate_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->fname->Visible) { // fname ?>
    <div id="r_fname"<?= $Page->fname->rowAttributes() ?>>
        <label id="elh_approved_fname" for="x_fname" class="<?= $Page->LeftColumnClass ?>"><?= $Page->fname->caption() ?><?= $Page->fname->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->fname->cellAttributes() ?>>
<span id="el_approved_fname">
<input type="<?= $Page->fname->getInputTextType() ?>" name="x_fname" id="x_fname" data-table="approved" data-field="x_fname" value="<?= $Page->fname->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->fname->getPlaceHolder()) ?>"<?= $Page->fname->editAttributes() ?> aria-describedby="x_fname_help">
<?= $Page->fname->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->fname->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->lname->Visible) { // lname ?>
    <div id="r_lname"<?= $Page->lname->rowAttributes() ?>>
        <label id="elh_approved_lname" for="x_lname" class="<?= $Page->LeftColumnClass ?>"><?= $Page->lname->caption() ?><?= $Page->lname->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->lname->cellAttributes() ?>>
<span id="el_approved_lname">
<input type="<?= $Page->lname->getInputTextType() ?>" name="x_lname" id="x_lname" data-table="approved" data-field="x_lname" value="<?= $Page->lname->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->lname->getPlaceHolder()) ?>"<?= $Page->lname->editAttributes() ?> aria-describedby="x_lname_help">
<?= $Page->lname->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->lname->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->address->Visible) { // address ?>
    <div id="r_address"<?= $Page->address->rowAttributes() ?>>
        <label id="elh_approved_address" for="x_address" class="<?= $Page->LeftColumnClass ?>"><?= $Page->address->caption() ?><?= $Page->address->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->address->cellAttributes() ?>>
<span id="el_approved_address">
<input type="<?= $Page->address->getInputTextType() ?>" name="x_address" id="x_address" data-table="approved" data-field="x_address" value="<?= $Page->address->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->address->getPlaceHolder()) ?>"<?= $Page->address->editAttributes() ?> aria-describedby="x_address_help">
<?= $Page->address->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->address->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->contactno->Visible) { // contactno ?>
    <div id="r_contactno"<?= $Page->contactno->rowAttributes() ?>>
        <label id="elh_approved_contactno" for="x_contactno" class="<?= $Page->LeftColumnClass ?>"><?= $Page->contactno->caption() ?><?= $Page->contactno->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->contactno->cellAttributes() ?>>
<span id="el_approved_contactno">
<input type="<?= $Page->contactno->getInputTextType() ?>" name="x_contactno" id="x_contactno" data-table="approved" data-field="x_contactno" value="<?= $Page->contactno->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->contactno->getPlaceHolder()) ?>"<?= $Page->contactno->editAttributes() ?> aria-describedby="x_contactno_help">
<?= $Page->contactno->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->contactno->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
    <div id="r__email"<?= $Page->_email->rowAttributes() ?>>
        <label id="elh_approved__email" for="x__email" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_email->caption() ?><?= $Page->_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->_email->cellAttributes() ?>>
<span id="el_approved__email">
<input type="<?= $Page->_email->getInputTextType() ?>" name="x__email" id="x__email" data-table="approved" data-field="x__email" value="<?= $Page->_email->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->_email->getPlaceHolder()) ?>"<?= $Page->_email->editAttributes() ?> aria-describedby="x__email_help">
<?= $Page->_email->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_email->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->proofofpayment->Visible) { // proofofpayment ?>
    <div id="r_proofofpayment"<?= $Page->proofofpayment->rowAttributes() ?>>
        <label id="elh_approved_proofofpayment" class="<?= $Page->LeftColumnClass ?>"><?= $Page->proofofpayment->caption() ?><?= $Page->proofofpayment->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->proofofpayment->cellAttributes() ?>>
<span id="el_approved_proofofpayment">
<div id="fd_x_proofofpayment" class="fileinput-button ew-file-drop-zone">
    <input type="file" class="form-control ew-file-input" title="<?= $Page->proofofpayment->title() ?>" data-table="approved" data-field="x_proofofpayment" name="x_proofofpayment" id="x_proofofpayment" lang="<?= CurrentLanguageID() ?>"<?= $Page->proofofpayment->editAttributes() ?> aria-describedby="x_proofofpayment_help"<?= ($Page->proofofpayment->ReadOnly || $Page->proofofpayment->Disabled) ? " disabled" : "" ?>>
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<?= $Page->proofofpayment->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->proofofpayment->getErrorMessage() ?></div>
<input type="hidden" name="fn_x_proofofpayment" id= "fn_x_proofofpayment" value="<?= $Page->proofofpayment->Upload->FileName ?>">
<input type="hidden" name="fa_x_proofofpayment" id= "fa_x_proofofpayment" value="0">
<input type="hidden" name="fs_x_proofofpayment" id= "fs_x_proofofpayment" value="0">
<input type="hidden" name="fx_x_proofofpayment" id= "fx_x_proofofpayment" value="<?= $Page->proofofpayment->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_proofofpayment" id= "fm_x_proofofpayment" value="<?= $Page->proofofpayment->UploadMaxFileSize ?>">
<table id="ft_x_proofofpayment" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->dateuploaded->Visible) { // dateuploaded ?>
    <div id="r_dateuploaded"<?= $Page->dateuploaded->rowAttributes() ?>>
        <label id="elh_approved_dateuploaded" for="x_dateuploaded" class="<?= $Page->LeftColumnClass ?>"><?= $Page->dateuploaded->caption() ?><?= $Page->dateuploaded->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->dateuploaded->cellAttributes() ?>>
<span id="el_approved_dateuploaded">
<input type="<?= $Page->dateuploaded->getInputTextType() ?>" name="x_dateuploaded" id="x_dateuploaded" data-table="approved" data-field="x_dateuploaded" value="<?= $Page->dateuploaded->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->dateuploaded->getPlaceHolder()) ?>"<?= $Page->dateuploaded->editAttributes() ?> aria-describedby="x_dateuploaded_help">
<?= $Page->dateuploaded->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->dateuploaded->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->approved->Visible) { // approved ?>
    <div id="r_approved"<?= $Page->approved->rowAttributes() ?>>
        <label id="elh_approved_approved" for="x_approved" class="<?= $Page->LeftColumnClass ?>"><?= $Page->approved->caption() ?><?= $Page->approved->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->approved->cellAttributes() ?>>
<span id="el_approved_approved">
<input type="<?= $Page->approved->getInputTextType() ?>" name="x_approved" id="x_approved" data-table="approved" data-field="x_approved" value="<?= $Page->approved->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->approved->getPlaceHolder()) ?>"<?= $Page->approved->editAttributes() ?> aria-describedby="x_approved_help">
<?= $Page->approved->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->approved->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->uname->Visible) { // uname ?>
    <div id="r_uname"<?= $Page->uname->rowAttributes() ?>>
        <label id="elh_approved_uname" for="x_uname" class="<?= $Page->LeftColumnClass ?>"><?= $Page->uname->caption() ?><?= $Page->uname->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->uname->cellAttributes() ?>>
<span id="el_approved_uname">
<input type="<?= $Page->uname->getInputTextType() ?>" name="x_uname" id="x_uname" data-table="approved" data-field="x_uname" value="<?= $Page->uname->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->uname->getPlaceHolder()) ?>"<?= $Page->uname->editAttributes() ?> aria-describedby="x_uname_help">
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
    ew.addEventHandlers("approved");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
