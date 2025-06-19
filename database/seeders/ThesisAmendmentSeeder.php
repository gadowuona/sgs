<?php

namespace Database\Seeders;

use App\Models\Supervisor;
use App\Models\Thesis;
use App\Models\ThesisAmendment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ThesisAmendmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $thesis = Thesis::first();
        $supervisor = Supervisor::first();

        if (!$thesis || !$supervisor) {
            $this->command->error('Missing thesis or supervisor. Seed them first.');
            return;
        }

        ThesisAmendment::create([
            'thesis_id' => $thesis->id,
            'type' => 'initial',
            'file_path' => "theses/{$thesis->id}/thesis.pdf",
            'status' => 'under-review',
            'submitted_at' => now()->subDays(2),
            'reviewed_by' => $supervisor->id,
            'reviewed_at' => now(),
            'supervisor_feedback' => 'Good work. Consider improving your abstract.',
        ]);
    }
}
