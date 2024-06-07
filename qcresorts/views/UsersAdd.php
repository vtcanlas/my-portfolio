<?php

namespace PHPMaker2023\project1;

// Page object
$UsersAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { users: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fusersadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fusersadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["fname", [fields.fname.visible && fields.fname.required ? ew.Validators.required(fields.fname.caption) : null], fields.fname.isInvalid],
            ["lname", [fields.lname.visible && fields.lname.required ? ew.Validators.required(fields.lname.caption) : null], fields.lname.isInvalid],
            ["uname", [fields.uname.visible && fields.uname.required ? ew.Validators.required(fields.uname.caption) : null], fields.uname.isInvalid],
            ["pword", [fields.pword.visible && fields.pword.required ? ew.Validators.required(fields.pword.caption) : null], fields.pword.isInvalid],
            ["_email", [fields._email.visible && fields._email.required ? ew.Validators.required(fields._email.caption) : null], fields._email.isInvalid],
            ["_userlevel", [fields._userlevel.visible && fields._userlevel.required ? ew.Validators.required(fields._userlevel.caption) : null], fields._userlevel.isInvalid]
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
            "_userlevel": <?= $Page->_userlevel->toClientList($Page) ?>,
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
<form name="fusersadd" id="fusersadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="users">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->fname->Visible) { // fname ?>
    <div id="r_fname"<?= $Page->fname->rowAttributes() ?>>
        <label id="elh_users_fname" for="x_fname" class="<?= $Page->LeftColumnClass ?>"><?= $Page->fname->caption() ?><?= $Page->fname->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->fname->cellAttributes() ?>>
<span id="el_users_fname">
<input type="<?= $Page->fname->getInputTextType() ?>" name="x_fname" id="x_fname" data-table="users" data-field="x_fname" value="<?= $Page->fname->EditValue ?>" size="30" maxlength="25" placeholder="<?= HtmlEncode($Page->fname->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->fname->formatPattern()) ?>"<?= $Page->fname->editAttributes() ?> aria-describedby="x_fname_help">
<?= $Page->fname->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->fname->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->lname->Visible) { // lname ?>
    <div id="r_lname"<?= $Page->lname->rowAttributes() ?>>
        <label id="elh_users_lname" for="x_lname" class="<?= $Page->LeftColumnClass ?>"><?= $Page->lname->caption() ?><?= $Page->lname->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->lname->cellAttributes() ?>>
<span id="el_users_lname">
<input type="<?= $Page->lname->getInputTextType() ?>" name="x_lname" id="x_lname" data-table="users" data-field="x_lname" value="<?= $Page->lname->EditValue ?>" size="30" maxlength="25" placeholder="<?= HtmlEncode($Page->lname->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->lname->formatPattern()) ?>"<?= $Page->lname->editAttributes() ?> aria-describedby="x_lname_help">
<?= $Page->lname->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->lname->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->uname->Visible) { // uname ?>
    <div id="r_uname"<?= $Page->uname->rowAttributes() ?>>
        <label id="elh_users_uname" for="x_uname" class="<?= $Page->LeftColumnClass ?>"><?= $Page->uname->caption() ?><?= $Page->uname->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->uname->cellAttributes() ?>>
<span id="el_users_uname">
<input type="<?= $Page->uname->getInputTextType() ?>" name="x_uname" id="x_uname" data-table="users" data-field="x_uname" value="<?= $Page->uname->EditValue ?>" size="30" maxlength="25" placeholder="<?= HtmlEncode($Page->uname->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->uname->formatPattern()) ?>"<?= $Page->uname->editAttributes() ?> aria-describedby="x_uname_help">
<?= $Page->uname->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->uname->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->pword->Visible) { // pword ?>
    <div id="r_pword"<?= $Page->pword->rowAttributes() ?>>
        <label id="elh_users_pword" for="x_pword" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pword->caption() ?><?= $Page->pword->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->pword->cellAttributes() ?>>
<span id="el_users_pword">
<div class="input-group">
    <input type="password" name="x_pword" id="x_pword" autocomplete="new-password" data-field="x_pword" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->pword->getPlaceHolder()) ?>"<?= $Page->pword->editAttributes() ?> aria-describedby="x_pword_help">
    <button type="button" class="btn btn-default ew-toggle-password rounded-end" data-ew-action="password"><i class="fa-solid fa-eye"></i></button>
</div>
<?= $Page->pword->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->pword->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
    <div id="r__email"<?= $Page->_email->rowAttributes() ?>>
        <label id="elh_users__email" for="x__email" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_email->caption() ?><?= $Page->_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->_email->cellAttributes() ?>>
<span id="el_users__email">
<input type="<?= $Page->_email->getInputTextType() ?>" name="x__email" id="x__email" data-table="users" data-field="x__email" value="<?= $Page->_email->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->_email->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->_email->formatPattern()) ?>"<?= $Page->_email->editAttributes() ?> aria-describedby="x__email_help">
<?= $Page->_email->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_email->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_userlevel->Visible) { // userlevel ?>
    <div id="r__userlevel"<?= $Page->_userlevel->rowAttributes() ?>>
        <label id="elh_users__userlevel" for="x__userlevel" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_userlevel->caption() ?><?= $Page->_userlevel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->_userlevel->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<span id="el_users__userlevel">
<span class="form-control-plaintext"><?= $Page->_userlevel->getDisplayValue($Page->_userlevel->EditValue) ?></span>
</span>
<?php } else { ?>
<span id="el_users__userlevel">
    <select
        id="x__userlevel"
        name="x__userlevel"
        class="form-select ew-select<?= $Page->_userlevel->isInvalidClass() ?>"
        data-select2-id="fusersadd_x__userlevel"
        data-table="users"
        data-field="x__userlevel"
        data-value-separator="<?= $Page->_userlevel->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->_userlevel->getPlaceHolder()) ?>"
        <?= $Page->_userlevel->editAttributes() ?>>
        <?= $Page->_userlevel->selectOptionListHtml("x__userlevel") ?>
    </select>
    <?= $Page->_userlevel->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->_userlevel->getErrorMessage() ?></div>
<?= $Page->_userlevel->Lookup->getParamTag($Page, "p_x__userlevel") ?>
<script>
loadjs.ready("fusersadd", function() {
    var options = { name: "x__userlevel", selectId: "fusersadd_x__userlevel" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fusersadd.lists._userlevel?.lookupOptions.length) {
        options.data = { id: "x__userlevel", form: "fusersadd" };
    } else {
        options.ajax = { id: "x__userlevel", form: "fusersadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.users.fields._userlevel.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fusersadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fusersadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("users");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
