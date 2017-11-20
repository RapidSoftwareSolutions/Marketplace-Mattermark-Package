<?php
$routes = [
    'metadata',
    'getCompaniesBySearchQuery',
    'getInvestorsBySearchQuery',
    'getCompaniesList',
    'getCompany',
    'getCompanyNews',
    'getSimilarCompanies',
    'getCompanyEmployees',
    'getCompanyEmployeeInfo',
    'getListOfFundingEvents',
    'getInvestor',
    'getInvestorPortfolioCompanies',
    'getInvestorByComplexQuery',
    'getQuota'
];
foreach($routes as $file) {
    require __DIR__ . '/../src/routes/'.$file.'.php';
}

