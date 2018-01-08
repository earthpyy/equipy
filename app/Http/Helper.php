<?php

function getLentStatus($lent) {
    if ($lent->completed_date == null) {
        if ($lent->getOriginal('promising_date') < date('Y-m-d H:i:s')) {
            return '<div class="text-danger">Overdue</div>';
        } else {
            return '<div class="text-warning">Uncompleted</div>';
        }
    } else {
        if ($lent->getOriginal('promising_date') < date('Y-m-d H:i:s')) {
            return '<div class="text-info">Late returned</div>';
        } else {
            return '<div class="text-success">Returned</div>';
        }
    }
}

function getThingStatus($thing) {
    if ($thing->status == 'AVAILABLE') {
        return '<div class="text-success">Available</div>';
    } else if ($thing->status == 'OUTOFSTOCK') {
        return '<div class="text-danger">Out of stock</div>';
    } else {
        return '<div class="text-warning">Defective</div>';
    }
}

function getLentThingStatus($lent_thing) {
    if ($lent_thing->pivot->status == 'RETURNED') {
        return '<div class="text-success">Returned</div>';
    } else if ($lent_thing->pivot->status == 'NOTRETURN') {
        return '<div class="text-danger">Not return</div>';
    } else {
        return '<div class="text-warning">Defective</div>';
    }
}

?>