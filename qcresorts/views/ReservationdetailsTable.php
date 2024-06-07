<?php
namespace PHPMaker2022\project1;
?>
<div class="ew-multi-column-grid">
<?php $Page->LayoutOptions->render("body") ?>
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> reservationdetails">
<form name="freservationdetailslist" id="freservationdetailslist" class="ew-form ew-list-form ew-multi-column-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="reservationdetails">
<div id="gmp_reservationdetails" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_reservationdetailslist" class="table table-hover table-sm ew-table"><!-- .ew-table -->
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
        <th data-name="rateid" class="<?= $Page->rateid->headerCellClass() ?>"><div id="elh_reservationdetails_rateid" class="reservationdetails_rateid"><?= $Page->renderFieldHeader($Page->rateid) ?></div></th>
<?php } ?>
<?php if ($Page->pool_name->Visible) { // pool_name ?>
        <th data-name="pool_name" class="<?= $Page->pool_name->headerCellClass() ?>"><div id="elh_reservationdetails_pool_name" class="reservationdetails_pool_name"><?= $Page->renderFieldHeader($Page->pool_name) ?></div></th>
<?php } ?>
<?php if ($Page->ratename->Visible) { // ratename ?>
        <th data-name="ratename" class="<?= $Page->ratename->headerCellClass() ?>"><div id="elh_reservationdetails_ratename" class="reservationdetails_ratename"><?= $Page->renderFieldHeader($Page->ratename) ?></div></th>
<?php } ?>
<?php if ($Page->rateprice->Visible) { // rateprice ?>
        <th data-name="rateprice" class="<?= $Page->rateprice->headerCellClass() ?>"><div id="elh_reservationdetails_rateprice" class="reservationdetails_rateprice"><?= $Page->renderFieldHeader($Page->rateprice) ?></div></th>
<?php } ?>
<?php if ($Page->ratearrivaltime->Visible) { // ratearrivaltime ?>
        <th data-name="ratearrivaltime" class="<?= $Page->ratearrivaltime->headerCellClass() ?>"><div id="elh_reservationdetails_ratearrivaltime" class="reservationdetails_ratearrivaltime"><?= $Page->renderFieldHeader($Page->ratearrivaltime) ?></div></th>
<?php } ?>
<?php if ($Page->ratedeparturetime->Visible) { // ratedeparturetime ?>
        <th data-name="ratedeparturetime" class="<?= $Page->ratedeparturetime->headerCellClass() ?>"><div id="elh_reservationdetails_ratedeparturetime" class="reservationdetails_ratedeparturetime"><?= $Page->renderFieldHeader($Page->ratedeparturetime) ?></div></th>
<?php } ?>
<?php if ($Page->user_id->Visible) { // user_id ?>
        <th data-name="user_id" class="<?= $Page->user_id->headerCellClass() ?>"><div id="elh_reservationdetails_user_id" class="reservationdetails_user_id"><?= $Page->renderFieldHeader($Page->user_id) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_reservationdetails",
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
<span id="el<?= $Page->RowCount ?>_reservationdetails_rateid" class="el_reservationdetails_rateid">
<span<?= $Page->rateid->viewAttributes() ?>>
<?= $Page->rateid->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->pool_name->Visible) { // pool_name ?>
        <td data-name="pool_name"<?= $Page->pool_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_reservationdetails_pool_name" class="el_reservationdetails_pool_name">
<span<?= $Page->pool_name->viewAttributes() ?>>
<?= $Page->pool_name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ratename->Visible) { // ratename ?>
        <td data-name="ratename"<?= $Page->ratename->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_reservationdetails_ratename" class="el_reservationdetails_ratename">
<span<?= $Page->ratename->viewAttributes() ?>>
<?= $Page->ratename->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->rateprice->Visible) { // rateprice ?>
        <td data-name="rateprice"<?= $Page->rateprice->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_reservationdetails_rateprice" class="el_reservationdetails_rateprice">
<span<?= $Page->rateprice->viewAttributes() ?>>
<?= $Page->rateprice->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ratearrivaltime->Visible) { // ratearrivaltime ?>
        <td data-name="ratearrivaltime"<?= $Page->ratearrivaltime->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_reservationdetails_ratearrivaltime" class="el_reservationdetails_ratearrivaltime">
<span<?= $Page->ratearrivaltime->viewAttributes() ?>>
<?= $Page->ratearrivaltime->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ratedeparturetime->Visible) { // ratedeparturetime ?>
        <td data-name="ratedeparturetime"<?= $Page->ratedeparturetime->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_reservationdetails_ratedeparturetime" class="el_reservationdetails_ratedeparturetime">
<span<?= $Page->ratedeparturetime->viewAttributes() ?>>
<?= $Page->ratedeparturetime->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->user_id->Visible) { // user_id ?>
        <td data-name="user_id"<?= $Page->user_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_reservationdetails_user_id" class="el_reservationdetails_user_id">
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
</div><!-- /.ew-multi-column-grid -->
