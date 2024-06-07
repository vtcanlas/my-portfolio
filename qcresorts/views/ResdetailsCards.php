<?php
namespace PHPMaker2022\project1;
?>
<div class="ew-multi-column-grid">
<?php $Page->LayoutOptions->render("body") ?>
<form name="fresdetailslist" id="fresdetailslist" class="ew-form ew-list-form ew-multi-column-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="resdetails">
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
    <?php if ($Page->res_id->Visible) { // res_id ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row resdetails_res_id">
            <div class="col col-sm-4 resdetails_res_id"><?= $Page->renderFieldHeader($Page->res_id) ?></div>
            <div class="col col-sm-8"><div<?= $Page->res_id->cellAttributes() ?>>
<span<?= $Page->res_id->viewAttributes() ?>>
<?= $Page->res_id->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row resdetails_res_id">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->res_id->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->res_id->cellAttributes() ?>>
<span<?= $Page->res_id->viewAttributes() ?>>
<?= $Page->res_id->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->date->Visible) { // date ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row resdetails_date">
            <div class="col col-sm-4 resdetails_date"><?= $Page->renderFieldHeader($Page->date) ?></div>
            <div class="col col-sm-8"><div<?= $Page->date->cellAttributes() ?>>
<span<?= $Page->date->viewAttributes() ?>>
<?= $Page->date->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row resdetails_date">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->date->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->date->cellAttributes() ?>>
<span<?= $Page->date->viewAttributes() ?>>
<?= $Page->date->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->fname->Visible) { // fname ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row resdetails_fname">
            <div class="col col-sm-4 resdetails_fname"><?= $Page->renderFieldHeader($Page->fname) ?></div>
            <div class="col col-sm-8"><div<?= $Page->fname->cellAttributes() ?>>
<span<?= $Page->fname->viewAttributes() ?>>
<?= $Page->fname->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row resdetails_fname">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->fname->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->fname->cellAttributes() ?>>
<span<?= $Page->fname->viewAttributes() ?>>
<?= $Page->fname->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->lname->Visible) { // lname ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row resdetails_lname">
            <div class="col col-sm-4 resdetails_lname"><?= $Page->renderFieldHeader($Page->lname) ?></div>
            <div class="col col-sm-8"><div<?= $Page->lname->cellAttributes() ?>>
<span<?= $Page->lname->viewAttributes() ?>>
<?= $Page->lname->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row resdetails_lname">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->lname->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->lname->cellAttributes() ?>>
<span<?= $Page->lname->viewAttributes() ?>>
<?= $Page->lname->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->address->Visible) { // address ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row resdetails_address">
            <div class="col col-sm-4 resdetails_address"><?= $Page->renderFieldHeader($Page->address) ?></div>
            <div class="col col-sm-8"><div<?= $Page->address->cellAttributes() ?>>
<span<?= $Page->address->viewAttributes() ?>>
<?= $Page->address->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row resdetails_address">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->address->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->address->cellAttributes() ?>>
<span<?= $Page->address->viewAttributes() ?>>
<?= $Page->address->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->contactno->Visible) { // contactno ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row resdetails_contactno">
            <div class="col col-sm-4 resdetails_contactno"><?= $Page->renderFieldHeader($Page->contactno) ?></div>
            <div class="col col-sm-8"><div<?= $Page->contactno->cellAttributes() ?>>
<span<?= $Page->contactno->viewAttributes() ?>>
<?= $Page->contactno->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row resdetails_contactno">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->contactno->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->contactno->cellAttributes() ?>>
<span<?= $Page->contactno->viewAttributes() ?>>
<?= $Page->contactno->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->_email->Visible) { // email ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row resdetails__email">
            <div class="col col-sm-4 resdetails__email"><?= $Page->renderFieldHeader($Page->_email) ?></div>
            <div class="col col-sm-8"><div<?= $Page->_email->cellAttributes() ?>>
<span<?= $Page->_email->viewAttributes() ?>>
<?= $Page->_email->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row resdetails__email">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->_email->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->_email->cellAttributes() ?>>
<span<?= $Page->_email->viewAttributes() ?>>
<?= $Page->_email->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->pool_id->Visible) { // pool_id ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row resdetails_pool_id">
            <div class="col col-sm-4 resdetails_pool_id"><?= $Page->renderFieldHeader($Page->pool_id) ?></div>
            <div class="col col-sm-8"><div<?= $Page->pool_id->cellAttributes() ?>>
<span<?= $Page->pool_id->viewAttributes() ?>>
<?= $Page->pool_id->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row resdetails_pool_id">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->pool_id->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->pool_id->cellAttributes() ?>>
<span<?= $Page->pool_id->viewAttributes() ?>>
<?= $Page->pool_id->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->rate_id->Visible) { // rate_id ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row resdetails_rate_id">
            <div class="col col-sm-4 resdetails_rate_id"><?= $Page->renderFieldHeader($Page->rate_id) ?></div>
            <div class="col col-sm-8"><div<?= $Page->rate_id->cellAttributes() ?>>
<span<?= $Page->rate_id->viewAttributes() ?>>
<?= $Page->rate_id->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row resdetails_rate_id">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->rate_id->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->rate_id->cellAttributes() ?>>
<span<?= $Page->rate_id->viewAttributes() ?>>
<?= $Page->rate_id->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->dateuploaded->Visible) { // dateuploaded ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row resdetails_dateuploaded">
            <div class="col col-sm-4 resdetails_dateuploaded"><?= $Page->renderFieldHeader($Page->dateuploaded) ?></div>
            <div class="col col-sm-8"><div<?= $Page->dateuploaded->cellAttributes() ?>>
<span<?= $Page->dateuploaded->viewAttributes() ?>>
<?= $Page->dateuploaded->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row resdetails_dateuploaded">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->dateuploaded->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->dateuploaded->cellAttributes() ?>>
<span<?= $Page->dateuploaded->viewAttributes() ?>>
<?= $Page->dateuploaded->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->uname->Visible) { // uname ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row resdetails_uname">
            <div class="col col-sm-4 resdetails_uname"><?= $Page->renderFieldHeader($Page->uname) ?></div>
            <div class="col col-sm-8"><div<?= $Page->uname->cellAttributes() ?>>
<span<?= $Page->uname->viewAttributes() ?>>
<?= $Page->uname->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row resdetails_uname">
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
