<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// --------------------------------------------------------------------
// Admin Panel (PHASE 4 - layout shell)
// --------------------------------------------------------------------
$routes->group('admin', static function (RouteCollection $routes) {
    $routes->get('login', 'Admin\\Auth::login');
    $routes->post('login', 'Admin\\Auth::attempt');
    $routes->get('logout', 'Admin\\Auth::logout');
    $routes->get('diagnostics/db', 'Admin\\Diagnostics::db');

    $routes->group('', ['filter' => 'adminauth'], static function (RouteCollection $routes) {
        $routes->get('/', 'Admin\\Dashboard::index');
        $routes->get('account', 'Admin\\Dashboard::index'); // stub for navbar link

        // Event
        $routes->get('event/management', 'Admin\\Pages::show/event_management');

        // Medical Services
        $routes->get('medical-services/regulations', 'Admin\\Pages::show/medical_service_regulations');

        // Pharmacy Recap
        $routes->get('pharmacy/recap', 'Admin\\Pages::show/pharmacy_recap');
        $routes->get('pharmacy/regulations', 'Admin\\Pages::show/pharmacy_regulations');
        $routes->get('pharmacy/consumer-recap', 'Admin\\Pages::show/pharmacy_consumer_recap');

        // Finance
        $routes->get('finance/reimbursement', 'Admin\\Pages::show/finance_reimbursement');
        $routes->get('finance/restaurant-consumption', 'Admin\\Pages::show/finance_restaurant_consumption');
        $routes->get('finance/pharmacy-salary-recap', 'Admin\\Pages::show/finance_pharmacy_salary_recap');

        // Medical Operations
        $routes->get('medical-operations/plastic-surgery', 'Admin\\Pages::show/medical_ops_plastic_surgery');

        // Analytics
        $routes->get('analytics/duty-hour-ranking', 'Admin\\Pages::show/analytics_duty_hour_ranking');
        $routes->get('analytics/transaction-ranking', 'Admin\\Pages::show/analytics_transaction_ranking');
        $routes->get('analytics/website-usage-hours', 'Admin\\Pages::show/analytics_website_usage_hours');

        // User Management
        $routes->get('user-management/validation', 'Admin\\Pages::show/user_validation');
        $routes->get('user-management/users', 'Admin\\Pages::show/user_management');

        // Recruitment
        $routes->get('recruitment/medical-register', 'Admin\\Pages::show/recruitment_medical_register');
        $routes->get('recruitment/medical-login', 'Admin\\Pages::show/recruitment_medical_login');
        $routes->get('recruitment/candidate-registration', 'Admin\\Pages::show/recruitment_candidate_registration');
        $routes->get('recruitment/candidate-exam', 'Admin\\Pages::show/recruitment_candidate_exam');
        $routes->get('recruitment/candidate-evaluation', 'Admin\\Pages::show/recruitment_candidate_evaluation');
        $routes->get('recruitment/interview-stage', 'Admin\\Pages::show/recruitment_interview_stage');
        $routes->get('recruitment/final-decision', 'Admin\\Pages::show/recruitment_final_decision');
    });
});
