<?php

return [
    'common' => [
        'actions' => 'Actions',
        'create' => 'Nuevo Registro',
        'edit' => 'Editar',
        'update' => 'Actualizar Registro',
        'new' => 'Nuevo',
        'cancel' => 'Cancel',
        'attach' => 'Attach',
        'detach' => 'Detach',
        'save' => 'Save',
        'delete' => 'Eliminar',
        'delete_selected' => 'Eliminar Seleccionado',
        'search' => 'Search...',
        'back' => 'Mostar Registros',
        'are_you_sure' => 'Are you sure?',
        'no_items_found' => 'No se encontaron resultados',
        'created' => 'Creado con éxito',
        'saved' => 'Guardado exitosamente',
        'removed' => 'Eliminada exitosamente',
    ],

    'users' => [
        'name' => 'Users',
        'index_title' => 'Users List',
        'new_title' => 'New User',
        'create_title' => 'Create User',
        'edit_title' => 'Edit User',
        'show_title' => 'Show User',
        'inputs' => [
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
        ],
    ],

    'estados' => [
        'name' => 'Estados',
        'index_title' => 'Estados List',
        'new_title' => 'Nuevo Estado',
        'create_title' => 'Crear Estado',
        'edit_title' => 'Editar Estado',
        'show_title' => 'Ver Estado',
        'inputs' => [
            'nombre_estado' => 'Estado',
        ],
    ],

    'proveedors' => [
        'name' => 'Proveedors',
        'index_title' => 'Proveedors List',
        'new_title' => 'Nuevo Proveedor',
        'create_title' => 'Crear Proveedor',
        'edit_title' => 'Editar Proveedor',
        'show_title' => 'Ver Proveedor',
        'inputs' => [
            'rut' => 'Rut',
            'nombre' => 'Nombre',
        ],
    ],

    'registros' => [
        'name' => 'Registros',
        'index_title' => 'Vistas Sala de Servidores HPM',
        'new_title' => 'Nuevo Registro',
        'create_title' => 'Crear Registro',
        'edit_title' => 'Editar Registro',
        'show_title' => 'Ver Registro',
        'inputs' => [
            'rut' => 'Rut',
            'nombres' => 'Nombres',
            'apellidos' => 'Apellidos',
            'proveedor_id' => 'Proveedor',
            'motivo' => 'Motivo',
            'estado_id' => 'Estado',
            'user_id' => 'User',
        ],
    ],

    'roles' => [
        'name' => 'Roles',
        'index_title' => 'Roles List',
        'create_title' => 'Crear Role',
        'edit_title' => 'Edit Role',
        'show_title' => 'Show Role',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'permissions' => [
        'name' => 'Permissions',
        'index_title' => 'Permissions List',
        'create_title' => 'Create Permission',
        'edit_title' => 'Edit Permission',
        'show_title' => 'Show Permission',
        'inputs' => [
            'name' => 'Name',
        ],
    ],
];
