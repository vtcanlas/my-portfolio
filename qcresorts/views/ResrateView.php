<?php

namespace PHPMaker2022\project1;

// Page object
$ResrateView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { resrate: currentTable } });
var currentForm, currentPageID;
var fresrateview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fresrateview = new ew.Form("fresrateview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fresrateview;
    loadjs.done("fresrateview");
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
<form name="fresrateview" id="fresrateview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="resrate">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->resrate_id->Visible) { // resrate_id ?>
    <tr id="r_resrate_id"<?= $Page->resrate_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_resrate_resrate_id"><?= $Page->resrate_id->caption() ?></span></td>
        <td data-name="resrate_id"<?= $Page->resrate_id->cellAttributes() ?>>
<span id="el_resrate_resrate_id">
<span<?= $Page->resrate_id->viewAttributes() ?>>
<?= $Page->resrate_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->pool_id->Visible) { // pool_id ?>
    <tr id="r_pool_id"<?= $Page->pool_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_resrate_pool_id"><?= $Page->pool_id->caption() ?></span></td>
        <td data-name="pool_id"<?= $Page->pool_id->cellAttributes() ?>>
<span id="el_resrate_pool_id">
<span<?= $Page->pool_id->viewAttributes() ?>>
<?= $Page->pool_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->priceadult->Visible) { // priceadult ?>
    <tr id="r_priceadult"<?= $Page->priceadult->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_resrate_priceadult"><?= $Page->priceadult->caption() ?></span></td>
        <td data-name="priceadult"<?= $Page->priceadult->cellAttributes() ?>>
<span id="el_resrate_priceadult">
<span<?= $Page->priceadult->viewAttributes() ?>>
<?= $Page->priceadult->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->pricechild->Visible) { // pricechild ?>
    <tr id="r_pricechild"<?= $Page->pricechild->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_resrate_pricechild"><?= $Page->pricechild->caption() ?></span></td>
        <td data-name="pricechild"<?= $Page->pricechild->cellAttributes() ?>>
<span id="el_resrate_pricechild">
<span<?= $Page->pricechild->viewAttributes() ?>>
<?= $Page->pricechild->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->priceadultspecial->Visible) { // priceadultspecial ?>
    <tr id="r_priceadultspecial"<?= $Page->priceadultspecial->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_resrate_priceadultspecial"><?= $Page->priceadultspecial->caption() ?></span></td>
        <td data-name="priceadultspecial"<?= $Page->priceadultspecial->cellAttributes() ?>>
<span id="el_resrate_priceadultspecial">
<span<?= $Page->priceadultspecial->viewAttributes() ?>>
<?= $Page->priceadultspecial->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->pricechildspecial->Visible) { // pricechildspecial ?>
    <tr id="r_pricechildspecial"<?= $Page->pricechildspecial->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_resrate_pricechildspecial"><?= $Page->pricechildspecial->caption() ?></span></td>
        <td data-name="pricechildspecial"<?= $Page->pricechildspecial->cellAttributes() ?>>
<span id="el_resrate_pricechildspecial">
<span<?= $Page->pricechildspecial->viewAttributes() ?>>
<?= $Page->pricechildspecial->getViewValue() ?></span>
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
