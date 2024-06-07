<?php

namespace PHPMaker2023\project1;

// Page object
$PoolAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { pool: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fpooladd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fpooladd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["pool_name", [fields.pool_name.visible && fields.pool_name.required ? ew.Validators.required(fields.pool_name.caption) : null], fields.pool_name.isInvalid],
            ["pool_description", [fields.pool_description.visible && fields.pool_description.required ? ew.Validators.required(fields.pool_description.caption) : null], fields.pool_description.isInvalid],
            ["poolcat", [fields.poolcat.visible && fields.poolcat.required ? ew.Validators.required(fields.poolcat.caption) : null], fields.poolcat.isInvalid],
            ["address", [fields.address.visible && fields.address.required ? ew.Validators.required(fields.address.caption) : null], fields.address.isInvalid],
            ["contactno1", [fields.contactno1.visible && fields.contactno1.required ? ew.Validators.required(fields.contactno1.caption) : null], fields.contactno1.isInvalid],
            ["socmed", [fields.socmed.visible && fields.socmed.required ? ew.Validators.required(fields.socmed.caption) : null], fields.socmed.isInvalid],
            ["emailaddress", [fields.emailaddress.visible && fields.emailaddress.required ? ew.Validators.required(fields.emailaddress.caption) : null], fields.emailaddress.isInvalid],
            ["barangay", [fields.barangay.visible && fields.barangay.required ? ew.Validators.required(fields.barangay.caption) : null], fields.barangay.isInvalid]
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
            "poolcat": <?= $Page->poolcat->toClientList($Page) ?>,
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
<form name="fpooladd" id="fpooladd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="pool">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->pool_name->Visible) { // pool_name ?>
    <div id="r_pool_name"<?= $Page->pool_name->rowAttributes() ?>>
        <label id="elh_pool_pool_name" for="x_pool_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pool_name->caption() ?><?= $Page->pool_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->pool_name->cellAttributes() ?>>
<span id="el_pool_pool_name">
<input type="<?= $Page->pool_name->getInputTextType() ?>" name="x_pool_name" id="x_pool_name" data-table="pool" data-field="x_pool_name" value="<?= $Page->pool_name->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->pool_name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->pool_name->formatPattern()) ?>"<?= $Page->pool_name->editAttributes() ?> aria-describedby="x_pool_name_help">
<?= $Page->pool_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->pool_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->pool_description->Visible) { // pool_description ?>
    <div id="r_pool_description"<?= $Page->pool_description->rowAttributes() ?>>
        <label id="elh_pool_pool_description" for="x_pool_description" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pool_description->caption() ?><?= $Page->pool_description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->pool_description->cellAttributes() ?>>
<span id="el_pool_pool_description">
<textarea data-table="pool" data-field="x_pool_description" name="x_pool_description" id="x_pool_description" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->pool_description->getPlaceHolder()) ?>"<?= $Page->pool_description->editAttributes() ?> aria-describedby="x_pool_description_help"><?= $Page->pool_description->EditValue ?></textarea>
<?= $Page->pool_description->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->pool_description->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->poolcat->Visible) { // poolcat ?>
    <div id="r_poolcat"<?= $Page->poolcat->rowAttributes() ?>>
        <label id="elh_pool_poolcat" for="x_poolcat" class="<?= $Page->LeftColumnClass ?>"><?= $Page->poolcat->caption() ?><?= $Page->poolcat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->poolcat->cellAttributes() ?>>
<span id="el_pool_poolcat">
    <select
        id="x_poolcat"
        name="x_poolcat"
        class="form-select ew-select<?= $Page->poolcat->isInvalidClass() ?>"
        data-select2-id="fpooladd_x_poolcat"
        data-table="pool"
        data-field="x_poolcat"
        data-value-separator="<?= $Page->poolcat->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->poolcat->getPlaceHolder()) ?>"
        <?= $Page->poolcat->editAttributes() ?>>
        <?= $Page->poolcat->selectOptionListHtml("x_poolcat") ?>
    </select>
    <?= $Page->poolcat->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->poolcat->getErrorMessage() ?></div>
<script>
loadjs.ready("fpooladd", function() {
    var options = { name: "x_poolcat", selectId: "fpooladd_x_poolcat" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fpooladd.lists.poolcat?.lookupOptions.length) {
        options.data = { id: "x_poolcat", form: "fpooladd" };
    } else {
        options.ajax = { id: "x_poolcat", form: "fpooladd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.pool.fields.poolcat.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->address->Visible) { // address ?>
    <div id="r_address"<?= $Page->address->rowAttributes() ?>>
        <label id="elh_pool_address" for="x_address" class="<?= $Page->LeftColumnClass ?>"><?= $Page->address->caption() ?><?= $Page->address->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->address->cellAttributes() ?>>
<span id="el_pool_address">
<textarea data-table="pool" data-field="x_address" name="x_address" id="x_address" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->address->getPlaceHolder()) ?>"<?= $Page->address->editAttributes() ?> aria-describedby="x_address_help"><?= $Page->address->EditValue ?></textarea>
<?= $Page->address->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->address->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->contactno1->Visible) { // contactno1 ?>
    <div id="r_contactno1"<?= $Page->contactno1->rowAttributes() ?>>
        <label id="elh_pool_contactno1" for="x_contactno1" class="<?= $Page->LeftColumnClass ?>"><?= $Page->contactno1->caption() ?><?= $Page->contactno1->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->contactno1->cellAttributes() ?>>
<span id="el_pool_contactno1">
<input type="<?= $Page->contactno1->getInputTextType() ?>" name="x_contactno1" id="x_contactno1" data-table="pool" data-field="x_contactno1" value="<?= $Page->contactno1->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->contactno1->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->contactno1->formatPattern()) ?>"<?= $Page->contactno1->editAttributes() ?> aria-describedby="x_contactno1_help">
<?= $Page->contactno1->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->contactno1->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->socmed->Visible) { // socmed ?>
    <div id="r_socmed"<?= $Page->socmed->rowAttributes() ?>>
        <label id="elh_pool_socmed" for="x_socmed" class="<?= $Page->LeftColumnClass ?>"><?= $Page->socmed->caption() ?><?= $Page->socmed->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->socmed->cellAttributes() ?>>
<span id="el_pool_socmed">
<input type="<?= $Page->socmed->getInputTextType() ?>" name="x_socmed" id="x_socmed" data-table="pool" data-field="x_socmed" value="<?= $Page->socmed->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->socmed->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->socmed->formatPattern()) ?>"<?= $Page->socmed->editAttributes() ?> aria-describedby="x_socmed_help">
<?= $Page->socmed->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->socmed->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->emailaddress->Visible) { // emailaddress ?>
    <div id="r_emailaddress"<?= $Page->emailaddress->rowAttributes() ?>>
        <label id="elh_pool_emailaddress" for="x_emailaddress" class="<?= $Page->LeftColumnClass ?>"><?= $Page->emailaddress->caption() ?><?= $Page->emailaddress->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->emailaddress->cellAttributes() ?>>
<span id="el_pool_emailaddress">
<input type="<?= $Page->emailaddress->getInputTextType() ?>" name="x_emailaddress" id="x_emailaddress" data-table="pool" data-field="x_emailaddress" value="<?= $Page->emailaddress->EditValue ?>" size="30" maxlength="250" placeholder="<?= HtmlEncode($Page->emailaddress->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->emailaddress->formatPattern()) ?>"<?= $Page->emailaddress->editAttributes() ?> aria-describedby="x_emailaddress_help">
<?= $Page->emailaddress->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->emailaddress->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->barangay->Visible) { // barangay ?>
    <div id="r_barangay"<?= $Page->barangay->rowAttributes() ?>>
        <label id="elh_pool_barangay" for="x_barangay" class="<?= $Page->LeftColumnClass ?>"><?= $Page->barangay->caption() ?><?= $Page->barangay->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->barangay->cellAttributes() ?>>
<span id="el_pool_barangay">
<input type="<?= $Page->barangay->getInputTextType() ?>" name="x_barangay" id="x_barangay" data-table="pool" data-field="x_barangay" value="<?= $Page->barangay->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->barangay->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->barangay->formatPattern()) ?>"<?= $Page->barangay->editAttributes() ?> aria-describedby="x_barangay_help">
<?= $Page->barangay->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->barangay->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php
    if (in_array("poolpics", explode(",", $Page->getCurrentDetailTable())) && $poolpics->DetailAdd) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("poolpics", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "PoolpicsGrid.php" ?>
<?php } ?>
<?php
    if (in_array("poolrates", explode(",", $Page->getCurrentDetailTable())) && $poolrates->DetailAdd) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("poolrates", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "PoolratesGrid.php" ?>
<?php } ?>
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fpooladd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fpooladd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("pool");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
