<?php

function getBorrowingStatus($borrowing) {
    if ($borrowing->completed_date == null) {
        if ($borrowing->getOriginal('promising_date') < date('Y-m-d H:i:s')) {
            return '<div class="text-danger">Overdue</div>';
        } else {
            return '<div class="text-warning">Uncompleted</div>';
        }
    } else {
        if ($borrowing->getOriginal('promising_date') < date('Y-m-d H:i:s')) {
            return '<div class="text-info">Late returned</div>';
        } else {
            return '<div class="text-success">Returned</div>';
        }
    }
}

function getEquipmentStatus($equipment) {
    if ($equipment->status == 'AVAILABLE') {
        return '<div class="text-success">Available</div>';
    } else if ($equipment->status == 'OUTOFSTOCK') {
        return '<div class="text-danger">Out of stock</div>';
    } else {
        return '<div class="text-warning">Defective</div>';
    }
}

function getBorrowingEquipmentStatus($borrowing_equipment) {
    if ($borrowing_equipment->pivot->status == 'RETURNED') {
        return '<div class="text-success">Returned</div>';
    } else if ($borrowing_equipment->pivot->status == 'NOTRETURN') {
        return '<div class="text-danger">Not return</div>';
    } else {
        return '<div class="text-warning">Defective</div>';
    }
}

?>