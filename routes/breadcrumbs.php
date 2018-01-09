<?php

// Home
Breadcrumbs::register('home', function ($breadcrumbs) {
    $breadcrumbs->push('Home', route('home'));
});

// Equipment
Breadcrumbs::register('equipment.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Equipment', route('equipment.index'));
});
Breadcrumbs::register('equipment.show', function ($breadcrumbs, $equipment) {
    $breadcrumbs->parent('category.show', $equipment->category);
    $breadcrumbs->push($equipment->name, route('equipment.show', $equipment));
});
Breadcrumbs::register('equipment.create', function ($breadcrumbs) {
    $breadcrumbs->parent('equipment.index');
    $breadcrumbs->push('New Equipment', route('equipment.create'));
});
Breadcrumbs::register('equipment.edit', function ($breadcrumbs, $equipment) {
    $breadcrumbs->parent('equipment.show', $equipment);
    $breadcrumbs->push('Edit Equipment', route('equipment.edit', $equipment));
});
Breadcrumbs::register('equipment.defective', function ($breadcrumbs) {
    $breadcrumbs->parent('equipment.index');
    $breadcrumbs->push('Defective', route('equipment.defective'));
});

// Category
Breadcrumbs::register('category.index', function ($breadcrumbs) {
    $breadcrumbs->parent('equipment.index');
    $breadcrumbs->push('Categories', route('category.index'));
});
Breadcrumbs::register('category.show', function ($breadcrumbs, $category) {
    $breadcrumbs->parent('equipment.index');
    $breadcrumbs->push($category->name, route('category.show', $category));
});
Breadcrumbs::register('category.create', function ($breadcrumbs) {
    $breadcrumbs->parent('equipment.index');
    $breadcrumbs->push('New Category', route('category.create'));
});
Breadcrumbs::register('category.edit', function ($breadcrumbs, $equipment) {
    $breadcrumbs->parent('category.show', $equipment);
    $breadcrumbs->push('Edit Category', route('category.edit', $equipment));
});

// Borrowing
Breadcrumbs::register('borrowing.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Borrowings', route('borrowing.index'));
});
Breadcrumbs::register('borrowing.borrower', function ($breadcrumbs, $borrower) {
    $breadcrumbs->parent('borrowing.index');
    $breadcrumbs->push($borrower->name, route('borrowing.borrower', $borrower));
});
Breadcrumbs::register('borrowing.show', function ($breadcrumbs, $borrowing) {
    $breadcrumbs->parent('borrowing.borrower', $borrowing->borrower);
    $breadcrumbs->push($borrowing->id, route('borrowing.show', $borrowing));
});
Breadcrumbs::register('borrowing.borrow', function ($breadcrumbs) {
    $breadcrumbs->parent('borrowing.index');
    $breadcrumbs->push('Borrow', route('borrowing.borrow'));
});
Breadcrumbs::register('borrowing.edit', function ($breadcrumbs, $equipment) {
    $breadcrumbs->parent('borrowing.show', $equipment);
    $breadcrumbs->push('Edit/Return', route('borrowing.edit', $equipment));
});
Breadcrumbs::register('borrowing.uncompleted', function ($breadcrumbs) {
    $breadcrumbs->parent('borrowing.index');
    $breadcrumbs->push('Uncompleted', route('borrowing.uncompleted'));
});
Breadcrumbs::register('borrowing.history', function ($breadcrumbs) {
    $breadcrumbs->parent('borrowing.index');
    $breadcrumbs->push('Histories', route('borrowing.history'));
});

// Borrower
Breadcrumbs::register('borrower.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Borrowers', route('borrower.index'));
});
Breadcrumbs::register('borrower.edit', function ($breadcrumbs, $borrower) {
    $breadcrumbs->parent('borrower.index', $borrower);
    $breadcrumbs->push($borrower->name, route('borrowing.borrower', $borrower));
    $breadcrumbs->push('Edit Borrower', route('borrower.edit', $borrower));
});