<?php
namespace PHPMaker2022\project1;
?>
<div class="ew-multi-column-grid">
<?php $Page->LayoutOptions->render("body") ?>
<form name="fresortslistinglist" id="fresortslistinglist" class="ew-form ew-list-form ew-multi-column-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="resortslisting">
<div class="<?= $Page->getMultiColumnRowClass() ?>">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
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
<div class="<?= $Page->getMultiColumnColClass() ?>" <?= $Page->rowAttributes() ?>>
<div class="<?= $Page->MultiColumnCardClass ?>">
    <?php if (StartsText("top", $Page->MultiColumnListOptionsPosition)) { ?>
    <div class="card-header">
        <div class="ew-multi-column-list-option ew-<?= $Page->MultiColumnListOptionsPosition ?>">
<?php
// Render list options (body, bottom)
$Page->ListOptions->Tag = "div";
$Page->ListOptions->render("body", $Page->MultiColumnListOptionsPosition, $Page->RowCount);
?>
        </div><!-- /.ew-multi-column-list-option -->
    </div>
    <?php } ?>
    <div class="card-body">
    <?php if ($Page->pool_name->Visible) { // pool_name ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row resortslisting_pool_name">
            <div class="col col-sm-4 resortslisting_pool_name"><?= $Page->renderFieldHeader($Page->pool_name) ?></div>
            <div class="col col-sm-8"><div<?= $Page->pool_name->cellAttributes() ?>>
<span<?= $Page->pool_name->viewAttributes() ?>>
<?= $Page->pool_name->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row resortslisting_pool_name">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->pool_name->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->pool_name->cellAttributes() ?>>
<span<?= $Page->pool_name->viewAttributes() ?>>
<?= $Page->pool_name->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->img->Visible) { // img ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row resortslisting_img">
            <div class="col col-sm-4 resortslisting_img"><?= $Page->renderFieldHeader($Page->img) ?></div>
            <div class="col col-sm-8"><div<?= $Page->img->cellAttributes() ?>>
<span>
<?= GetFileViewTag($Page->img, $Page->img->getViewValue(), false) ?>
</span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row resortslisting_img">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->img->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->img->cellAttributes() ?>>
<span>
<?= GetFileViewTag($Page->img, $Page->img->getViewValue(), false) ?>
</span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->active->Visible) { // active ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row resortslisting_active">
            <div class="col col-sm-4 resortslisting_active"><?= $Page->renderFieldHeader($Page->active) ?></div>
            <div class="col col-sm-8"><div<?= $Page->active->cellAttributes() ?>>
<span<?= $Page->active->viewAttributes() ?>>
<?= $Page->active->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row resortslisting_active">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->active->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->active->cellAttributes() ?>>
<span<?= $Page->active->viewAttributes() ?>>
<?= $Page->active->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->barangay->Visible) { // barangay ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row resortslisting_barangay">
            <div class="col col-sm-4 resortslisting_barangay"><?= $Page->renderFieldHeader($Page->barangay) ?></div>
            <div class="col col-sm-8"><div<?= $Page->barangay->cellAttributes() ?>>
<span<?= $Page->barangay->viewAttributes() ?>>
<?= $Page->barangay->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row resortslisting_barangay">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->barangay->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->barangay->cellAttributes() ?>>
<span<?= $Page->barangay->viewAttributes() ?>>
<?= $Page->barangay->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->uname->Visible) { // uname ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row resortslisting_uname">
            <div class="col col-sm-4 resortslisting_uname"><?= $Page->renderFieldHeader($Page->uname) ?></div>
            <div class="col col-sm-8"><div<?= $Page->uname->cellAttributes() ?>>
<span<?= $Page->uname->viewAttributes() ?>>
<?= $Page->uname->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row resortslisting_uname">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->uname->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->uname->cellAttributes() ?>>
<span<?= $Page->uname->viewAttributes() ?>>
<?= $Page->uname->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    </div><!-- /.card-body -->
<?php if (!$Page->isExport()) { ?>
    <?php if (StartsText("bottom", $Page->MultiColumnListOptionsPosition)) { ?>
    <div class="card-footer">
        <div class="ew-multi-column-list-option ew-<?= $Page->MultiColumnListOptionsPosition ?>">
<?php
// Render list options (body, bottom)
$Page->ListOptions->Tag = "div";
$Page->ListOptions->render("body", $Page->MultiColumnListOptionsPosition, $Page->RowCount);
?>
        </div><!-- /.ew-multi-column-list-option -->
    </div><!-- /.card-footer -->
    <?php } ?>
<?php } ?>
</div><!-- /.card -->
</div><!-- /.col-* -->
<?php
    }
    if (!$Page->isGridAdd()) {
        $Page->Recordset->moveNext();
    }
}
?>
<?php } ?>
</div><!-- /.ew-multi-column-row -->
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
<div>
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
</div><!-- /.ew-multi-column-grid -->