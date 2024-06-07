<?php

namespace PHPMaker2022\project1;

// Page object
$ResrateAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { resrate: currentTable } });
var currentForm, currentPageID;
var fresrateadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fresrateadd = new ew.Form("fresrateadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fresrateadd;

    // Add fields
    var fields = currentTable.fields;
    fresrateadd.addFields([
        ["pool_id", [fields.pool_id.visible && fields.pool_id.required ? ew.Validators.required(fields.pool_id.caption) : null], fields.pool_id.isInvalid],
        ["priceadult", [fields.priceadult.visible && fields.priceadult.required ? ew.Validators.required(fields.priceadult.caption) : null, ew.Validators.integer], fields.priceadult.isInvalid],
        ["pricechild", [fields.pricechild.visible && fields.pricechild.required ? ew.Validators.required(fields.pricechild.caption) : null, ew.Validators.integer], fields.pricechild.isInvalid],
        ["priceadultspecial", [fields.priceadultspecial.visible && fields.priceadultspecial.required ? ew.Validators.required(fields.priceadultspecial.caption) : null, ew.Validators.integer], fields.priceadultspecial.isInvalid],
        ["pricechildspecial", [fields.pricechildspecial.visible && fields.pricechildspecial.required ? ew.Validators.required(fields.pricechildspecial.caption) : null, ew.Validators.integer], fields.pricechildspecial.isInvalid]
    ]);

    // Form_CustomValidate
    fresrateadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fresrateadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fresrateadd.lists.pool_id = <?= $Page->pool_id->toClientList($Page) ?>;
    loadjs.done("fresrateadd");
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
<form name="fresrateadd" id="fresrateadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="resrate">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->pool_id->Visible) { // pool_id ?>
    <div id="r_pool_id"<?= $Page->pool_id->rowAttributes() ?>>
        <label id="elh_resrate_pool_id" for="x_pool_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pool_id->caption() ?><?= $Page->pool_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->pool_id->cellAttributes() ?>>
<span id="el_resrate_pool_id">
    <select
        id="x_pool_id"
        name="x_pool_id"
        class="form-select ew-select<?= $Page->pool_id->isInvalidClass() ?>"
        data-select2-id="fresrateadd_x_pool_id"
        data-table="resrate"
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
loadjs.ready("fresrateadd", function() {
    var options = { name: "x_pool_id", selectId: "fresrateadd_x_pool_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fresrateadd.lists.pool_id.lookupOptions.length) {
        options.data = { id: "x_pool_id", form: "fresrateadd" };
    } else {
        options.ajax = { id: "x_pool_id", form: "fresrateadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.resrate.fields.pool_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->priceadult->Visible) { // priceadult ?>
    <div id="r_priceadult"<?= $Page->priceadult->rowAttributes() ?>>
        <label id="elh_resrate_priceadult" for="x_priceadult" class="<?= $Page->LeftColumnClass ?>"><?= $Page->priceadult->caption() ?><?= $Page->priceadult->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->priceadult->cellAttributes() ?>>
<span id="el_resrate_priceadult">
<input type="<?= $Page->priceadult->getInputTextType() ?>" name="x_priceadult" id="x_priceadult" data-table="resrate" data-field="x_priceadult" value="<?= $Page->priceadult->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->priceadult->getPlaceHolder()) ?>"<?= $Page->priceadult->editAttributes() ?> aria-describedby="x_priceadult_help">
<?= $Page->priceadult->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->priceadult->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->pricechild->Visible) { // pricechild ?>
    <div id="r_pricechild"<?= $Page->pricechild->rowAttributes() ?>>
        <label id="elh_resrate_pricechild" for="x_pricechild" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pricechild->caption() ?><?= $Page->pricechild->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->pricechild->cellAttributes() ?>>
<span id="el_resrate_pricechild">
<input type="<?= $Page->pricechild->getInputTextType() ?>" name="x_pricechild" id="x_pricechild" data-table="resrate" data-field="x_pricechild" value="<?= $Page->pricechild->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->pricechild->getPlaceHolder()) ?>"<?= $Page->pricechild->editAttributes() ?> aria-describedby="x_pricechild_help">
<?= $Page->pricechild->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->pricechild->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->priceadultspecial->Visible) { // priceadultspecial ?>
    <div id="r_priceadultspecial"<?= $Page->priceadultspecial->rowAttributes() ?>>
        <label id="elh_resrate_priceadultspecial" for="x_priceadultspecial" class="<?= $Page->LeftColumnClass ?>"><?= $Page->priceadultspecial->caption() ?><?= $Page->priceadultspecial->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->priceadultspecial->cellAttributes() ?>>
<span id="el_resrate_priceadultspecial">
<input type="<?= $Page->priceadultspecial->getInputTextType() ?>" name="x_priceadultspecial" id="x_priceadultspecial" data-table="resrate" data-field="x_priceadultspecial" value="<?= $Page->priceadultspecial->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->priceadultspecial->getPlaceHolder()) ?>"<?= $Page->priceadultspecial->editAttributes() ?> aria-describedby="x_priceadultspecial_help">
<?= $Page->priceadultspecial->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->priceadultspecial->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->pricechildspecial->Visible) { // pricechildspecial ?>
    <div id="r_pricechildspecial"<?= $Page->pricechildspecial->rowAttributes() ?>>
        <label id="elh_resrate_pricechildspecial" for="x_pricechildspecial" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pricechildspecial->caption() ?><?= $Page->pricechildspecial->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->pricechildspecial->cellAttributes() ?>>
<span id="el_resrate_pricechildspecial">
<input type="<?= $Page->pricechildspecial->getInputTextType() ?>" name="x_pricechildspecial" id="x_pricechildspecial" data-table="resrate" data-field="x_pricechildspecial" value="<?= $Page->pricechildspecial->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->pricechildspecial->getPlaceHolder()) ?>"<?= $Page->pricechildspecial->editAttributes() ?> aria-describedby="x_pricechildspecial_help">
<?= $Page->pricechildspecial->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->pricechildspecial->getErrorMessage() ?></div>
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
    ew.addEventHandlers("resrate");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
