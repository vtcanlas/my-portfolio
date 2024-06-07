<?php

namespace PHPMaker2023\project1;

// Page object
$UsersDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { users: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fusersdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fusersdelete")
        .setPageId("delete")
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
<form name="fusersdelete" id="fusersdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="users">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid <?= $Page->TableGridClass ?>">
<div class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>" style="<?= $Page->TableContainerStyle ?>">
<table class="<?= $Page->TableClass ?>">
    <thead>
    <tr class="ew-table-header">
<?php if ($Page->fname->Visible) { // fname ?>
        <th class="<?= $Page->fname->headerCellClass() ?>"><span id="elh_users_fname" class="users_fname"><?= $Page->fname->caption() ?></span></th>
<?php } ?>
<?php if ($Page->lname->Visible) { // lname ?>
        <th class="<?= $Page->lname->headerCellClass() ?>"><span id="elh_users_lname" class="users_lname"><?= $Page->lname->caption() ?></span></th>
<?php } ?>
<?php if ($Page->uname->Visible) { // uname ?>
        <th class="<?= $Page->uname->headerCellClass() ?>"><span id="elh_users_uname" class="users_uname"><?= $Page->uname->caption() ?></span></th>
<?php } ?>
<?php if ($Page->pword->Visible) { // pword ?>
        <th class="<?= $Page->pword->headerCellClass() ?>"><span id="elh_users_pword" class="users_pword"><?= $Page->pword->caption() ?></span></th>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
        <th class="<?= $Page->_email->headerCellClass() ?>"><span id="elh_users__email" class="users__email"><?= $Page->_email->caption() ?></span></th>
<?php } ?>
<?php if ($Page->_userlevel->Visible) { // userlevel ?>
        <th class="<?= $Page->_userlevel->headerCellClass() ?>"><span id="elh_users__userlevel" class="users__userlevel"><?= $Page->_userlevel->caption() ?></span></th>
<?php } ?>
    </tr>
    </thead>
    <tbody>
<?php
$Page->RecordCount = 0;
$i = 0;
while (!$Page->Recordset->EOF) {
    $Page->RecordCount++;
    $Page->RowCount++;

    // Set row properties
    $Page->resetAttributes();
    $Page->RowType = ROWTYPE_VIEW; // View

    // Get the field contents
    $Page->loadRowValues($Page->Recordset);

    // Render row
    $Page->renderRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php if ($Page->fname->Visible) { // fname ?>
        <td<?= $Page->fname->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_users_fname" class="el_users_fname">
<span<?= $Page->fname->viewAttributes() ?>>
<?= $Page->fname->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->lname->Visible) { // lname ?>
        <td<?= $Page->lname->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_users_lname" class="el_users_lname">
<span<?= $Page->lname->viewAttributes() ?>>
<?= $Page->lname->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->uname->Visible) { // uname ?>
        <td<?= $Page->uname->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_users_uname" class="el_users_uname">
<span<?= $Page->uname->viewAttributes() ?>>
<?= $Page->uname->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->pword->Visible) { // pword ?>
        <td<?= $Page->pword->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_users_pword" class="el_users_pword">
<span<?= $Page->pword->viewAttributes() ?>>
<?= $Page->pword->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
        <td<?= $Page->_email->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_users__email" class="el_users__email">
<span<?= $Page->_email->viewAttributes() ?>>
<?= $Page->_email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->_userlevel->Visible) { // userlevel ?>
        <td<?= $Page->_userlevel->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_users__userlevel" class="el_users__userlevel">
<span<?= $Page->_userlevel->viewAttributes() ?>>
<?= $Page->_userlevel->getViewValue() ?></span>
</span>
</td>
<?php } ?>
    </tr>
<?php
    $Page->Recordset->moveNext();
}
$Page->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div class="ew-buttons ew-desktop-buttons">
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
