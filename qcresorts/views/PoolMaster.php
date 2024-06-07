<?php

namespace PHPMaker2023\project1;

// Table
$pool = Container("pool");
?>
<?php if ($pool->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_poolmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($pool->pool_name->Visible) { // pool_name ?>
        <tr id="r_pool_name"<?= $pool->pool_name->rowAttributes() ?>>
            <td class="<?= $pool->TableLeftColumnClass ?>"><?= $pool->pool_name->caption() ?></td>
            <td<?= $pool->pool_name->cellAttributes() ?>>
<span id="el_pool_pool_name">
<span<?= $pool->pool_name->viewAttributes() ?>>
<?= $pool->pool_name->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($pool->barangay->Visible) { // barangay ?>
        <tr id="r_barangay"<?= $pool->barangay->rowAttributes() ?>>
            <td class="<?= $pool->TableLeftColumnClass ?>"><?= $pool->barangay->caption() ?></td>
            <td<?= $pool->barangay->cellAttributes() ?>>
<span id="el_pool_barangay">
<span<?= $pool->barangay->viewAttributes() ?>>
<?= $pool->barangay->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($pool->uname->Visible) { // uname ?>
        <tr id="r_uname"<?= $pool->uname->rowAttributes() ?>>
            <td class="<?= $pool->TableLeftColumnClass ?>"><?= $pool->uname->caption() ?></td>
            <td<?= $pool->uname->cellAttributes() ?>>
<span id="el_pool_uname">
<span<?= $pool->uname->viewAttributes() ?>>
<?= $pool->uname->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
