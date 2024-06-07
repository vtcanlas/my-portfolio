<?php

namespace PHPMaker2023\project1;

// Page object
$ApprovedReservationsView = &$Page;
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
<form name="fApprovedReservationsview" id="fApprovedReservationsview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { ApprovedReservations: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fApprovedReservationsview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fApprovedReservationsview")
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
<input type="hidden" name="t" value="ApprovedReservations">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->date->Visible) { // date ?>
    <tr id="r_date"<?= $Page->date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ApprovedReservations_date"><?= $Page->date->caption() ?></span></td>
        <td data-name="date"<?= $Page->date->cellAttributes() ?>>
<span id="el_ApprovedReservations_date">
<span<?= $Page->date->viewAttributes() ?>>
<?= $Page->date->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->rate_id->Visible) { // rate_id ?>
    <tr id="r_rate_id"<?= $Page->rate_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ApprovedReservations_rate_id"><?= $Page->rate_id->caption() ?></span></td>
        <td data-name="rate_id"<?= $Page->rate_id->cellAttributes() ?>>
<span id="el_ApprovedReservations_rate_id">
<span<?= $Page->rate_id->viewAttributes() ?>>
<?= $Page->rate_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->fname->Visible) { // fname ?>
    <tr id="r_fname"<?= $Page->fname->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ApprovedReservations_fname"><?= $Page->fname->caption() ?></span></td>
        <td data-name="fname"<?= $Page->fname->cellAttributes() ?>>
<span id="el_ApprovedReservations_fname">
<span<?= $Page->fname->viewAttributes() ?>>
<?= $Page->fname->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->lname->Visible) { // lname ?>
    <tr id="r_lname"<?= $Page->lname->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ApprovedReservations_lname"><?= $Page->lname->caption() ?></span></td>
        <td data-name="lname"<?= $Page->lname->cellAttributes() ?>>
<span id="el_ApprovedReservations_lname">
<span<?= $Page->lname->viewAttributes() ?>>
<?= $Page->lname->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->address->Visible) { // address ?>
    <tr id="r_address"<?= $Page->address->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ApprovedReservations_address"><?= $Page->address->caption() ?></span></td>
        <td data-name="address"<?= $Page->address->cellAttributes() ?>>
<span id="el_ApprovedReservations_address">
<span<?= $Page->address->viewAttributes() ?>>
<?= $Page->address->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->contactno->Visible) { // contactno ?>
    <tr id="r_contactno"<?= $Page->contactno->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ApprovedReservations_contactno"><?= $Page->contactno->caption() ?></span></td>
        <td data-name="contactno"<?= $Page->contactno->cellAttributes() ?>>
<span id="el_ApprovedReservations_contactno">
<span<?= $Page->contactno->viewAttributes() ?>>
<?= $Page->contactno->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
    <tr id="r__email"<?= $Page->_email->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ApprovedReservations__email"><?= $Page->_email->caption() ?></span></td>
        <td data-name="_email"<?= $Page->_email->cellAttributes() ?>>
<span id="el_ApprovedReservations__email">
<span<?= $Page->_email->viewAttributes() ?>>
<?= $Page->_email->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->proofofpayment->Visible) { // proofofpayment ?>
    <tr id="r_proofofpayment"<?= $Page->proofofpayment->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ApprovedReservations_proofofpayment"><?= $Page->proofofpayment->caption() ?></span></td>
        <td data-name="proofofpayment"<?= $Page->proofofpayment->cellAttributes() ?>>
<span id="el_ApprovedReservations_proofofpayment">
<span<?= $Page->proofofpayment->viewAttributes() ?>>
<?= GetFileViewTag($Page->proofofpayment, $Page->proofofpayment->getViewValue(), false) ?>
</span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->paymentamount->Visible) { // paymentamount ?>
    <tr id="r_paymentamount"<?= $Page->paymentamount->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ApprovedReservations_paymentamount"><?= $Page->paymentamount->caption() ?></span></td>
        <td data-name="paymentamount"<?= $Page->paymentamount->cellAttributes() ?>>
<span id="el_ApprovedReservations_paymentamount">
<span<?= $Page->paymentamount->viewAttributes() ?>>
<?= $Page->paymentamount->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->dateuploaded->Visible) { // dateuploaded ?>
    <tr id="r_dateuploaded"<?= $Page->dateuploaded->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ApprovedReservations_dateuploaded"><?= $Page->dateuploaded->caption() ?></span></td>
        <td data-name="dateuploaded"<?= $Page->dateuploaded->cellAttributes() ?>>
<span id="el_ApprovedReservations_dateuploaded">
<span<?= $Page->dateuploaded->viewAttributes() ?>>
<?= $Page->dateuploaded->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->approved->Visible) { // approved ?>
    <tr id="r_approved"<?= $Page->approved->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ApprovedReservations_approved"><?= $Page->approved->caption() ?></span></td>
        <td data-name="approved"<?= $Page->approved->cellAttributes() ?>>
<span id="el_ApprovedReservations_approved">
<span<?= $Page->approved->viewAttributes() ?>>
<?= $Page->approved->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->uname->Visible) { // uname ?>
    <tr id="r_uname"<?= $Page->uname->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ApprovedReservations_uname"><?= $Page->uname->caption() ?></span></td>
        <td data-name="uname"<?= $Page->uname->cellAttributes() ?>>
<span id="el_ApprovedReservations_uname">
<span<?= $Page->uname->viewAttributes() ?>>
<?= $Page->uname->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
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
