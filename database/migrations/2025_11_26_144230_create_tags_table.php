<?php

use App\Models\Tag;
use App\Models\Task;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('tag_task', function (Blueprint $table) { // convention Laravel: au singulier et par ordre alphanumérique
            $table->foreignIdFor(Tag::class)->constrained()->cascadeOnDelete(); // creates 'tag_id' column in table tag_task with FK to 'tags.id'
            $table->foreignIdFor(Task::class)->constrained()->cascadeOnDelete(); // creates 'task_id' column in table tag_task with FK to 'task.id'
            $table->primary(['task_id', 'tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tags');
        Schema::dropIfExists('tag_task');
    }
};
