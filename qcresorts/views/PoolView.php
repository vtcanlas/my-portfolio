<?php

namespace PHPMaker2023\project1;

// Page object
$PoolView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Page->ExportOptions->render("body") ?>
<?php $Page->OtherOptions->render("body") ?>
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="view">
<form name="fpoolview" id="fpoolview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { pool: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fpoolview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fpoolview")
        .setPageId("view")
        .build();
    window[form.id] = form;
    currentForm = form;
    loadjs.done(form.id);
});
</script>
<?php } ?>
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="pool">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->pool_id->Visible) { // pool_id ?>
    <tr id="r_pool_id"<?= $Page->pool_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pool_pool_id"><?= $Page->pool_id->caption() ?></span></td>
        <td data-name="pool_id"<?= $Page->pool_id->cellAttributes() ?>>
<span id="el_pool_pool_id">
<span<?= $Page->pool_id->viewAttributes() ?>>
<?= $Page->pool_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->pool_name->Visible) { // pool_name ?>
    <tr id="r_pool_name"<?= $Page->pool_name->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pool_pool_name"><?= $Page->pool_name->caption() ?></span></td>
        <td data-name="pool_name"<?= $Page->pool_name->cellAttributes() ?>>
<span id="el_pool_pool_name">
<span<?= $Page->pool_name->viewAttributes() ?>>
<?= $Page->pool_name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->pool_description->Visible) { // pool_description ?>
    <tr id="r_pool_description"<?= $Page->pool_description->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pool_pool_description"><?= $Page->pool_description->caption() ?></span></td>
        <td data-name="pool_description"<?= $Page->pool_description->cellAttributes() ?>>
<span id="el_pool_pool_description">
<span<?= $Page->pool_description->viewAttributes() ?>>
<?= $Page->pool_description->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->poolcat->Visible) { // poolcat ?>
    <tr id="r_poolcat"<?= $Page->poolcat->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pool_poolcat"><?= $Page->poolcat->caption() ?></span></td>
        <td data-name="poolcat"<?= $Page->poolcat->cellAttributes() ?>>
<span id="el_pool_poolcat">
<span<?= $Page->poolcat->viewAttributes() ?>>
<?= $Page->poolcat->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->address->Visible) { // address ?>
    <tr id="r_address"<?= $Page->address->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pool_address"><?= $Page->address->caption() ?></span></td>
        <td data-name="address"<?= $Page->address->cellAttributes() ?>>
<span id="el_pool_address">
<span<?= $Page->address->viewAttributes() ?>>
<?= $Page->address->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->contactno1->Visible) { // contactno1 ?>
    <tr id="r_contactno1"<?= $Page->contactno1->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pool_contactno1"><?= $Page->contactno1->caption() ?></span></td>
        <td data-name="contactno1"<?= $Page->contactno1->cellAttributes() ?>>
<span id="el_pool_contactno1">
<span<?= $Page->contactno1->viewAttributes() ?>>
<?= $Page->contactno1->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->socmed->Visible) { // socmed ?>
    <tr id="r_socmed"<?= $Page->socmed->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pool_socmed"><?= $Page->socmed->caption() ?></span></td>
        <td data-name="socmed"<?= $Page->socmed->cellAttributes() ?>>
<span id="el_pool_socmed">
<span<?= $Page->socmed->viewAttributes() ?>>
<?= $Page->socmed->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->emailaddress->Visible) { // emailaddress ?>
    <tr id="r_emailaddress"<?= $Page->emailaddress->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pool_emailaddress"><?= $Page->emailaddress->caption() ?></span></td>
        <td data-name="emailaddress"<?= $Page->emailaddress->cellAttributes() ?>>
<span id="el_pool_emailaddress">
<span<?= $Page->emailaddress->viewAttributes() ?>>
<?= $Page->emailaddress->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->barangay->Visible) { // barangay ?>
    <tr id="r_barangay"<?= $Page->barangay->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pool_barangay"><?= $Page->barangay->caption() ?></span></td>
        <td data-name="barangay"<?= $Page->barangay->cellAttributes() ?>>
<span id="el_pool_barangay">
<span<?= $Page->barangay->viewAttributes() ?>>
<?= $Page->barangay->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->uname->Visible) { // uname ?>
    <tr id="r_uname"<?= $Page->uname->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pool_uname"><?= $Page->uname->caption() ?></span></td>
        <td data-name="uname"<?= $Page->uname->cellAttributes() ?>>
<span id="el_pool_uname">
<span<?= $Page->uname->viewAttributes() ?>>
<?= $Page->uname->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
<?php
    if (in_array("poolpics", explode(",", $Page->getCurrentDetailTable())) && $poolpics->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("poolpics", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "PoolpicsGrid.php" ?>
<?php } ?>
<?php
    if (in_array("poolrates", explode(",", $Page->getCurrentDetailTable())) && $poolrates->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("poolrates", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "PoolratesGrid.php" ?>
<?php } ?>
</form>
</main>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
