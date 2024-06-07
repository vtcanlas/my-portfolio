<?php

namespace PHPMaker2023\project1;

// Page object
$PoolratesList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { poolrates: currentTable } });
var currentPageID = ew.PAGE_ID = "list";
var currentForm;
var <?= $Page->FormName ?>;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("<?= $Page->FormName ?>")
        .setPageId("list")
        .setSubmitWithFetch(<?= $Page->UseAjaxActions ? "true" : "false" ?>)
        .setFormKeyCountName("<?= $Page->FormKeyCountName ?>")
        .build();
    window[form.id] = form;
    currentForm = form;
    loadjs.done(form.id);
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
<?php if (!$Page->isExport() || Config("EXPORT_MASTER_RECORD") && $Page->isExport("print")) { ?>
<?php
if ($Page->DbMasterFilter != "" && $Page->getCurrentMasterTable() == "tbl_resort_details") {
    if ($Page->MasterRecordExists) {
        include_once "views/TblResortDetailsMaster.php";
    }
}
?>
<?php
if ($Page->DbMasterFilter != "" && $Page->getCurrentMasterTable() == "pool") {
    if ($Page->MasterRecordExists) {
        include_once "views/PoolMaster.php";
    }
}
?>
<?php } ?>
<?php if (!$Page->IsModal) { ?>
<form name="fpoolratessrch" id="fpoolratessrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>" novalidate autocomplete="on">
<div id="fpoolratessrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { poolrates: currentTable } });
var currentForm;
var fpoolratessrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery,
        fields = currentTable.fields;

    // Form object for search
    let form = new ew.FormBuilder()
        .setId("fpoolratessrch")
        .setPageId("list")
<?php if ($Page->UseAjaxActions) { ?>
        .setSubmitWithFetch(true)
<?php } ?>

        // Dynamic selection lists
        .setLists({
        })

        // Filters
        .setFilterList(<?= $Page->getFilterList() ?>)
        .build();
    window[form.id] = form;
    currentSearchForm = form;
    loadjs.done(form.id);
});
</script>
<input type="hidden" name="cmd" value="search">
<?php if ($Security->canSearch()) { ?>
<?php if (!$Page->isExport() && !($Page->CurrentAction && $Page->CurrentAction != "search") && $Page->hasSearchFields()) { ?>
<div class="ew-extended-search container-fluid ps-2">
<div class="row mb-0">
    <div class="col-sm-auto px-0 pe-sm-2">
        <div class="ew-basic-search input-group">
            <input type="search" name="<?= Config("TABLE_BASIC_SEARCH") ?>" id="<?= Config("TABLE_BASIC_SEARCH") ?>" class="form-control ew-basic-search-keyword" value="<?= HtmlEncode($Page->BasicSearch->getKeyword()) ?>" placeholder="<?= HtmlEncode($Language->phrase("Search")) ?>" aria-label="<?= HtmlEncode($Language->phrase("Search")) ?>">
            <input type="hidden" name="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" class="ew-basic-search-type" value="<?= HtmlEncode($Page->BasicSearch->getType()) ?>">
            <button type="button" data-bs-toggle="dropdown" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false">
                <span id="searchtype"><?= $Page->BasicSearch->getTypeNameShort() ?></span>
            </button>
            <div class="dropdown-menu dropdown-menu-end">
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fpoolratessrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fpoolratessrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fpoolratessrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fpoolratessrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
            </div>
        </div>
    </div>
    <div class="col-sm-auto mb-3">
        <button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?= $Language->phrase("SearchBtn") ?></button>
    </div>
</div>
</div><!-- /.ew-extended-search -->
<?php } ?>
<?php } ?>
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="list<?= ($Page->TotalRecords == 0 && !$Page->isAdd()) ? " ew-no-record" : "" ?>">
<div id="ew-list">
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?= $Page->isAddOrEdit() ? " ew-grid-add-edit" : "" ?> <?= $Page->TableGridClass ?>">
<form name="<?= $Page->FormName ?>" id="<?= $Page->FormName ?>" class="ew-form ew-list-form" action="<?= $Page->PageAction ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="poolrates">
<?php if ($Page->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<?php if ($Page->getCurrentMasterTable() == "tbl_resort_details" && $Page->CurrentAction) { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="tbl_resort_details">
<input type="hidden" name="fk_pool_id" value="<?= HtmlEncode($Page->pool_id->getSessionValue()) ?>">
<?php } ?>
<?php if ($Page->getCurrentMasterTable() == "pool" && $Page->CurrentAction) { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="pool">
<input type="hidden" name="fk_pool_id" value="<?= HtmlEncode($Page->pool_id->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_poolrates" class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>" style="<?= $Page->TableContainerStyle ?>">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit() || $Page->isMultiEdit()) { ?>
<table id="tbl_poolrateslist" class="<?= $Page->TableClass ?>"><!-- .ew-table -->
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
        <th data-name="rateid" class="<?= $Page->rateid->headerCellClass() ?>"><div id="elh_poolrates_rateid" class="poolrates_rateid"><?= $Page->renderFieldHeader($Page->rateid) ?></div></th>
<?php } ?>
<?php if ($Page->ratename->Visible) { // ratename ?>
        <th data-name="ratename" class="<?= $Page->ratename->headerCellClass() ?>"><div id="elh_poolrates_ratename" class="poolrates_ratename"><?= $Page->renderFieldHeader($Page->ratename) ?></div></th>
<?php } ?>
<?php if ($Page->rateprice->Visible) { // rateprice ?>
        <th data-name="rateprice" class="<?= $Page->rateprice->headerCellClass() ?>"><div id="elh_poolrates_rateprice" class="poolrates_rateprice"><?= $Page->renderFieldHeader($Page->rateprice) ?></div></th>
<?php } ?>
<?php if ($Page->ratearrivaltime->Visible) { // ratearrivaltime ?>
        <th data-name="ratearrivaltime" class="<?= $Page->ratearrivaltime->headerCellClass() ?>"><div id="elh_poolrates_ratearrivaltime" class="poolrates_ratearrivaltime"><?= $Page->renderFieldHeader($Page->ratearrivaltime) ?></div></th>
<?php } ?>
<?php if ($Page->ratedeparturetime->Visible) { // ratedeparturetime ?>
        <th data-name="ratedeparturetime" class="<?= $Page->ratedeparturetime->headerCellClass() ?>"><div id="elh_poolrates_ratedeparturetime" class="poolrates_ratedeparturetime"><?= $Page->renderFieldHeader($Page->ratedeparturetime) ?></div></th>
<?php } ?>
<?php if ($Page->pool_id->Visible) { // pool_id ?>
        <th data-name="pool_id" class="<?= $Page->pool_id->headerCellClass() ?>"><div id="elh_poolrates_pool_id" class="poolrates_pool_id"><?= $Page->renderFieldHeader($Page->pool_id) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Page->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody data-page="<?= $Page->getPageNumber() ?>">
<?php
$Page->setupGrid();
while ($Page->RecordCount < $Page->StopRecord) {
    $Page->RecordCount++;
    if ($Page->RecordCount >= $Page->StartRecord) {
        $Page->setupRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Page->ListOptions->render("body", "left", $Page->RowCount);
?>
    <?php if ($Page->rateid->Visible) { // rateid ?>
        <td data-name="rateid"<?= $Page->rateid->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_poolrates_rateid" class="el_poolrates_rateid">
<span<?= $Page->rateid->viewAttributes() ?>>
<?= $Page->rateid->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ratename->Visible) { // ratename ?>
        <td data-name="ratename"<?= $Page->ratename->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_poolrates_ratename" class="el_poolrates_ratename">
<span<?= $Page->ratename->viewAttributes() ?>>
<?= $Page->ratename->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->rateprice->Visible) { // rateprice ?>
        <td data-name="rateprice"<?= $Page->rateprice->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_poolrates_rateprice" class="el_poolrates_rateprice">
<span<?= $Page->rateprice->viewAttributes() ?>>
<?= $Page->rateprice->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ratearrivaltime->Visible) { // ratearrivaltime ?>
        <td data-name="ratearrivaltime"<?= $Page->ratearrivaltime->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_poolrates_ratearrivaltime" class="el_poolrates_ratearrivaltime">
<span<?= $Page->ratearrivaltime->viewAttributes() ?>>
<?= $Page->ratearrivaltime->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ratedeparturetime->Visible) { // ratedeparturetime ?>
        <td data-name="ratedeparturetime"<?= $Page->ratedeparturetime->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_poolrates_ratedeparturetime" class="el_poolrates_ratedeparturetime">
<span<?= $Page->ratedeparturetime->viewAttributes() ?>>
<?= $Page->ratedeparturetime->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->pool_id->Visible) { // pool_id ?>
        <td data-name="pool_id"<?= $Page->pool_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_poolrates_pool_id" class="el_poolrates_pool_id">
<span<?= $Page->pool_id->viewAttributes() ?>>
<?= $Page->pool_id->getViewValue() ?></span>
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
    if (
        $Page->Recordset &&
        !$Page->Recordset->EOF &&
        $Page->RowIndex !== '$rowindex$' &&
        (!$Page->isGridAdd() || $Page->CurrentMode == "copy") &&
        (!(($Page->isCopy() || $Page->isAdd()) && $Page->RowIndex == 0))
    ) {
        $Page->Recordset->moveNext();
    }
    // Reset for template row
    if ($Page->RowIndex === '$rowindex$') {
        $Page->RowIndex = 0;
    }
    // Reset inline add/copy row
    if (($Page->isCopy() || $Page->isAdd()) && $Page->RowIndex == 0) {
        $Page->RowIndex = 1;
    }
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$Page->CurrentAction && !$Page->UseAjaxActions) { ?>
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
<?php if (!$Page->isGridAdd() && !($Page->isGridEdit() && $Page->ModalGridEdit) && !$Page->isMultiEdit()) { ?>
<?= $Page->Pager->render() ?>
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
</div>
</main>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("poolrates");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
