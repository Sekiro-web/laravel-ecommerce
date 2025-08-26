<?php

namespace Database\Seeders;

use App\Models\Feedback;
use App\Models\FeedbackCause;
use App\Models\FeedbackStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Feedback::factory(10)->create([
            'subject' => 'Test the feedback',
            'message' => 'This is my feedback for you to read',
        ])->each(function ($feedback) {
            $feedback->name = fake()->name();
            $feedback->email = fake()->email();
            $feedback->save();
        });

        $status = ['Approaved', 'Rejected'];
        foreach ($status as $item) {
            FeedbackStatus::factory()->create([
                'status' => $item
            ]);
        }

        $cause = ['Inappropriate language', 'Spam', 'Irrelevant content', 'False information', 'Personal attacks', 'Confidential data'];
        foreach ($cause as $item) {
            FeedbackCause::factory()->create([
                'cause' => $item
            ]);
        }
    }
}
