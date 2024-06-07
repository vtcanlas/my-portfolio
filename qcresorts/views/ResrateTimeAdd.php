<?php

namespace PHPMaker2022\project1;

// Page object
$ResrateTimeAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { resrate_time: currentTable } });
var currentForm, currentPageID;
var fresrate_timeadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fresrate_timeadd = new ew.Form("fresrate_timeadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fresrate_timeadd;

    // Add fields
    var fields = currentTable.fields;
    fresrate_timeadd.addFields([
        ["pool_id", [fields.pool_id.visible && fields.pool_id.required ? ew.Validators.required(fields.pool_id.caption) : null], fields.pool_id.isInvalid],
        ["time", [fields.time.visible && fields.time.required ? ew.Validators.required(fields.time.caption) : null], fields.time.isInvalid]
    ]);

    // Form_CustomValidate
    fresrate_timeadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fresrate_timeadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fresrate_timeadd.lists.pool_id = <?= $Page->pool_id->toClientList($Page) ?>;
    loadjs.done("fresrate_timeadd");
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
<form name="fresrate_timeadd" id="fresrate_timeadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="resrate_time">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->pool_id->Visible) { // pool_id ?>
    <div id="r_pool_id"<?= $Page->pool_id->rowAttributes() ?>>
        <label id="elh_resrate_time_pool_id" for="x_pool_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pool_id->caption() ?><?= $Page->pool_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->pool_id->cellAttributes() ?>>
<span id="el_resrate_time_pool_id">
    <select
        id="x_pool_id"
        name="x_pool_id"
        class="form-select ew-select<?= $Page->pool_id->isInvalidClass() ?>"
        data-select2-id="fresrate_timeadd_x_pool_id"
        data-table="resrate_time"
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
loadjs.ready("fresrate_timeadd", function() {
    var options = { name: "x_pool_id", selectId: "fresrate_timeadd_x_pool_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fresrate_timeadd.lists.pool_id.lookupOptions.length) {
        options.data = { id: "x_pool_id", form: "fresrate_timeadd" };
    } else {
        options.ajax = { id: "x_pool_id", form: "fresrate_timeadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.resrate_time.fields.pool_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->time->Visible) { // time ?>
    <div id="r_time"<?= $Page->time->rowAttributes() ?>>
        <label id="elh_resrate_time_time" for="x_time" class="<?= $Page->LeftColumnClass ?>"><?= $Page->time->caption() ?><?= $Page->time->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->time->cellAttributes() ?>>
<span id="el_resrate_time_time">
<input type="<?= $Page->time->getInputTextType() ?>" name="x_time" id="x_time" data-table="resrate_time" data-field="x_time" value="<?= $Page->time->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->time->getPlaceHolder()) ?>"<?= $Page->time->editAttributes() ?> aria-describedby="x_time_help">
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
    ew.addEventHandlers("resrate_time");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
