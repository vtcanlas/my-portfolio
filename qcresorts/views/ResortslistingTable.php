<?php
namespace PHPMaker2022\project1;
?>
<div class="ew-multi-column-grid">
<?php $Page->LayoutOptions->render("body") ?>
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> resortslisting">
<form name="fresortslistinglist" id="fresortslistinglist" class="ew-form ew-list-form ew-multi-column-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="resortslisting">
<div id="gmp_resortslisting" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_resortslistinglist" class="table table-hover table-sm ew-table"><!-- .ew-table -->
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
<?php if ($Page->pool_name->Visible) { // pool_name ?>
        <th data-name="pool_name" class="<?= $Page->pool_name->headerCellClass() ?>"><div id="elh_resortslisting_pool_name" class="resortslisting_pool_name"><?= $Page->renderFieldHeader($Page->pool_name) ?></div></th>
<?php } ?>
<?php if ($Page->img->Visible) { // img ?>
        <th data-name="img" class="<?= $Page->img->headerCellClass() ?>"><div id="elh_resortslisting_img" class="resortslisting_img"><?= $Page->renderFieldHeader($Page->img) ?></div></th>
<?php } ?>
<?php if ($Page->active->Visible) { // active ?>
        <th data-name="active" class="<?= $Page->active->headerCellClass() ?>"><div id="elh_resortslisting_active" class="resortslisting_active"><?= $Page->renderFieldHeader($Page->active) ?></div></th>
<?php } ?>
<?php if ($Page->barangay->Visible) { // barangay ?>
        <th data-name="barangay" class="<?= $Page->barangay->headerCellClass() ?>"><div id="elh_resortslisting_barangay" class="resortslisting_barangay"><?= $Page->renderFieldHeader($Page->barangay) ?></div></th>
<?php } ?>
<?php if ($Page->uname->Visible) { // uname ?>
        <th data-name="uname" class="<?= $Page->uname->headerCellClass() ?>"><div id="elh_resortslisting_uname" class="resortslisting_uname"><?= $Page->renderFieldHeader($Page->uname) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_resortslisting",
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
    <?php if ($Page->pool_name->Visible) { // pool_name ?>
        <td data-name="pool_name"<?= $Page->pool_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resortslisting_pool_name" class="el_resortslisting_pool_name">
<span<?= $Page->pool_name->viewAttributes() ?>>
<?= $Page->pool_name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->img->Visible) { // img ?>
        <td data-name="img"<?= $Page->img->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resortslisting_img" class="el_resortslisting_img">
<span>
<?= GetFileViewTag($Page->img, $Page->img->getViewValue(), false) ?>
</span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->active->Visible) { // active ?>
        <td data-name="active"<?= $Page->active->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resortslisting_active" class="el_resortslisting_active">
<span<?= $Page->active->viewAttributes() ?>>
<?= $Page->active->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->barangay->Visible) { // barangay ?>
        <td data-name="barangay"<?= $Page->barangay->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resortslisting_barangay" class="el_resortslisting_barangay">
<span<?= $Page->barangay->viewAttributes() ?>>
<?= $Page->barangay->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->uname->Visible) { // uname ?>
        <td data-name="uname"<?= $Page->uname->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resortslisting_uname" class="el_resortslisting_uname">
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
