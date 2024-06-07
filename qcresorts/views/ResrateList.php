<?php

namespace PHPMaker2022\project1;

// Page object
$ResrateList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { resrate: currentTable } });
var currentForm, currentPageID;
var fresratelist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fresratelist = new ew.Form("fresratelist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fresratelist;
    fresratelist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";
    loadjs.done("fresratelist");
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
<?php if ($Page->TotalRecords > 0 && $Page->ExportOptions->visible()) { ?>
<?php $Page->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->ImportOptions->visible()) { ?>
<?php $Page->ImportOptions->render("body") ?>
<?php } ?>
</div>
<?php } ?>
<?php
$Page->renderOtherOptions();
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> resrate">
<form name="fresratelist" id="fresratelist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="resrate">
<div id="gmp_resrate" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_resratelist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Page->RowType = ROWTYPE_HEADER;

// Render list options
$Page->renderListOptions();

// Render list options (header, left)
$Page->ListOptions->render("header", "left");
?>
<?php if ($Page->resrate_id->Visible) { // resrate_id ?>
        <th data-name="resrate_id" class="<?= $Page->resrate_id->headerCellClass() ?>"><div id="elh_resrate_resrate_id" class="resrate_resrate_id"><?= $Page->renderFieldHeader($Page->resrate_id) ?></div></th>
<?php } ?>
<?php if ($Page->pool_id->Visible) { // pool_id ?>
        <th data-name="pool_id" class="<?= $Page->pool_id->headerCellClass() ?>"><div id="elh_resrate_pool_id" class="resrate_pool_id"><?= $Page->renderFieldHeader($Page->pool_id) ?></div></th>
<?php } ?>
<?php if ($Page->priceadult->Visible) { // priceadult ?>
        <th data-name="priceadult" class="<?= $Page->priceadult->headerCellClass() ?>"><div id="elh_resrate_priceadult" class="resrate_priceadult"><?= $Page->renderFieldHeader($Page->priceadult) ?></div></th>
<?php } ?>
<?php if ($Page->pricechild->Visible) { // pricechild ?>
        <th data-name="pricechild" class="<?= $Page->pricechild->headerCellClass() ?>"><div id="elh_resrate_pricechild" class="resrate_pricechild"><?= $Page->renderFieldHeader($Page->pricechild) ?></div></th>
<?php } ?>
<?php if ($Page->priceadultspecial->Visible) { // priceadultspecial ?>
        <th data-name="priceadultspecial" class="<?= $Page->priceadultspecial->headerCellClass() ?>"><div id="elh_resrate_priceadultspecial" class="resrate_priceadultspecial"><?= $Page->renderFieldHeader($Page->priceadultspecial) ?></div></th>
<?php } ?>
<?php if ($Page->pricechildspecial->Visible) { // pricechildspecial ?>
        <th data-name="pricechildspecial" class="<?= $Page->pricechildspecial->headerCellClass() ?>"><div id="elh_resrate_pricechildspecial" class="resrate_pricechildspecial"><?= $Page->renderFieldHeader($Page->pricechildspecial) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Page->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody>
<?php
if ($Page->ExportAll && $Page->isExport()) {
    $Page->StopRecord = $Page->TotalRecords;
} else {
    // Set the last record to display
    if ($Page->TotalRecords > $Page->StartRecord + $Page->DisplayRecords - 1) {
        $Page->StopRecord = $Page->StartRecord + $Page->DisplayRecords - 1;
    } else {
        $Page->StopRecord = $Page->TotalRecords;
    }
}
$Page->RecordCount = $Page->StartRecord - 1;
if ($Page->Recordset && !$Page->Recordset->EOF) {
    // Nothing to do
} elseif ($Page->isGridAdd() && !$Page->AllowAddDeleteRow && $Page->StopRecord == 0) {
    $Page->StopRecord = $Page->GridAddRowCount;
}

// Initialize aggregate
$Page->RowType = ROWTYPE_AGGREGATEINIT;
$Page->resetAttributes();
$Page->renderRow();
while ($Page->RecordCount < $Page->StopRecord) {
    $Page->RecordCount++;
    if ($Page->RecordCount >= $Page->StartRecord) {
        $Page->RowCount++;

        // Set up key count
        $Page->KeyCount = $Page->RowIndex;

        // Init row class and style
        $Page->resetAttributes();
        $Page->CssClass = "";
        if ($Page->isGridAdd()) {
            $Page->loadRowValues(); // Load default values
            $Page->OldKey = "";
            $Page->setKey($Page->OldKey);
        } else {
            $Page->loadRowValues($Page->Recordset); // Load row values
            if ($Page->isGridEdit()) {
                $Page->OldKey = $Page->getKey(true); // Get from CurrentValue
                $Page->setKey($Page->OldKey);
            }
        }
        $Page->RowType = ROWTYPE_VIEW; // Render view

        // Set up row attributes
        $Page->RowAttrs->merge([
            "data-rowindex" => $Page->RowCount,
            "id" => "r" . $Page->RowCount . "_resrate",
            "data-rowtype" => $Page->RowType,
            "class" => ($Page->RowCount % 2 != 1) ? "ew-table-alt-row" : "",
        ]);
        if ($Page->isAdd() && $Page->RowType == ROWTYPE_ADD || $Page->isEdit() && $Page->RowType == ROWTYPE_EDIT) { // Inline-Add/Edit row
            $Page->RowAttrs->appendClass("table-active");
        }

        // Render row
        $Page->renderRow();

        // Render list options
        $Page->renderListOptions();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Page->ListOptions->render("body", "left", $Page->RowCount);
?>
    <?php if ($Page->resrate_id->Visible) { // resrate_id ?>
        <td data-name="resrate_id"<?= $Page->resrate_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resrate_resrate_id" class="el_resrate_resrate_id">
<span<?= $Page->resrate_id->viewAttributes() ?>>
<?= $Page->resrate_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->pool_id->Visible) { // pool_id ?>
        <td data-name="pool_id"<?= $Page->pool_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resrate_pool_id" class="el_resrate_pool_id">
<span<?= $Page->pool_id->viewAttributes() ?>>
<?= $Page->pool_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->priceadult->Visible) { // priceadult ?>
        <td data-name="priceadult"<?= $Page->priceadult->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resrate_priceadult" class="el_resrate_priceadult">
<span<?= $Page->priceadult->viewAttributes() ?>>
<?= $Page->priceadult->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->pricechild->Visible) { // pricechild ?>
        <td data-name="pricechild"<?= $Page->pricechild->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resrate_pricechild" class="el_resrate_pricechild">
<span<?= $Page->pricechild->viewAttributes() ?>>
<?= $Page->pricechild->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->priceadultspecial->Visible) { // priceadultspecial ?>
        <td data-name="priceadultspecial"<?= $Page->priceadultspecial->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resrate_priceadultspecial" class="el_resrate_priceadultspecial">
<span<?= $Page->priceadultspecial->viewAttributes() ?>>
<?= $Page->priceadultspecial->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->pricechildspecial->Visible) { // pricechildspecial ?>
        <td data-name="pricechildspecial"<?= $Page->pricechildspecial->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resrate_pricechildspecial" class="el_resrate_pricechildspecial">
<span<?= $Page->pricechildspecial->viewAttributes() ?>>
<?= $Page->pricechildspecial->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowCount);
?>
    </tr>
<?php
    }
    if (!$Page->isGridAdd()) {
        $Page->Recordset->moveNext();
    }
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$Page->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php
// Close recordset
if ($Page->Recordset) {
    $Page->Recordset->close();
}
?>
<?php if (!$Page->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$Page->isGridAdd()) { ?>
<form name="ew-pager-form" class="ew-form ew-pager-form" action="<?= CurrentPageUrl(false) ?>">
<?= $Page->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body", "bottom") ?>
</div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } else { ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body") ?>
</div>
<?php } ?>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("resrate");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
