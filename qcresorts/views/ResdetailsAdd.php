<?php

namespace PHPMaker2023\project1;

// Page object
$ResdetailsAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { resdetails: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fresdetailsadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fresdetailsadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["date", [fields.date.visible && fields.date.required ? ew.Validators.required(fields.date.caption) : null, ew.Validators.datetime(fields.date.clientFormatPattern)], fields.date.isInvalid],
            ["fname", [fields.fname.visible && fields.fname.required ? ew.Validators.required(fields.fname.caption) : null], fields.fname.isInvalid],
            ["lname", [fields.lname.visible && fields.lname.required ? ew.Validators.required(fields.lname.caption) : null], fields.lname.isInvalid],
            ["address", [fields.address.visible && fields.address.required ? ew.Validators.required(fields.address.caption) : null], fields.address.isInvalid],
            ["contactno", [fields.contactno.visible && fields.contactno.required ? ew.Validators.required(fields.contactno.caption) : null], fields.contactno.isInvalid],
            ["_email", [fields._email.visible && fields._email.required ? ew.Validators.required(fields._email.caption) : null], fields._email.isInvalid],
            ["pool_id", [fields.pool_id.visible && fields.pool_id.required ? ew.Validators.required(fields.pool_id.caption) : null], fields.pool_id.isInvalid],
            ["proofofpayment", [fields.proofofpayment.visible && fields.proofofpayment.required ? ew.Validators.fileRequired(fields.proofofpayment.caption) : null], fields.proofofpayment.isInvalid],
            ["rate_id", [fields.rate_id.visible && fields.rate_id.required ? ew.Validators.required(fields.rate_id.caption) : null], fields.rate_id.isInvalid],
            ["dateuploaded", [fields.dateuploaded.visible && fields.dateuploaded.required ? ew.Validators.required(fields.dateuploaded.caption) : null], fields.dateuploaded.isInvalid],
            ["uname", [fields.uname.visible && fields.uname.required ? ew.Validators.required(fields.uname.caption) : null], fields.uname.isInvalid],
            ["paymentamount", [fields.paymentamount.visible && fields.paymentamount.required ? ew.Validators.required(fields.paymentamount.caption) : null], fields.paymentamount.isInvalid],
            ["approved", [fields.approved.visible && fields.approved.required ? ew.Validators.required(fields.approved.caption) : null, ew.Validators.integer], fields.approved.isInvalid]
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
            "pool_id": <?= $Page->pool_id->toClientList($Page) ?>,
            "rate_id": <?= $Page->rate_id->toClientList($Page) ?>,
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
<form name="fresdetailsadd" id="fresdetailsadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="resdetails">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->date->Visible) { // date ?>
    <div id="r_date"<?= $Page->date->rowAttributes() ?>>
        <label id="elh_resdetails_date" for="x_date" class="<?= $Page->LeftColumnClass ?>"><?= $Page->date->caption() ?><?= $Page->date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->date->cellAttributes() ?>>
<span id="el_resdetails_date">
<input type="<?= $Page->date->getInputTextType() ?>" name="x_date" id="x_date" data-table="resdetails" data-field="x_date" value="<?= $Page->date->EditValue ?>" placeholder="<?= HtmlEncode($Page->date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->date->formatPattern()) ?>"<?= $Page->date->editAttributes() ?> aria-describedby="x_date_help">
<?= $Page->date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->date->getErrorMessage() ?></div>
<?php if (!$Page->date->ReadOnly && !$Page->date->Disabled && !isset($Page->date->EditAttrs["readonly"]) && !isset($Page->date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fresdetailsadd", "datetimepicker"], function () {
    let format = "<?= DateFormat(0) ?>",
        options = {
            localization: {
                locale: ew.LANGUAGE_ID + "-u-nu-" + ew.getNumberingSystem(),
                ...ew.language.phrase("datetimepicker")
            },
            display: {
                icons: {
                    previous: ew.IS_RTL ? "fa-solid fa-chevron-right" : "fa-solid fa-chevron-left",
                    next: ew.IS_RTL ? "fa-solid fa-chevron-left" : "fa-solid fa-chevron-right"
                },
                components: {
                    hours: !!format.match(/h/i),
                    minutes: !!format.match(/m/),
                    seconds: !!format.match(/s/i),
                    useTwentyfourHour: !!format.match(/H/)
                },
                theme: ew.isDark() ? "dark" : "auto"
            },
            meta: {
                format
            }
        };
    ew.createDateTimePicker("fresdetailsadd", "x_date", jQuery.extend(true, {"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->fname->Visible) { // fname ?>
    <div id="r_fname"<?= $Page->fname->rowAttributes() ?>>
        <label id="elh_resdetails_fname" for="x_fname" class="<?= $Page->LeftColumnClass ?>"><?= $Page->fname->caption() ?><?= $Page->fname->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->fname->cellAttributes() ?>>
<span id="el_resdetails_fname">
<input type="<?= $Page->fname->getInputTextType() ?>" name="x_fname" id="x_fname" data-table="resdetails" data-field="x_fname" value="<?= $Page->fname->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->fname->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->fname->formatPattern()) ?>"<?= $Page->fname->editAttributes() ?> aria-describedby="x_fname_help">
<?= $Page->fname->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->fname->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->lname->Visible) { // lname ?>
    <div id="r_lname"<?= $Page->lname->rowAttributes() ?>>
        <label id="elh_resdetails_lname" for="x_lname" class="<?= $Page->LeftColumnClass ?>"><?= $Page->lname->caption() ?><?= $Page->lname->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->lname->cellAttributes() ?>>
<span id="el_resdetails_lname">
<input type="<?= $Page->lname->getInputTextType() ?>" name="x_lname" id="x_lname" data-table="resdetails" data-field="x_lname" value="<?= $Page->lname->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->lname->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->lname->formatPattern()) ?>"<?= $Page->lname->editAttributes() ?> aria-describedby="x_lname_help">
<?= $Page->lname->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->lname->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->address->Visible) { // address ?>
    <div id="r_address"<?= $Page->address->rowAttributes() ?>>
        <label id="elh_resdetails_address" for="x_address" class="<?= $Page->LeftColumnClass ?>"><?= $Page->address->caption() ?><?= $Page->address->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->address->cellAttributes() ?>>
<span id="el_resdetails_address">
<textarea data-table="resdetails" data-field="x_address" name="x_address" id="x_address" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->address->getPlaceHolder()) ?>"<?= $Page->address->editAttributes() ?> aria-describedby="x_address_help"><?= $Page->address->EditValue ?></textarea>
<?= $Page->address->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->address->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->contactno->Visible) { // contactno ?>
    <div id="r_contactno"<?= $Page->contactno->rowAttributes() ?>>
        <label id="elh_resdetails_contactno" for="x_contactno" class="<?= $Page->LeftColumnClass ?>"><?= $Page->contactno->caption() ?><?= $Page->contactno->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->contactno->cellAttributes() ?>>
<span id="el_resdetails_contactno">
<input type="<?= $Page->contactno->getInputTextType() ?>" name="x_contactno" id="x_contactno" data-table="resdetails" data-field="x_contactno" value="<?= $Page->contactno->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->contactno->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->contactno->formatPattern()) ?>"<?= $Page->contactno->editAttributes() ?> aria-describedby="x_contactno_help">
<?= $Page->contactno->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->contactno->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
    <div id="r__email"<?= $Page->_email->rowAttributes() ?>>
        <label id="elh_resdetails__email" for="x__email" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_email->caption() ?><?= $Page->_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->_email->cellAttributes() ?>>
<span id="el_resdetails__email">
<input type="<?= $Page->_email->getInputTextType() ?>" name="x__email" id="x__email" data-table="resdetails" data-field="x__email" value="<?= $Page->_email->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->_email->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->_email->formatPattern()) ?>"<?= $Page->_email->editAttributes() ?> aria-describedby="x__email_help">
<?= $Page->_email->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_email->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->pool_id->Visible) { // pool_id ?>
    <div id="r_pool_id"<?= $Page->pool_id->rowAttributes() ?>>
        <label id="elh_resdetails_pool_id" for="x_pool_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pool_id->caption() ?><?= $Page->pool_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->pool_id->cellAttributes() ?>>
<span id="el_resdetails_pool_id">
    <select
        id="x_pool_id"
        name="x_pool_id"
        class="form-select ew-select<?= $Page->pool_id->isInvalidClass() ?>"
        data-select2-id="fresdetailsadd_x_pool_id"
        data-table="resdetails"
        data-field="x_pool_id"
        data-value-separator="<?= $Page->pool_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->pool_id->getPlaceHolder()) ?>"
        data-ew-action="update-options"
        <?= $Page->pool_id->editAttributes() ?>>
        <?= $Page->pool_id->selectOptionListHtml("x_pool_id") ?>
    </select>
    <?= $Page->pool_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->pool_id->getErrorMessage() ?></div>
<?= $Page->pool_id->Lookup->getParamTag($Page, "p_x_pool_id") ?>
<script>
loadjs.ready("fresdetailsadd", function() {
    var options = { name: "x_pool_id", selectId: "fresdetailsadd_x_pool_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fresdetailsadd.lists.pool_id?.lookupOptions.length) {
        options.data = { id: "x_pool_id", form: "fresdetailsadd" };
    } else {
        options.ajax = { id: "x_pool_id", form: "fresdetailsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.resdetails.fields.pool_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->proofofpayment->Visible) { // proofofpayment ?>
    <div id="r_proofofpayment"<?= $Page->proofofpayment->rowAttributes() ?>>
        <label id="elh_resdetails_proofofpayment" class="<?= $Page->LeftColumnClass ?>"><?= $Page->proofofpayment->caption() ?><?= $Page->proofofpayment->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->proofofpayment->cellAttributes() ?>>
<span id="el_resdetails_proofofpayment">
<div id="fd_x_proofofpayment" class="fileinput-button ew-file-drop-zone">
    <input
        type="file"
        id="x_proofofpayment"
        name="x_proofofpayment"
        class="form-control ew-file-input"
        title="<?= $Page->proofofpayment->title() ?>"
        lang="<?= CurrentLanguageID() ?>"
        data-table="resdetails"
        data-field="x_proofofpayment"
        data-size="0"
        data-accept-file-types="<?= $Page->proofofpayment->acceptFileTypes() ?>"
        data-max-file-size="<?= $Page->proofofpayment->UploadMaxFileSize ?>"
        data-max-number-of-files="null"
        data-disable-image-crop="<?= $Page->proofofpayment->ImageCropper ? 0 : 1 ?>"
        aria-describedby="x_proofofpayment_help"
        <?= ($Page->proofofpayment->ReadOnly || $Page->proofofpayment->Disabled) ? " disabled" : "" ?>
        <?= $Page->proofofpayment->editAttributes() ?>
    >
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<?= $Page->proofofpayment->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->proofofpayment->getErrorMessage() ?></div>
<input type="hidden" name="fn_x_proofofpayment" id= "fn_x_proofofpayment" value="<?= $Page->proofofpayment->Upload->FileName ?>">
<input type="hidden" name="fa_x_proofofpayment" id= "fa_x_proofofpayment" value="0">
<table id="ft_x_proofofpayment" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->rate_id->Visible) { // rate_id ?>
    <div id="r_rate_id"<?= $Page->rate_id->rowAttributes() ?>>
        <label id="elh_resdetails_rate_id" for="x_rate_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->rate_id->caption() ?><?= $Page->rate_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->rate_id->cellAttributes() ?>>
<span id="el_resdetails_rate_id">
    <select
        id="x_rate_id"
        name="x_rate_id"
        class="form-select ew-select<?= $Page->rate_id->isInvalidClass() ?>"
        data-select2-id="fresdetailsadd_x_rate_id"
        data-table="resdetails"
        data-field="x_rate_id"
        data-value-separator="<?= $Page->rate_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->rate_id->getPlaceHolder()) ?>"
        data-ew-action="autofill"
        <?= $Page->rate_id->editAttributes() ?>>
        <?= $Page->rate_id->selectOptionListHtml("x_rate_id") ?>
    </select>
    <?= $Page->rate_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->rate_id->getErrorMessage() ?></div>
<?= $Page->rate_id->Lookup->getParamTag($Page, "p_x_rate_id") ?>
<script>
loadjs.ready("fresdetailsadd", function() {
    var options = { name: "x_rate_id", selectId: "fresdetailsadd_x_rate_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fresdetailsadd.lists.rate_id?.lookupOptions.length) {
        options.data = { id: "x_rate_id", form: "fresdetailsadd" };
    } else {
        options.ajax = { id: "x_rate_id", form: "fresdetailsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.resdetails.fields.rate_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->dateuploaded->Visible) { // dateuploaded ?>
    <div id="r_dateuploaded"<?= $Page->dateuploaded->rowAttributes() ?>>
        <label id="elh_resdetails_dateuploaded" for="x_dateuploaded" class="<?= $Page->LeftColumnClass ?>"><?= $Page->dateuploaded->caption() ?><?= $Page->dateuploaded->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->dateuploaded->cellAttributes() ?>>
<span id="el_resdetails_dateuploaded">
<input type="<?= $Page->dateuploaded->getInputTextType() ?>" name="x_dateuploaded" id="x_dateuploaded" data-table="resdetails" data-field="x_dateuploaded" value="<?= $Page->dateuploaded->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->dateuploaded->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->dateuploaded->formatPattern()) ?>"<?= $Page->dateuploaded->editAttributes() ?> aria-describedby="x_dateuploaded_help">
<?= $Page->dateuploaded->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->dateuploaded->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->uname->Visible) { // uname ?>
    <div id="r_uname"<?= $Page->uname->rowAttributes() ?>>
        <label id="elh_resdetails_uname" for="x_uname" class="<?= $Page->LeftColumnClass ?>"><?= $Page->uname->caption() ?><?= $Page->uname->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->uname->cellAttributes() ?>>
<span id="el_resdetails_uname">
<input type="<?= $Page->uname->getInputTextType() ?>" name="x_uname" id="x_uname" data-table="resdetails" data-field="x_uname" value="<?= $Page->uname->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->uname->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->uname->formatPattern()) ?>"<?= $Page->uname->editAttributes() ?> aria-describedby="x_uname_help">
<?= $Page->uname->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->uname->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->paymentamount->Visible) { // paymentamount ?>
    <div id="r_paymentamount"<?= $Page->paymentamount->rowAttributes() ?>>
        <label id="elh_resdetails_paymentamount" for="x_paymentamount" class="<?= $Page->LeftColumnClass ?>"><?= $Page->paymentamount->caption() ?><?= $Page->paymentamount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->paymentamount->cellAttributes() ?>>
<span id="el_resdetails_paymentamount">
<input type="<?= $Page->paymentamount->getInputTextType() ?>" name="x_paymentamount" id="x_paymentamount" data-table="resdetails" data-field="x_paymentamount" value="<?= $Page->paymentamount->EditValue ?>" size="30" maxlength="7" placeholder="<?= HtmlEncode($Page->paymentamount->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->paymentamount->formatPattern()) ?>"<?= $Page->paymentamount->editAttributes() ?> aria-describedby="x_paymentamount_help">
<?= $Page->paymentamount->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->paymentamount->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->approved->Visible) { // approved ?>
    <div id="r_approved"<?= $Page->approved->rowAttributes() ?>>
        <label id="elh_resdetails_approved" for="x_approved" class="<?= $Page->LeftColumnClass ?>"><?= $Page->approved->caption() ?><?= $Page->approved->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->approved->cellAttributes() ?>>
<span id="el_resdetails_approved">
<input type="<?= $Page->approved->getInputTextType() ?>" name="x_approved" id="x_approved" data-table="resdetails" data-field="x_approved" value="<?= $Page->approved->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->approved->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->approved->formatPattern()) ?>"<?= $Page->approved->editAttributes() ?> aria-describedby="x_approved_help">
<?= $Page->approved->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->approved->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fresdetailsadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fresdetailsadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("resdetails");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
