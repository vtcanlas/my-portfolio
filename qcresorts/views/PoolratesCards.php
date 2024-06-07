<?php
namespace PHPMaker2022\project1;
?>
<div class="ew-multi-column-grid">
<?php $Page->LayoutOptions->render("body") ?>
<form name="fpoolrateslist" id="fpoolrateslist" class="ew-form ew-list-form ew-multi-column-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="poolrates">
<?php if ($Page->getCurrentMasterTable() == "tbl_resort_details" && $Page->CurrentAction) { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="tbl_resort_details">
<input type="hidden" name="fk_pool_id" value="<?= HtmlEncode($Page->pool_id->getSessionValue()) ?>">
<?php } ?>
<?php if ($Page->getCurrentMasterTable() == "pool" && $Page->CurrentAction) { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="pool">
<input type="hidden" name="fk_pool_id" value="<?= HtmlEncode($Page->pool_id->getSessionValue()) ?>">
<?php } ?>
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
            "id" => "r" . $Page->RowCount . "_poolrates",
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
    <?php if ($Page->rateid->Visible) { // rateid ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row poolrates_rateid">
            <div class="col col-sm-4 poolrates_rateid"><?= $Page->renderFieldHeader($Page->rateid) ?></div>
            <div class="col col-sm-8"><div<?= $Page->rateid->cellAttributes() ?>>
<span<?= $Page->rateid->viewAttributes() ?>>
<?= $Page->rateid->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row poolrates_rateid">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->rateid->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->rateid->cellAttributes() ?>>
<span<?= $Page->rateid->viewAttributes() ?>>
<?= $Page->rateid->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->ratename->Visible) { // ratename ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row poolrates_ratename">
            <div class="col col-sm-4 poolrates_ratename"><?= $Page->renderFieldHeader($Page->ratename) ?></div>
            <div class="col col-sm-8"><div<?= $Page->ratename->cellAttributes() ?>>
<span<?= $Page->ratename->viewAttributes() ?>>
<?= $Page->ratename->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row poolrates_ratename">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->ratename->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->ratename->cellAttributes() ?>>
<span<?= $Page->ratename->viewAttributes() ?>>
<?= $Page->ratename->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->rateprice->Visible) { // rateprice ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row poolrates_rateprice">
            <div class="col col-sm-4 poolrates_rateprice"><?= $Page->renderFieldHeader($Page->rateprice) ?></div>
            <div class="col col-sm-8"><div<?= $Page->rateprice->cellAttributes() ?>>
<span<?= $Page->rateprice->viewAttributes() ?>>
<?= $Page->rateprice->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row poolrates_rateprice">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->rateprice->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->rateprice->cellAttributes() ?>>
<span<?= $Page->rateprice->viewAttributes() ?>>
<?= $Page->rateprice->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->ratearrivaltime->Visible) { // ratearrivaltime ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row poolrates_ratearrivaltime">
            <div class="col col-sm-4 poolrates_ratearrivaltime"><?= $Page->renderFieldHeader($Page->ratearrivaltime) ?></div>
            <div class="col col-sm-8"><div<?= $Page->ratearrivaltime->cellAttributes() ?>>
<span<?= $Page->ratearrivaltime->viewAttributes() ?>>
<?= $Page->ratearrivaltime->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row poolrates_ratearrivaltime">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->ratearrivaltime->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->ratearrivaltime->cellAttributes() ?>>
<span<?= $Page->ratearrivaltime->viewAttributes() ?>>
<?= $Page->ratearrivaltime->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->ratedeparturetime->Visible) { // ratedeparturetime ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row poolrates_ratedeparturetime">
            <div class="col col-sm-4 poolrates_ratedeparturetime"><?= $Page->renderFieldHeader($Page->ratedeparturetime) ?></div>
            <div class="col col-sm-8"><div<?= $Page->ratedeparturetime->cellAttributes() ?>>
<span<?= $Page->ratedeparturetime->viewAttributes() ?>>
<?= $Page->ratedeparturetime->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row poolrates_ratedeparturetime">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->ratedeparturetime->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->ratedeparturetime->cellAttributes() ?>>
<span<?= $Page->ratedeparturetime->viewAttributes() ?>>
<?= $Page->ratedeparturetime->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->pool_id->Visible) { // pool_id ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row poolrates_pool_id">
            <div class="col col-sm-4 poolrates_pool_id"><?= $Page->renderFieldHeader($Page->pool_id) ?></div>
            <div class="col col-sm-8"><div<?= $Page->pool_id->cellAttributes() ?>>
<span<?= $Page->pool_id->viewAttributes() ?>>
<?= $Page->pool_id->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row poolrates_pool_id">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->pool_id->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->pool_id->cellAttributes() ?>>
<span<?= $Page->pool_id->viewAttributes() ?>>
<?= $Page->pool_id->getViewValue() ?></span>
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
