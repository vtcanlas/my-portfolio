<?php

namespace PHPMaker2022\project1;

// Page object
$ResrateTime2View = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { resrate_time2: currentTable } });
var currentForm, currentPageID;
var fresrate_time2view;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fresrate_time2view = new ew.Form("fresrate_time2view", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fresrate_time2view;
    loadjs.done("fresrate_time2view");
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
<form name="fresrate_time2view" id="fresrate_time2view" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="resrate_time2">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->time_id->Visible) { // time_id ?>
    <tr id="r_time_id"<?= $Page->time_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_resrate_time2_time_id"><?= $Page->time_id->caption() ?></span></td>
        <td data-name="time_id"<?= $Page->time_id->cellAttributes() ?>>
<span id="el_resrate_time2_time_id">
<span<?= $Page->time_id->viewAttributes() ?>>
<?= $Page->time_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->pool_id->Visible) { // pool_id ?>
    <tr id="r_pool_id"<?= $Page->pool_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_resrate_time2_pool_id"><?= $Page->pool_id->caption() ?></span></td>
        <td data-name="pool_id"<?= $Page->pool_id->cellAttributes() ?>>
<span id="el_resrate_time2_pool_id">
<span<?= $Page->pool_id->viewAttributes() ?>>
<?= $Page->pool_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->time->Visible) { // time ?>
    <tr id="r_time"<?= $Page->time->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_resrate_time2_time"><?= $Page->time->caption() ?></span></td>
        <td data-name="time"<?= $Page->time->cellAttributes() ?>>
<span id="el_resrate_time2_time">
<span<?= $Page->time->viewAttributes() ?>>
<?= $Page->time->getViewValue() ?></span>
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
