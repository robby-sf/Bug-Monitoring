<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Issue;
use App\Models\User;

class IssueSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil ID user pertama sebagai assignee
        $user = User::first();

        // 1. Frontend - High
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

        // 2. Backend - Critical
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

        // 3. Frontend - Medium (Unassigned)
        Issue::create([
            'issue_id' => 'FR-205',
            'title' => 'Image overlap on product catalog',
            'description' => 'Product images are overlapping the text descriptions when viewed on tablet screens.',
            'technical_details' => "Resolution: 768px to 1024px\nFile: catalog.css\nIssue: Flexbox wrap not triggering.",
            'severity' => 'Medium',
            'status' => 'open',
            'category' => 'Frontend',
            'user_id' => null, // Sengaja dikosongkan untuk test UI Not Assigned
        ]);

        // 4. Backend - High
        Issue::create([
            'issue_id' => 'BK-103',
            'title' => 'Payment webhook failing intermittently',
            'description' => 'Payment gateway webhooks are returning 500 errors roughly 5% of the time during transaction updates.',
            'technical_details' => "Endpoint: /api/webhooks/midtrans\nLog: Null pointer exception in PaymentController line 142.",
            'severity' => 'High',
            'status' => 'in-progress',
            'category' => 'Backend',
            'user_id' => $user->id,
        ]);

        // 5. Frontend - Low
        Issue::create([
            'issue_id' => 'FR-206',
            'title' => 'Typo in the footer copyright text',
            'description' => 'The copyright year is still showing 2025 instead of 2026.',
            'technical_details' => "Component: Footer.blade.php\nExpected: Date('Y') dynamic render.",
            'severity' => 'Low',
            'status' => 'resolved',
            'category' => 'Frontend',
            'user_id' => $user->id,
        ]);

        // 6. Backend - Medium (Unassigned)
        Issue::create([
            'issue_id' => 'BK-104',
            'title' => 'CSV Export taking too long',
            'description' => 'Exporting user data to CSV is taking over 30 seconds and sometimes causing Gateway Timeout.',
            'technical_details' => "Query: SELECT * FROM users WITH relationships\nSuggestion: Implement Laravel Job/Queue for this task.",
            'severity' => 'Medium',
            'status' => 'open',
            'category' => 'Backend',
            'user_id' => null, // Sengaja dikosongkan untuk test UI Not Assigned
        ]);

        // 7. Backend - Critical
        Issue::create([
            'issue_id' => 'BK-105',
            'title' => 'Unauthorized access vulnerability in profile update',
            'description' => 'Users can update other users\' profiles by intercepting the request and changing the user_id payload.',
            'technical_details' => "Endpoint: PUT /api/profile/update\nMissing: Policy authorization check before saving data.",
            'severity' => 'Critical',
            'status' => 'open',
            'category' => 'Backend',
            'user_id' => $user->id,
        ]);

        // 8. Frontend - Medium
        Issue::create([
            'issue_id' => 'FR-207',
            'title' => 'Dropdown menu not closing on click outside',
            'description' => 'The notification dropdown menu stays open even when clicking elsewhere on the page.',
            'technical_details' => "Framework: Alpine.js\nMissing: @click.away directive on the dropdown container.",
            'severity' => 'Medium',
            'status' => 'open',
            'category' => 'Frontend',
            'user_id' => $user->id,
        ]);

        // 9. Backend - Low
        Issue::create([
            'issue_id' => 'BK-106',
            'title' => 'API response missing avatar metadata',
            'description' => 'The /api/users endpoint is not returning the avatar_url string in the JSON payload.',
            'technical_details' => "Resource: UserResource.php\nMissing array key map.",
            'severity' => 'Low',
            'status' => 'resolved',
            'category' => 'Backend',
            'user_id' => $user->id,
        ]);

        // 10. Frontend - High (Unassigned)
        Issue::create([
            'issue_id' => 'FR-208',
            'title' => 'Infinite loading spinner on checkout page',
            'description' => 'Users are stuck on an infinite loading screen after clicking the "Pay Now" button.',
            'technical_details' => "Console Error: Axios is not defined.\nAction: Payment process halted.",
            'severity' => 'High',
            'status' => 'open',
            'category' => 'Frontend',
            'user_id' => null, // Sengaja dikosongkan untuk test UI Not Assigned
        ]);

        Issue::create([
            'issue_id' => 'FR-209',
            'title' => 'Infinite loading spinner on checkout page',
            'description' => 'Users are stuck on an infinite loading screen after clicking the "Pay Now" button.',
            'technical_details' => "Console Error: Axios is not defined.\nAction: Payment process halted.",
            'severity' => 'High',
            'status' => 'open',
            'category' => 'Frontend',
            'user_id' => null, // Sengaja dikosongkan untuk test UI Not Assigned
        ]);

        Issue::create([
            'issue_id' => 'FR-210',
            'title' => 'Infinite loading spinner on checkout page',
            'description' => 'Users are stuck on an infinite loading screen after clicking the "Pay Now" button.',
            'technical_details' => "Console Error: Axios is not defined.\nAction: Payment process halted.",
            'severity' => 'High',
            'status' => 'open',
            'category' => 'Frontend',
            'user_id' => null, // Sengaja dikosongkan untuk test UI Not Assigned
        ]);

        Issue::create([
            'issue_id' => 'FR-211',
            'title' => 'Infinite loading spinner on checkout page',
            'description' => 'Users are stuck on an infinite loading screen after clicking the "Pay Now" button.',
            'technical_details' => "Console Error: Axios is not defined.\nAction: Payment process halted.",
            'severity' => 'High',
            'status' => 'open',
            'category' => 'Frontend',
            'user_id' => null, // Sengaja dikosongkan untuk test UI Not Assigned
        ]);

         Issue::create([
            'issue_id' => 'FR-212',
            'title' => 'Infinite loading spinner on checkout page',
            'description' => 'Users are stuck on an infinite loading screen after clicking the "Pay Now" button.',
            'technical_details' => "Console Error: Axios is not defined.\nAction: Payment process halted.",
            'severity' => 'High',
            'status' => 'open',
            'category' => 'Frontend',
            'user_id' => null, // Sengaja dikosongkan untuk test UI Not Assigned
        ]);
    }
}