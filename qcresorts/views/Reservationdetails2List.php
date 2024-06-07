<?php

namespace PHPMaker2022\project1;

// Page object
$Reservationdetails2List = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { reservationdetails2: currentTable } });
var currentForm, currentPageID;
var freservationdetails2list;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    freservationdetails2list = new ew.Form("freservationdetails2list", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = freservationdetails2list;
    freservationdetails2list.formKeyCountName = "<?= $Page->FormKeyCountName ?>";
    loadjs.done("freservationdetails2list");
});
var freservationdetails2srch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    freservationdetails2srch = new ew.Form("freservationdetails2srch", "list");
    currentSearchForm = freservationdetails2srch;

    // Dynamic selection lists

    // Filters
    freservationdetails2srch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("freservationdetails2srch");
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
<?php if ($Page->SearchOptions->visible()) { ?>
<?php $Page->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($Page->FilterOptions->visible()) { ?>
<?php $Page->FilterOptions->render("body") ?>
<?php } ?>
</div>
<?php } ?>
<?php
$Page->renderOtherOptions();
?>
<?php if ($Security->canSearch()) { ?>
<?php if (!$Page->isExport() && !$Page->CurrentAction && $Page->hasSearchFields()) { ?>
<form name="freservationdetails2srch" id="freservationdetails2srch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="freservationdetails2srch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="reservationdetails2">
<div class="ew-extended-search container-fluid">
<div class="row mb-0">
    <div class="col-sm-auto px-0 pe-sm-2">
        <div class="ew-basic-search input-group">
            <input type="search" name="<?= Config("TABLE_BASIC_SEARCH") ?>" id="<?= Config("TABLE_BASIC_SEARCH") ?>" class="form-control ew-basic-search-keyword" value="<?= HtmlEncode($Page->BasicSearch->getKeyword()) ?>" placeholder="<?= HtmlEncode($Language->phrase("Search")) ?>" aria-label="<?= HtmlEncode($Language->phrase("Search")) ?>">
            <input type="hidden" name="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" class="ew-basic-search-type" value="<?= HtmlEncode($Page->BasicSearch->getType()) ?>">
            <button type="button" data-bs-toggle="dropdown" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false">
                <span id="searchtype"><?= $Page->BasicSearch->getTypeNameShort() ?></span>
            </button>
            <div class="dropdown-menu dropdown-menu-end">
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="freservationdetails2srch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="freservationdetails2srch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="freservationdetails2srch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="freservationdetails2srch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
            </div>
        </div>
    </div>
    <div class="col-sm-auto mb-3">
        <button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?= $Language->phrase("SearchBtn") ?></button>
    </div>
</div>
</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> reservationdetails2">
<form name="freservationdetails2list" id="freservationdetails2list" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="reservationdetails2">
<div id="gmp_reservationdetails2" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_reservationdetails2list" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
<?php if ($Page->rateid->Visible) { // rateid ?>
        <th data-name="rateid" class="<?= $Page->rateid->headerCellClass() ?>"><div id="elh_reservationdetails2_rateid" class="reservationdetails2_rateid"><?= $Page->renderFieldHeader($Page->rateid) ?></div></th>
<?php } ?>
<?php if ($Page->pool_name->Visible) { // pool_name ?>
        <th data-name="pool_name" class="<?= $Page->pool_name->headerCellClass() ?>"><div id="elh_reservationdetails2_pool_name" class="reservationdetails2_pool_name"><?= $Page->renderFieldHeader($Page->pool_name) ?></div></th>
<?php } ?>
<?php if ($Page->ratename->Visible) { // ratename ?>
        <th data-name="ratename" class="<?= $Page->ratename->headerCellClass() ?>"><div id="elh_reservationdetails2_ratename" class="reservationdetails2_ratename"><?= $Page->renderFieldHeader($Page->ratename) ?></div></th>
<?php } ?>
<?php if ($Page->rateprice->Visible) { // rateprice ?>
        <th data-name="rateprice" class="<?= $Page->rateprice->headerCellClass() ?>"><div id="elh_reservationdetails2_rateprice" class="reservationdetails2_rateprice"><?= $Page->renderFieldHeader($Page->rateprice) ?></div></th>
<?php } ?>
<?php if ($Page->ratearrivaltime->Visible) { // ratearrivaltime ?>
        <th data-name="ratearrivaltime" class="<?= $Page->ratearrivaltime->headerCellClass() ?>"><div id="elh_reservationdetails2_ratearrivaltime" class="reservationdetails2_ratearrivaltime"><?= $Page->renderFieldHeader($Page->ratearrivaltime) ?></div></th>
<?php } ?>
<?php if ($Page->ratedeparturetime->Visible) { // ratedeparturetime ?>
        <th data-name="ratedeparturetime" class="<?= $Page->ratedeparturetime->headerCellClass() ?>"><div id="elh_reservationdetails2_ratedeparturetime" class="reservationdetails2_ratedeparturetime"><?= $Page->renderFieldHeader($Page->ratedeparturetime) ?></div></th>
<?php } ?>
<?php if ($Page->user_id->Visible) { // user_id ?>
        <th data-name="user_id" class="<?= $Page->user_id->headerCellClass() ?>"><div id="elh_reservationdetails2_user_id" class="reservationdetails2_user_id"><?= $Page->renderFieldHeader($Page->user_id) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_reservationdetails2",
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
    <?php if ($Page->rateid->Visible) { // rateid ?>
        <td data-name="rateid"<?= $Page->rateid->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_reservationdetails2_rateid" class="el_reservationdetails2_rateid">
<span<?= $Page->rateid->viewAttributes() ?>>
<?= $Page->rateid->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->pool_name->Visible) { // pool_name ?>
        <td data-name="pool_name"<?= $Page->pool_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_reservationdetails2_pool_name" class="el_reservationdetails2_pool_name">
<span<?= $Page->pool_name->viewAttributes() ?>>
<?= $Page->pool_name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ratename->Visible) { // ratename ?>
        <td data-name="ratename"<?= $Page->ratename->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_reservationdetails2_ratename" class="el_reservationdetails2_ratename">
<span<?= $Page->ratename->viewAttributes() ?>>
<?= $Page->ratename->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->rateprice->Visible) { // rateprice ?>
        <td data-name="rateprice"<?= $Page->rateprice->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_reservationdetails2_rateprice" class="el_reservationdetails2_rateprice">
<span<?= $Page->rateprice->viewAttributes() ?>>
<?= $Page->rateprice->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ratearrivaltime->Visible) { // ratearrivaltime ?>
        <td data-name="ratearrivaltime"<?= $Page->ratearrivaltime->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_reservationdetails2_ratearrivaltime" class="el_reservationdetails2_ratearrivaltime">
<span<?= $Page->ratearrivaltime->viewAttributes() ?>>
<?= $Page->ratearrivaltime->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ratedeparturetime->Visible) { // ratedeparturetime ?>
        <td data-name="ratedeparturetime"<?= $Page->ratedeparturetime->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_reservationdetails2_ratedeparturetime" class="el_reservationdetails2_ratedeparturetime">
<span<?= $Page->ratedeparturetime->viewAttributes() ?>>
<?= $Page->ratedeparturetime->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->user_id->Visible) { // user_id ?>
        <td data-name="user_id"<?= $Page->user_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_reservationdetails2_user_id" class="el_reservationdetails2_user_id">
<span<?= $Page->user_id->viewAttributes() ?>>
<?= $Page->user_id->getViewValue() ?></span>
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
    ew.addEventHandlers("reservationdetails2");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
