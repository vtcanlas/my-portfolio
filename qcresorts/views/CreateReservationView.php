<?php

namespace PHPMaker2022\project1;

// Page object
$CreateReservationView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { CreateReservation: currentTable } });
var currentForm, currentPageID;
var fCreateReservationview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fCreateReservationview = new ew.Form("fCreateReservationview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fCreateReservationview;
    loadjs.done("fCreateReservationview");
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
<form name="fCreateReservationview" id="fCreateReservationview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="CreateReservation">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->res_id->Visible) { // res_id ?>
    <tr id="r_res_id"<?= $Page->res_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_CreateReservation_res_id"><?= $Page->res_id->caption() ?></span></td>
        <td data-name="res_id"<?= $Page->res_id->cellAttributes() ?>>
<span id="el_CreateReservation_res_id">
<span<?= $Page->res_id->viewAttributes() ?>>
<?= $Page->res_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->fname->Visible) { // fname ?>
    <tr id="r_fname"<?= $Page->fname->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_CreateReservation_fname"><?= $Page->fname->caption() ?></span></td>
        <td data-name="fname"<?= $Page->fname->cellAttributes() ?>>
<span id="el_CreateReservation_fname">
<span<?= $Page->fname->viewAttributes() ?>>
<?= $Page->fname->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->lname->Visible) { // lname ?>
    <tr id="r_lname"<?= $Page->lname->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_CreateReservation_lname"><?= $Page->lname->caption() ?></span></td>
        <td data-name="lname"<?= $Page->lname->cellAttributes() ?>>
<span id="el_CreateReservation_lname">
<span<?= $Page->lname->viewAttributes() ?>>
<?= $Page->lname->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->address->Visible) { // address ?>
    <tr id="r_address"<?= $Page->address->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_CreateReservation_address"><?= $Page->address->caption() ?></span></td>
        <td data-name="address"<?= $Page->address->cellAttributes() ?>>
<span id="el_CreateReservation_address">
<span<?= $Page->address->viewAttributes() ?>>
<?= $Page->address->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->contactno->Visible) { // contactno ?>
    <tr id="r_contactno"<?= $Page->contactno->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_CreateReservation_contactno"><?= $Page->contactno->caption() ?></span></td>
        <td data-name="contactno"<?= $Page->contactno->cellAttributes() ?>>
<span id="el_CreateReservation_contactno">
<span<?= $Page->contactno->viewAttributes() ?>>
<?= $Page->contactno->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
    <tr id="r__email"<?= $Page->_email->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_CreateReservation__email"><?= $Page->_email->caption() ?></span></td>
        <td data-name="_email"<?= $Page->_email->cellAttributes() ?>>
<span id="el_CreateReservation__email">
<span<?= $Page->_email->viewAttributes() ?>>
<?= $Page->_email->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->pool_id->Visible) { // pool_id ?>
    <tr id="r_pool_id"<?= $Page->pool_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_CreateReservation_pool_id"><?= $Page->pool_id->caption() ?></span></td>
        <td data-name="pool_id"<?= $Page->pool_id->cellAttributes() ?>>
<span id="el_CreateReservation_pool_id">
<span<?= $Page->pool_id->viewAttributes() ?>>
<?= $Page->pool_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->proofofpayment->Visible) { // proofofpayment ?>
    <tr id="r_proofofpayment"<?= $Page->proofofpayment->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_CreateReservation_proofofpayment"><?= $Page->proofofpayment->caption() ?></span></td>
        <td data-name="proofofpayment"<?= $Page->proofofpayment->cellAttributes() ?>>
<span id="el_CreateReservation_proofofpayment">
<span<?= $Page->proofofpayment->viewAttributes() ?>>
<?= GetFileViewTag($Page->proofofpayment, $Page->proofofpayment->getViewValue(), false) ?>
</span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->date->Visible) { // date ?>
    <tr id="r_date"<?= $Page->date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_CreateReservation_date"><?= $Page->date->caption() ?></span></td>
        <td data-name="date"<?= $Page->date->cellAttributes() ?>>
<span id="el_CreateReservation_date">
<span<?= $Page->date->viewAttributes() ?>>
<?= $Page->date->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->rate_id->Visible) { // rate_id ?>
    <tr id="r_rate_id"<?= $Page->rate_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_CreateReservation_rate_id"><?= $Page->rate_id->caption() ?></span></td>
        <td data-name="rate_id"<?= $Page->rate_id->cellAttributes() ?>>
<span id="el_CreateReservation_rate_id">
<span<?= $Page->rate_id->viewAttributes() ?>>
<?= $Page->rate_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->amountpaid->Visible) { // amountpaid ?>
    <tr id="r_amountpaid"<?= $Page->amountpaid->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_CreateReservation_amountpaid"><?= $Page->amountpaid->caption() ?></span></td>
        <td data-name="amountpaid"<?= $Page->amountpaid->cellAttributes() ?>>
<span id="el_CreateReservation_amountpaid">
<span<?= $Page->amountpaid->viewAttributes() ?>>
<?= $Page->amountpaid->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->dateuploaded->Visible) { // dateuploaded ?>
    <tr id="r_dateuploaded"<?= $Page->dateuploaded->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_CreateReservation_dateuploaded"><?= $Page->dateuploaded->caption() ?></span></td>
        <td data-name="dateuploaded"<?= $Page->dateuploaded->cellAttributes() ?>>
<span id="el_CreateReservation_dateuploaded">
<span<?= $Page->dateuploaded->viewAttributes() ?>>
<?= $Page->dateuploaded->getViewValue() ?></span>
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
