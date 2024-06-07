<?php

namespace PHPMaker2023\project1;

// Table
$tbl_resort_details = Container("tbl_resort_details");
?>
<?php if ($tbl_resort_details->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_tbl_resort_detailsmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($tbl_resort_details->pool_name->Visible) { // pool_name ?>
        <tr id="r_pool_name"<?= $tbl_resort_details->pool_name->rowAttributes() ?>>
            <td class="<?= $tbl_resort_details->TableLeftColumnClass ?>"><?= $tbl_resort_details->pool_name->caption() ?></td>
            <td<?= $tbl_resort_details->pool_name->cellAttributes() ?>>
<span id="el_tbl_resort_details_pool_name">
<span<?= $tbl_resort_details->pool_name->viewAttributes() ?>>
<?= $tbl_resort_details->pool_name->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
