<?php

namespace PHPMaker2022\project1;

// Page object
$Pool2List = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { pool2: currentTable } });
var currentForm, currentPageID;
var fpool2list;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fpool2list = new ew.Form("fpool2list", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fpool2list;
    fpool2list.formKeyCountName = "<?= $Page->FormKeyCountName ?>";
    loadjs.done("fpool2list");
});
var fpool2srch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fpool2srch = new ew.Form("fpool2srch", "list");
    currentSearchForm = fpool2srch;

    // Dynamic selection lists

    // Filters
    fpool2srch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fpool2srch");
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
<form name="fpool2srch" id="fpool2srch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fpool2srch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="pool2">
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fpool2srch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fpool2srch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fpool2srch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fpool2srch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> pool2">
<form name="fpool2list" id="fpool2list" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="pool2">
<div id="gmp_pool2" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_pool2list" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
<?php if ($Page->pool_id->Visible) { // pool_id ?>
        <th data-name="pool_id" class="<?= $Page->pool_id->headerCellClass() ?>"><div id="elh_pool2_pool_id" class="pool2_pool_id"><?= $Page->renderFieldHeader($Page->pool_id) ?></div></th>
<?php } ?>
<?php if ($Page->pool_name->Visible) { // pool_name ?>
        <th data-name="pool_name" class="<?= $Page->pool_name->headerCellClass() ?>"><div id="elh_pool2_pool_name" class="pool2_pool_name"><?= $Page->renderFieldHeader($Page->pool_name) ?></div></th>
<?php } ?>
<?php if ($Page->pool_description->Visible) { // pool_description ?>
        <th data-name="pool_description" class="<?= $Page->pool_description->headerCellClass() ?>"><div id="elh_pool2_pool_description" class="pool2_pool_description"><?= $Page->renderFieldHeader($Page->pool_description) ?></div></th>
<?php } ?>
<?php if ($Page->barangay->Visible) { // barangay ?>
        <th data-name="barangay" class="<?= $Page->barangay->headerCellClass() ?>"><div id="elh_pool2_barangay" class="pool2_barangay"><?= $Page->renderFieldHeader($Page->barangay) ?></div></th>
<?php } ?>
<?php if ($Page->poolcat->Visible) { // poolcat ?>
        <th data-name="poolcat" class="<?= $Page->poolcat->headerCellClass() ?>"><div id="elh_pool2_poolcat" class="pool2_poolcat"><?= $Page->renderFieldHeader($Page->poolcat) ?></div></th>
<?php } ?>
<?php if ($Page->address->Visible) { // address ?>
        <th data-name="address" class="<?= $Page->address->headerCellClass() ?>"><div id="elh_pool2_address" class="pool2_address"><?= $Page->renderFieldHeader($Page->address) ?></div></th>
<?php } ?>
<?php if ($Page->contactno1->Visible) { // contactno1 ?>
        <th data-name="contactno1" class="<?= $Page->contactno1->headerCellClass() ?>"><div id="elh_pool2_contactno1" class="pool2_contactno1"><?= $Page->renderFieldHeader($Page->contactno1) ?></div></th>
<?php } ?>
<?php if ($Page->emailaddress->Visible) { // emailaddress ?>
        <th data-name="emailaddress" class="<?= $Page->emailaddress->headerCellClass() ?>"><div id="elh_pool2_emailaddress" class="pool2_emailaddress"><?= $Page->renderFieldHeader($Page->emailaddress) ?></div></th>
<?php } ?>
<?php if ($Page->socmed->Visible) { // socmed ?>
        <th data-name="socmed" class="<?= $Page->socmed->headerCellClass() ?>"><div id="elh_pool2_socmed" class="pool2_socmed"><?= $Page->renderFieldHeader($Page->socmed) ?></div></th>
<?php } ?>
<?php if ($Page->uname->Visible) { // uname ?>
        <th data-name="uname" class="<?= $Page->uname->headerCellClass() ?>"><div id="elh_pool2_uname" class="pool2_uname"><?= $Page->renderFieldHeader($Page->uname) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_pool2",
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
    <?php if ($Page->pool_id->Visible) { // pool_id ?>
        <td data-name="pool_id"<?= $Page->pool_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pool2_pool_id" class="el_pool2_pool_id">
<span<?= $Page->pool_id->viewAttributes() ?>>
<?= $Page->pool_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->pool_name->Visible) { // pool_name ?>
        <td data-name="pool_name"<?= $Page->pool_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pool2_pool_name" class="el_pool2_pool_name">
<span<?= $Page->pool_name->viewAttributes() ?>>
<?= $Page->pool_name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->pool_description->Visible) { // pool_description ?>
        <td data-name="pool_description"<?= $Page->pool_description->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pool2_pool_description" class="el_pool2_pool_description">
<span<?= $Page->pool_description->viewAttributes() ?>>
<?= $Page->pool_description->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->barangay->Visible) { // barangay ?>
        <td data-name="barangay"<?= $Page->barangay->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pool2_barangay" class="el_pool2_barangay">
<span<?= $Page->barangay->viewAttributes() ?>>
<?= $Page->barangay->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->poolcat->Visible) { // poolcat ?>
        <td data-name="poolcat"<?= $Page->poolcat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pool2_poolcat" class="el_pool2_poolcat">
<span<?= $Page->poolcat->viewAttributes() ?>>
<?= $Page->poolcat->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->address->Visible) { // address ?>
        <td data-name="address"<?= $Page->address->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pool2_address" class="el_pool2_address">
<span<?= $Page->address->viewAttributes() ?>>
<?= $Page->address->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->contactno1->Visible) { // contactno1 ?>
        <td data-name="contactno1"<?= $Page->contactno1->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pool2_contactno1" class="el_pool2_contactno1">
<span<?= $Page->contactno1->viewAttributes() ?>>
<?= $Page->contactno1->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->emailaddress->Visible) { // emailaddress ?>
        <td data-name="emailaddress"<?= $Page->emailaddress->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pool2_emailaddress" class="el_pool2_emailaddress">
<span<?= $Page->emailaddress->viewAttributes() ?>>
<?= $Page->emailaddress->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->socmed->Visible) { // socmed ?>
        <td data-name="socmed"<?= $Page->socmed->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pool2_socmed" class="el_pool2_socmed">
<span<?= $Page->socmed->viewAttributes() ?>>
<?= $Page->socmed->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->uname->Visible) { // uname ?>
        <td data-name="uname"<?= $Page->uname->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pool2_uname" class="el_pool2_uname">
<span<?= $Page->uname->viewAttributes() ?>>
<?= $Page->uname->getViewValue() ?></span>
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
    ew.addEventHandlers("pool2");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
