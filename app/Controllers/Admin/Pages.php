<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Pages extends BaseController
{
    /**
     * Deterministic stub pages for admin navigation.
     */
    public function show(string $key)
    {
        $pages = [
            'event_management' => ['Event Management', ['Event', 'Event Management']],
            'medical_service_regulations' => ['Medical Service Regulations', ['Medical Services', 'Medical Service Regulations']],
            'pharmacy_regulations' => ['Pharmacy Regulations', ['Pharmacy Recap', 'Pharmacy Regulations']],
            'pharmacy_consumer_recap' => ['Pharmacy Consumer Recap', ['Pharmacy Recap', 'Pharmacy Consumer Recap']],
            'finance_reimbursement' => ['Reimbursement', ['Finance', 'Reimbursement']],
            'finance_restaurant_consumption' => ['Restaurant Consumption', ['Finance', 'Restaurant Consumption']],
            'finance_pharmacy_salary_recap' => ['Pharmacy Salary Recap', ['Finance', 'Pharmacy Salary Recap']],
            'medical_ops_plastic_surgery' => ['Plastic Surgery', ['Medical Operations', 'Plastic Surgery']],
            'analytics_duty_hour_ranking' => ['Duty Hour Ranking', ['Analytics', 'Duty Hour Ranking']],
            'analytics_transaction_ranking' => ['Transaction Ranking', ['Analytics', 'Transaction Ranking']],
            'analytics_website_usage_hours' => ['Website Usage Hours', ['Analytics', 'Website Usage Hours']],
            'user_validation' => ['User Validation', ['User Management', 'User Validation']],
            'user_management' => ['User Management', ['User Management', 'User Management']],
            'recruitment_medical_register' => ['Medical Register', ['Recruitment', 'Medical Register']],
            'recruitment_medical_login' => ['Medical Login', ['Recruitment', 'Medical Login']],
            'recruitment_candidate_registration' => ['Candidate Registration', ['Recruitment', 'Candidate Registration']],
            'recruitment_candidate_exam' => ['Candidate Exam', ['Recruitment', 'Candidate Exam']],
            'recruitment_candidate_evaluation' => ['Candidate Evaluation', ['Recruitment', 'Candidate Evaluation']],
            'recruitment_interview_stage' => ['Interview Stage', ['Recruitment', 'Interview Stage']],
            'recruitment_final_decision' => ['Final Decision', ['Recruitment', 'Final Decision']],
        ];

        if (! isset($pages[$key])) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        [$title, $crumbs] = $pages[$key];

        $breadcrumbs = [
            ['label' => 'Dashboard', 'href' => '/admin'],
        ];
        foreach ($crumbs as $c) {
            $breadcrumbs[] = ['label' => (string) $c];
        }

        return view('admin/page_stub', [
            'title'        => $title,
            'assetVersion' => '1',
            'breadcrumbs'  => $breadcrumbs,
        ]);
    }
}
