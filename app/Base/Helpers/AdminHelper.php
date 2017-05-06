<?php
if (!function_exists('sortableRenderNode')) {
    function sortableRenderNode($node)
    {
        $actions = Form::tools([
            'edit' => route('admin.page.edit', $node->id),
            'delete' => route('admin.page.destroy', $node->id)
        ]);

        $element = '<div class="item-name'.(!$node->active ? ' inactive': '').'">' .
            '<span class="sort-handle ui-sortable-handle"><i class="glyphicon glyphicon-move"></i></span>' .
            '<span class="text">' . $node->title_lt . '</span>' .
            $actions .
            '</div>';

        if( $node->isLeaf() ) {
            return '<li data-id="' . $node->id . '">' . $element . '</li>';
        } else {
            $html = '<li data-id="' . $node->id . '">' . $element;

            $html .= '<ul class="sortable">';

            foreach($node->children as $child)
                $html .= sortableRenderNode($child);

            $html .= '</ul>';

            $html .= '</li>';
        }

        return $html;
    }
}