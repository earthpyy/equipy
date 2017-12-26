<?php

function getLentStatus($lent) {
    if ($lent->return_date == null) {
        if ($lent->promising_date < date('Y-m-d H:i:s')) {
            return '<div class="text-danger">Overdue</div>';
        } else {
            return '<div class="text-warning">Not return</div>';
        }
    } else {
        if ($lent->promising_date < date('Y-m-d H:i:s')) {
            return '<div class="text-info">Late returned</div>';
        } else {
            return '<div class="text-success">Returned</div>';
        }
    }
}

?>