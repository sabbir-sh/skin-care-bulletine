<?php

if (! function_exists('action_buttons')) {
    /**
     * Render a group of action buttons.
     *
     * @param array $buttons
     * @return string
     */
    function action_buttons(array $buttons): string
    {
        return '<div class="flex gap-2 justify-center">'.implode('', $buttons).'</div>';
    }
}

if (! function_exists('edit_column')) {
    function edit_column(string $route, string $label = 'Edit'): string
    {
        return <<<HTML
        <a href="{$route}"
            class="btn btn-sm btn-light rounded-pill d-inline-flex align-items-center gap-1"
            data-bs-toggle="tooltip" title="{$label}">
            <i class="bi bi-pencil"></i> {$label}
        </a>
        HTML;
    }
}

if (! function_exists('delete_column')) {
    function delete_column(string $route, string $label = 'Delete'): string
    {
        return '<form action="' . $route . '" method="POST" class="d-inline" onsubmit="return confirm(\'Are you sure?\')">'
            . csrf_field()
            . method_field('DELETE') .
            '<button type="submit" class="btn btn-sm btn-light rounded-pill" data-bs-toggle="tooltip" title="' . $label . '">'
            . '<i class="bi bi-trash"></i> ' . $label .
            '</button></form>';
    }
}




if (! function_exists('view_column')) {
    function view_column(string $route, string $label = 'View'): string
    {
        return <<<HTML
        <a href="{$route}" class="btn btn-sm btn-secondary rounded-pill d-inline-flex align-items-center gap-1" data-bs-toggle="tooltip" title="{$label}">
            <i class="bi bi-eye"></i> {$label}
        </a>
        HTML;
    }
}



