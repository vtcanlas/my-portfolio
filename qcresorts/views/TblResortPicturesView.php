<?php

namespace PHPMaker2022\project1;

// Page object
$TblResortPicturesView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { tbl_resort_pictures: currentTable } });
var currentForm, currentPageID;
var ftbl_resort_picturesview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    ftbl_resort_picturesview = new ew.Form("ftbl_resort_picturesview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = ftbl_resort_picturesview;
    loadjs.done("ftbl_resort_picturesview");
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
<form name="ftbl_resort_picturesview" id="ftbl_resort_picturesview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="tbl_resort_pictures">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->pic_id->Visible) { // pic_id ?>
    <tr id="r_pic_id"<?= $Page->pic_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_tbl_resort_pictures_pic_id"><?= $Page->pic_id->caption() ?></span></td>
        <td data-name="pic_id"<?= $Page->pic_id->cellAttributes() ?>>
<span id="el_tbl_resort_pictures_pic_id">
<span<?= $Page->pic_id->viewAttributes() ?>>
<?= $Page->pic_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->img->Visible) { // img ?>
    <tr id="r_img"<?= $Page->img->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_tbl_resort_pictures_img"><?= $Page->img->caption() ?></span></td>
        <td data-name="img"<?= $Page->img->cellAttributes() ?>>
<span id="el_tbl_resort_pictures_img">
<span<?= $Page->img->viewAttributes() ?>>
<?= GetFileViewTag($Page->img, $Page->img->getViewValue(), false) ?>
</span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->active->Visible) { // active ?>
    <tr id="r_active"<?= $Page->active->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_tbl_resort_pictures_active"><?= $Page->active->caption() ?></span></td>
        <td data-name="active"<?= $Page->active->cellAttributes() ?>>
<span id="el_tbl_resort_pictures_active">
<span<?= $Page->active->viewAttributes() ?>>
<?= $Page->active->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->pool_id->Visible) { // pool_id ?>
    <tr id="r_pool_id"<?= $Page->pool_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_tbl_resort_pictures_pool_id"><?= $Page->pool_id->caption() ?></span></td>
        <td data-name="pool_id"<?= $Page->pool_id->cellAttributes() ?>>
<span id="el_tbl_resort_pictures_pool_id">
<span<?= $Page->pool_id->viewAttributes() ?>>
<?= $Page->pool_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->user_id->Visible) { // user_id ?>
    <tr id="r_user_id"<?= $Page->user_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_tbl_resort_pictures_user_id"><?= $Page->user_id->caption() ?></span></td>
        <td data-name="user_id"<?= $Page->user_id->cellAttributes() ?>>
<span id="el_tbl_resort_pictures_user_id">
<span<?= $Page->user_id->viewAttributes() ?>>
<?= $Page->user_id->getViewValue() ?></span>
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
