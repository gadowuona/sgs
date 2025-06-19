<?php

namespace Database\Seeders;

use App\Models\Thesis;
use App\Models\ThesisTimeline;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ThesisTimelineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $thesis = Thesis::first(); // Or random()

        if (!$thesis) {
            $this->command->error('No thesis found. Seed theses first.');
            return;
        }

        $events = [
            ['event' => 'Submission received', 'note' => 'Initial submission', 'date' => '2025-05-10'],
            ['event' => 'Submission is under technical check', 'note' => null, 'date' => '2025-05-10'],
            ['event' => 'Amendment requested', 'note' => 'Minor format changes required', 'date' => '2025-05-24'],
            ['event' => 'Amendment received', 'note' => 'Corrected version uploaded', 'date' => '2025-05-25'],
            ['event' => 'Amendment requested', 'note' => 'Add references', 'date' => '2025-05-29'],
            ['event' => 'Amendment received', 'note' => 'References added', 'date' => '2025-05-30'],
            ['event' => 'Submission passed technical check', 'note' => null, 'date' => '2025-05-31'],
            ['event' => 'Ready for editorial assignment', 'note' => null, 'date' => '2025-05-31'],
            ['event' => 'Editor assigned', 'note' => null, 'date' => '2025-05-31'],
        ];

        foreach ($events as $data) {
            ThesisTimeline::create([
                'thesis_id' => $thesis->id,
                'event' => $data['event'],
                'note' => $data['note'],
                'event_date' => $data['date'],
            ]);
        }
    }
}
