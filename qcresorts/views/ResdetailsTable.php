<?php
namespace PHPMaker2022\project1;
?>
<div class="ew-multi-column-grid">
<?php $Page->LayoutOptions->render("body") ?>
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> resdetails">
<form name="fresdetailslist" id="fresdetailslist" class="ew-form ew-list-form ew-multi-column-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="resdetails">
<div id="gmp_resdetails" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_resdetailslist" class="table table-hover table-sm ew-table"><!-- .ew-table -->
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
<?php if ($Page->res_id->Visible) { // res_id ?>
        <th data-name="res_id" class="<?= $Page->res_id->headerCellClass() ?>"><div id="elh_resdetails_res_id" class="resdetails_res_id"><?= $Page->renderFieldHeader($Page->res_id) ?></div></th>
<?php } ?>
<?php if ($Page->date->Visible) { // date ?>
        <th data-name="date" class="<?= $Page->date->headerCellClass() ?>"><div id="elh_resdetails_date" class="resdetails_date"><?= $Page->renderFieldHeader($Page->date) ?></div></th>
<?php } ?>
<?php if ($Page->fname->Visible) { // fname ?>
        <th data-name="fname" class="<?= $Page->fname->headerCellClass() ?>"><div id="elh_resdetails_fname" class="resdetails_fname"><?= $Page->renderFieldHeader($Page->fname) ?></div></th>
<?php } ?>
<?php if ($Page->lname->Visible) { // lname ?>
        <th data-name="lname" class="<?= $Page->lname->headerCellClass() ?>"><div id="elh_resdetails_lname" class="resdetails_lname"><?= $Page->renderFieldHeader($Page->lname) ?></div></th>
<?php } ?>
<?php if ($Page->address->Visible) { // address ?>
        <th data-name="address" class="<?= $Page->address->headerCellClass() ?>"><div id="elh_resdetails_address" class="resdetails_address"><?= $Page->renderFieldHeader($Page->address) ?></div></th>
<?php } ?>
<?php if ($Page->contactno->Visible) { // contactno ?>
        <th data-name="contactno" class="<?= $Page->contactno->headerCellClass() ?>"><div id="elh_resdetails_contactno" class="resdetails_contactno"><?= $Page->renderFieldHeader($Page->contactno) ?></div></th>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
        <th data-name="_email" class="<?= $Page->_email->headerCellClass() ?>"><div id="elh_resdetails__email" class="resdetails__email"><?= $Page->renderFieldHeader($Page->_email) ?></div></th>
<?php } ?>
<?php if ($Page->pool_id->Visible) { // pool_id ?>
        <th data-name="pool_id" class="<?= $Page->pool_id->headerCellClass() ?>"><div id="elh_resdetails_pool_id" class="resdetails_pool_id"><?= $Page->renderFieldHeader($Page->pool_id) ?></div></th>
<?php } ?>
<?php if ($Page->rate_id->Visible) { // rate_id ?>
        <th data-name="rate_id" class="<?= $Page->rate_id->headerCellClass() ?>"><div id="elh_resdetails_rate_id" class="resdetails_rate_id"><?= $Page->renderFieldHeader($Page->rate_id) ?></div></th>
<?php } ?>
<?php if ($Page->dateuploaded->Visible) { // dateuploaded ?>
        <th data-name="dateuploaded" class="<?= $Page->dateuploaded->headerCellClass() ?>"><div id="elh_resdetails_dateuploaded" class="resdetails_dateuploaded"><?= $Page->renderFieldHeader($Page->dateuploaded) ?></div></th>
<?php } ?>
<?php if ($Page->uname->Visible) { // uname ?>
        <th data-name="uname" class="<?= $Page->uname->headerCellClass() ?>"><div id="elh_resdetails_uname" class="resdetails_uname"><?= $Page->renderFieldHeader($Page->uname) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_resdetails",
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
    <?php if ($Page->res_id->Visible) { // res_id ?>
        <td data-name="res_id"<?= $Page->res_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resdetails_res_id" class="el_resdetails_res_id">
<span<?= $Page->res_id->viewAttributes() ?>>
<?= $Page->res_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->date->Visible) { // date ?>
        <td data-name="date"<?= $Page->date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resdetails_date" class="el_resdetails_date">
<span<?= $Page->date->viewAttributes() ?>>
<?= $Page->date->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->fname->Visible) { // fname ?>
        <td data-name="fname"<?= $Page->fname->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resdetails_fname" class="el_resdetails_fname">
<span<?= $Page->fname->viewAttributes() ?>>
<?= $Page->fname->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->lname->Visible) { // lname ?>
        <td data-name="lname"<?= $Page->lname->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resdetails_lname" class="el_resdetails_lname">
<span<?= $Page->lname->viewAttributes() ?>>
<?= $Page->lname->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->address->Visible) { // address ?>
        <td data-name="address"<?= $Page->address->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resdetails_address" class="el_resdetails_address">
<span<?= $Page->address->viewAttributes() ?>>
<?= $Page->address->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->contactno->Visible) { // contactno ?>
        <td data-name="contactno"<?= $Page->contactno->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resdetails_contactno" class="el_resdetails_contactno">
<span<?= $Page->contactno->viewAttributes() ?>>
<?= $Page->contactno->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->_email->Visible) { // email ?>
        <td data-name="_email"<?= $Page->_email->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resdetails__email" class="el_resdetails__email">
<span<?= $Page->_email->viewAttributes() ?>>
<?= $Page->_email->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->pool_id->Visible) { // pool_id ?>
        <td data-name="pool_id"<?= $Page->pool_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resdetails_pool_id" class="el_resdetails_pool_id">
<span<?= $Page->pool_id->viewAttributes() ?>>
<?= $Page->pool_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->rate_id->Visible) { // rate_id ?>
        <td data-name="rate_id"<?= $Page->rate_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resdetails_rate_id" class="el_resdetails_rate_id">
<span<?= $Page->rate_id->viewAttributes() ?>>
<?= $Page->rate_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->dateuploaded->Visible) { // dateuploaded ?>
        <td data-name="dateuploaded"<?= $Page->dateuploaded->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resdetails_dateuploaded" class="el_resdetails_dateuploaded">
<span<?= $Page->dateuploaded->viewAttributes() ?>>
<?= $Page->dateuploaded->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->uname->Visible) { // uname ?>
        <td data-name="uname"<?= $Page->uname->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resdetails_uname" class="el_resdetails_uname">
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
</div><!-- /.ew-multi-column-grid -->
