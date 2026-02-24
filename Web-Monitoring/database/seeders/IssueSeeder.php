<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Issue;
use App\Models\User;

class IssueSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil ID user pertama (admin) sebagai assignee
        $user = User::first();

        Issue::create([
            'issue_id' => 'FR-204',
            'title' => 'Login button not responding on mobile',
            'description' => 'Users report that the login button is unresponsive on iOS devices using Safari.',
            'technical_details' => "Browser: Safari Mobile\nOS: iOS 15.x\nComponent: Auth/LoginButton.tsx",
            'severity' => 'High',
            'status' => 'in-progress',
            'category' => 'Frontend',
            'user_id' => $user->id,
        ]);

        Issue::create([
            'issue_id' => 'BK-102',
            'title' => 'Database connection timeout',
            'description' => 'Connection pool exhausted during peak hours affecting API response.',
            'technical_details' => "Service: API-Gateway\nError: ETIMEDOUT\nThreshold: 5000ms",
            'severity' => 'Critical',
            'status' => 'open',
            'category' => 'Backend',
            'user_id' => $user->id,
        ]);
    }
}
