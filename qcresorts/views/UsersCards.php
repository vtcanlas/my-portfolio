<?php
namespace PHPMaker2022\project1;
?>
<div class="ew-multi-column-grid">
<?php $Page->LayoutOptions->render("body") ?>
<form name="fuserslist" id="fuserslist" class="ew-form ew-list-form ew-multi-column-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="users">
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
            "id" => "r" . $Page->RowCount . "_users",
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
    <?php if ($Page->fname->Visible) { // fname ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row users_fname">
            <div class="col col-sm-4 users_fname"><?= $Page->renderFieldHeader($Page->fname) ?></div>
            <div class="col col-sm-8"><div<?= $Page->fname->cellAttributes() ?>>
<span<?= $Page->fname->viewAttributes() ?>>
<?= $Page->fname->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row users_fname">
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
        <div class="row users_lname">
            <div class="col col-sm-4 users_lname"><?= $Page->renderFieldHeader($Page->lname) ?></div>
            <div class="col col-sm-8"><div<?= $Page->lname->cellAttributes() ?>>
<span<?= $Page->lname->viewAttributes() ?>>
<?= $Page->lname->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row users_lname">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->lname->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->lname->cellAttributes() ?>>
<span<?= $Page->lname->viewAttributes() ?>>
<?= $Page->lname->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->uname->Visible) { // uname ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row users_uname">
            <div class="col col-sm-4 users_uname"><?= $Page->renderFieldHeader($Page->uname) ?></div>
            <div class="col col-sm-8"><div<?= $Page->uname->cellAttributes() ?>>
<span<?= $Page->uname->viewAttributes() ?>>
<?= $Page->uname->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row users_uname">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->uname->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->uname->cellAttributes() ?>>
<span<?= $Page->uname->viewAttributes() ?>>
<?= $Page->uname->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->pword->Visible) { // pword ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row users_pword">
            <div class="col col-sm-4 users_pword"><?= $Page->renderFieldHeader($Page->pword) ?></div>
            <div class="col col-sm-8"><div<?= $Page->pword->cellAttributes() ?>>
<span<?= $Page->pword->viewAttributes() ?>>
<?= $Page->pword->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row users_pword">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->pword->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->pword->cellAttributes() ?>>
<span<?= $Page->pword->viewAttributes() ?>>
<?= $Page->pword->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->_email->Visible) { // email ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row users__email">
            <div class="col col-sm-4 users__email"><?= $Page->renderFieldHeader($Page->_email) ?></div>
            <div class="col col-sm-8"><div<?= $Page->_email->cellAttributes() ?>>
<span<?= $Page->_email->viewAttributes() ?>>
<?= $Page->_email->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row users__email">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->_email->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->_email->cellAttributes() ?>>
<span<?= $Page->_email->viewAttributes() ?>>
<?= $Page->_email->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->_userlevel->Visible) { // userlevel ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row users__userlevel">
            <div class="col col-sm-4 users__userlevel"><?= $Page->renderFieldHeader($Page->_userlevel) ?></div>
            <div class="col col-sm-8"><div<?= $Page->_userlevel->cellAttributes() ?>>
<span<?= $Page->_userlevel->viewAttributes() ?>>
<?= $Page->_userlevel->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row users__userlevel">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->_userlevel->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->_userlevel->cellAttributes() ?>>
<span<?= $Page->_userlevel->viewAttributes() ?>>
<?= $Page->_userlevel->getViewValue() ?></span>
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
