<?php

namespace App\Models;

use App\Models\Model;
use \App\Models\Assigned\Role as AssignedRole;

class Role extends Model
{
		public function abilities() {
        return $this->hasManyThrough(
            Ability::class,
            AssignedRole::class,
            'entity_id', // Foreign key on users table...
            'id', // Foreign key on history table...
            'id', // Local key on suppliers table...
            'role_id' // Local key on users table...
        )->where('entity_type', 'App\\Models\\Role');
    }
}
