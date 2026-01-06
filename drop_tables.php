<?php
use Illuminate\Support\Facades\Schema;

Schema::disableForeignKeyConstraints();
Schema::dropIfExists('clearance_items');
Schema::dropIfExists('clearance_groups');
Schema::enableForeignKeyConstraints();

echo "Dropped tables.";
