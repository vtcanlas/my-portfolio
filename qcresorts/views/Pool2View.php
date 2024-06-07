<?php

namespace PHPMaker2022\project1;

// Page object
$Pool2View = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { pool2: currentTable } });
var currentForm, currentPageID;
var fpool2view;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fpool2view = new ew.Form("fpool2view", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fpool2view;
    loadjs.done("fpool2view");
});
</script>
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
<form name="fpool2view" id="fpool2view" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="pool2">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->pool_id->Visible) { // pool_id ?>
    <tr id="r_pool_id"<?= $Page->pool_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pool2_pool_id"><?= $Page->pool_id->caption() ?></span></td>
        <td data-name="pool_id"<?= $Page->pool_id->cellAttributes() ?>>
<span id="el_pool2_pool_id">
<span<?= $Page->pool_id->viewAttributes() ?>>
<?= $Page->pool_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->pool_name->Visible) { // pool_name ?>
    <tr id="r_pool_name"<?= $Page->pool_name->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pool2_pool_name"><?= $Page->pool_name->caption() ?></span></td>
        <td data-name="pool_name"<?= $Page->pool_name->cellAttributes() ?>>
<span id="el_pool2_pool_name">
<span<?= $Page->pool_name->viewAttributes() ?>>
<?= $Page->pool_name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->pool_description->Visible) { // pool_description ?>
    <tr id="r_pool_description"<?= $Page->pool_description->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pool2_pool_description"><?= $Page->pool_description->caption() ?></span></td>
        <td data-name="pool_description"<?= $Page->pool_description->cellAttributes() ?>>
<span id="el_pool2_pool_description">
<span<?= $Page->pool_description->viewAttributes() ?>>
<?= $Page->pool_description->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->barangay->Visible) { // barangay ?>
    <tr id="r_barangay"<?= $Page->barangay->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pool2_barangay"><?= $Page->barangay->caption() ?></span></td>
        <td data-name="barangay"<?= $Page->barangay->cellAttributes() ?>>
<span id="el_pool2_barangay">
<span<?= $Page->barangay->viewAttributes() ?>>
<?= $Page->barangay->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->poolcat->Visible) { // poolcat ?>
    <tr id="r_poolcat"<?= $Page->poolcat->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pool2_poolcat"><?= $Page->poolcat->caption() ?></span></td>
        <td data-name="poolcat"<?= $Page->poolcat->cellAttributes() ?>>
<span id="el_pool2_poolcat">
<span<?= $Page->poolcat->viewAttributes() ?>>
<?= $Page->poolcat->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->address->Visible) { // address ?>
    <tr id="r_address"<?= $Page->address->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pool2_address"><?= $Page->address->caption() ?></span></td>
        <td data-name="address"<?= $Page->address->cellAttributes() ?>>
<span id="el_pool2_address">
<span<?= $Page->address->viewAttributes() ?>>
<?= $Page->address->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->contactno1->Visible) { // contactno1 ?>
    <tr id="r_contactno1"<?= $Page->contactno1->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pool2_contactno1"><?= $Page->contactno1->caption() ?></span></td>
        <td data-name="contactno1"<?= $Page->contactno1->cellAttributes() ?>>
<span id="el_pool2_contactno1">
<span<?= $Page->contactno1->viewAttributes() ?>>
<?= $Page->contactno1->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->emailaddress->Visible) { // emailaddress ?>
    <tr id="r_emailaddress"<?= $Page->emailaddress->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pool2_emailaddress"><?= $Page->emailaddress->caption() ?></span></td>
        <td data-name="emailaddress"<?= $Page->emailaddress->cellAttributes() ?>>
<span id="el_pool2_emailaddress">
<span<?= $Page->emailaddress->viewAttributes() ?>>
<?= $Page->emailaddress->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->socmed->Visible) { // socmed ?>
    <tr id="r_socmed"<?= $Page->socmed->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pool2_socmed"><?= $Page->socmed->caption() ?></span></td>
        <td data-name="socmed"<?= $Page->socmed->cellAttributes() ?>>
<span id="el_pool2_socmed">
<span<?= $Page->socmed->viewAttributes() ?>>
<?= $Page->socmed->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->uname->Visible) { // uname ?>
    <tr id="r_uname"<?= $Page->uname->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pool2_uname"><?= $Page->uname->caption() ?></span></td>
        <td data-name="uname"<?= $Page->uname->cellAttributes() ?>>
<span id="el_pool2_uname">
<span<?= $Page->uname->viewAttributes() ?>>
<?= $Page->uname->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
</form>
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
