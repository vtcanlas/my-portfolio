<?php

namespace PHPMaker2022\project1;

// Page object
$Poolpics2View = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { poolpics2: currentTable } });
var currentForm, currentPageID;
var fpoolpics2view;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fpoolpics2view = new ew.Form("fpoolpics2view", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fpoolpics2view;
    loadjs.done("fpoolpics2view");
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
<form name="fpoolpics2view" id="fpoolpics2view" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="poolpics2">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->pic_id->Visible) { // pic_id ?>
    <tr id="r_pic_id"<?= $Page->pic_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_poolpics2_pic_id"><?= $Page->pic_id->caption() ?></span></td>
        <td data-name="pic_id"<?= $Page->pic_id->cellAttributes() ?>>
<span id="el_poolpics2_pic_id">
<span<?= $Page->pic_id->viewAttributes() ?>>
<?= $Page->pic_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->img->Visible) { // img ?>
    <tr id="r_img"<?= $Page->img->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_poolpics2_img"><?= $Page->img->caption() ?></span></td>
        <td data-name="img"<?= $Page->img->cellAttributes() ?>>
<span id="el_poolpics2_img">
<span<?= $Page->img->viewAttributes() ?>>
<?= GetFileViewTag($Page->img, $Page->img->getViewValue(), false) ?>
</span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->active->Visible) { // active ?>
    <tr id="r_active"<?= $Page->active->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_poolpics2_active"><?= $Page->active->caption() ?></span></td>
        <td data-name="active"<?= $Page->active->cellAttributes() ?>>
<span id="el_poolpics2_active">
<span<?= $Page->active->viewAttributes() ?>>
<?= $Page->active->getViewValue() ?></span>
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
