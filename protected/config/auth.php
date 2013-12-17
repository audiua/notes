<?php 
return array(
    'author' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Author',
        'bizRule' => null,
        'data' => null
    ),
    'admin' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Admin',
        'children' => array(
            'author', // унаследуемся от гостя
        ),
        'bizRule' => null,
        'data' => null
    ),
);
