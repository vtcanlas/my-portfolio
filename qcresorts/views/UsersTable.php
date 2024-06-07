<?php
namespace PHPMaker2022\project1;
?>
<div class="ew-multi-column-grid">
<?php $Page->LayoutOptions->render("body") ?>
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> users">
<form name="fuserslist" id="fuserslist" class="ew-form ew-list-form ew-multi-column-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="users">
<div id="gmp_users" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_userslist" class="table table-hover table-sm ew-table"><!-- .ew-table -->
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
<?php if ($Page->fname->Visible) { // fname ?>
        <th data-name="fname" class="<?= $Page->fname->headerCellClass() ?>"><div id="elh_users_fname" class="users_fname"><?= $Page->renderFieldHeader($Page->fname) ?></div></th>
<?php } ?>
<?php if ($Page->lname->Visible) { // lname ?>
        <th data-name="lname" class="<?= $Page->lname->headerCellClass() ?>"><div id="elh_users_lname" class="users_lname"><?= $Page->renderFieldHeader($Page->lname) ?></div></th>
<?php } ?>
<?php if ($Page->uname->Visible) { // uname ?>
        <th data-name="uname" class="<?= $Page->uname->headerCellClass() ?>"><div id="elh_users_uname" class="users_uname"><?= $Page->renderFieldHeader($Page->uname) ?></div></th>
<?php } ?>
<?php if ($Page->pword->Visible) { // pword ?>
        <th data-name="pword" class="<?= $Page->pword->headerCellClass() ?>"><div id="elh_users_pword" class="users_pword"><?= $Page->renderFieldHeader($Page->pword) ?></div></th>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
        <th data-name="_email" class="<?= $Page->_email->headerCellClass() ?>"><div id="elh_users__email" class="users__email"><?= $Page->renderFieldHeader($Page->_email) ?></div></th>
<?php } ?>
<?php if ($Page->_userlevel->Visible) { // userlevel ?>
        <th data-name="_userlevel" class="<?= $Page->_userlevel->headerCellClass() ?>"><div id="elh_users__userlevel" class="users__userlevel"><?= $Page->renderFieldHeader($Page->_userlevel) ?></div></th>
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
    <tr <?= $Page->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Page->ListOptions->render("body", "left", $Page->RowCount);
?>
    <?php if ($Page->fname->Visible) { // fname ?>
        <td data-name="fname"<?= $Page->fname->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_users_fname" class="el_users_fname">
<span<?= $Page->fname->viewAttributes() ?>>
<?= $Page->fname->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->lname->Visible) { // lname ?>
        <td data-name="lname"<?= $Page->lname->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_users_lname" class="el_users_lname">
<span<?= $Page->lname->viewAttributes() ?>>
<?= $Page->lname->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->uname->Visible) { // uname ?>
        <td data-name="uname"<?= $Page->uname->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_users_uname" class="el_users_uname">
<span<?= $Page->uname->viewAttributes() ?>>
<?= $Page->uname->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->pword->Visible) { // pword ?>
        <td data-name="pword"<?= $Page->pword->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_users_pword" class="el_users_pword">
<span<?= $Page->pword->viewAttributes() ?>>
<?= $Page->pword->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->_email->Visible) { // email ?>
        <td data-name="_email"<?= $Page->_email->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_users__email" class="el_users__email">
<span<?= $Page->_email->viewAttributes() ?>>
<?= $Page->_email->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->_userlevel->Visible) { // userlevel ?>
        <td data-name="_userlevel"<?= $Page->_userlevel->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_users__userlevel" class="el_users__userlevel">
<span<?= $Page->_userlevel->viewAttributes() ?>>
<?= $Page->_userlevel->getViewValue() ?></span>
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
