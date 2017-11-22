[![](https://scdn.rapidapi.com/RapidAPI_banner.png)](https://rapidapi.com/package/Mattermark/functions?utm_source=RapidAPIGitHub_MattermarkFunctions&utm_medium=button&utm_content=RapidAPI_GitHub)

# Mattermark Package
Research the Companies & Employees Who Matter Most.Get actionable insights by syncing over 80 informative fields to help warm leads and power conversations from first touch to deal close. Get all the relevant information from inside Salesforce, and apply triggers and actions to any lead, opportunity, or other object.
* Domain: [mattermark.com](https:\/\/mattermark.com)
* Credentials: apiKey

## How to get credentials: 
0. Register on the [mattermark.com](https:\/\/mattermark.com)
1. After registration , you can [obtain](https:\/\/mattermark.com\/app\/account\/api) your API key from your API settings page

## Custom datatypes: 
 |Datatype|Description|Example
 |--------|-----------|----------
 |Datepicker|String which includes date and time|```2016-05-28 00:00:00```
 |Map|String which includes latitude and longitude coma separated|```50.37, 26.56```
 |List|Simple array|```["123", "sample"]``` 
 |Select|String with predefined values|```sample```
 |Array|Array of objects|```[{"Second name":"123","Age":"12","Photo":"sdf","Draft":"sdfsdf"},{"name":"adi","Second name":"bla","Age":"4","Photo":"asfserwe","Draft":"sdfsdf"}] ```
 
## Mattermark.getCompaniesBySearchQuery
The search endpoint can be used to query for a company based on a keyword you define, and is also useful to provide autocompletion for common queries, such as by company name or domain.

| Field      | Type       | Description
|------------|------------|----------
| apiKey     | credentials| Your api key.
| searchQuery| String     | The term to query by.

## Mattermark.getInvestorsBySearchQuery
The search endpoint can be used to query for a investors based on a keyword you define.

| Field      | Type       | Description
|------------|------------|----------
| apiKey     | credentials| Your api key.
| searchQuery| String     | The term to query by.

## Mattermark.getCompaniesList
The company list allows you to retrieve all companies, or a list of companies filtered by one or many parameters.

| Field                        | Type       | Description
|------------------------------|------------|----------
| apiKey                       | credentials| Your api key.
| domain                       | String     | The domain of the company’s website.
| companyName                  | String     | The company’s name.
| startAddedDate               | DatePicker | The date the company started being tracked by Mattermark. 
| endAddedDate                 | DatePicker | The date the company ended being tracked by Mattermark.
| mattermarkScore              | String     | The current Mattermark score of the company.Numeric range.
| momentumScore                | String     | The latest weekly momentum score of the company.Numeric range.
| employees                    | String     | The number of employees currently at the company.Numeric range.
| employeesMonthAgo            | String     | Count of employees one month ago.Numeric range.
| employeesAddedInMonth        | String     | Count of employees added this month.Numeric range.
| employeesMom                 | String     | The percent employee growth during that month.Numeric range.
| cachedUniques                | String     | The estimated monthly unique visitors to the company’s website.Numeric range.
| cachedUniquesWeekAgo         | String     | The estimated monthly unique visitors to the company’s website during the past 7 days.Numeric range.
| uniquesWow                   | String     | The percent change in the estimated monthly unique visitors to the company’s website in the past 7 days.Numeric range.
| cachedUniquesMonthAgo        | String     | The estimated monthly unique visitors to the company’s website during the past month.Numeric range.
| uniquesMom                   | String     | The percent change in the estimated monthly unique visitors to the company’s website in the past month.Numeric range.
| cachedMobileDownloads        | String     | The estimated monthly mobile downloads from the U.S. iTunes app store.Numeric range.
| cachedMobileDownloadsWeekAgo | String     | The estimated monthly mobile downloads one week ago from the U.S. iTunes app store.Numeric range.
| mobileDownloadsWow           | String     | The change in the estimated monthly mobile downloads from the U.S. iTunes app store during the past week.Numeric range.
| cachedMobileDownloadsMonthAgo| String     | The count of the estimated monthly mobile downloads from the U.S. iTunes app store during the past month.Numeric range.
| mobileDownloadsMom           | String     | The growth of the estimated monthly mobile downloads from the U.S. iTunes app store during the past month.Numeric range.
| estFoundingDates             | List       | The estimated founding date of the company.
| stages                       | List       | The most recent funding round for the company.
| hasGooglePlay                | Select     | Companies that have a Google Play application.
| hasItunes                    | Select     | Companies that have an iTunes application.
| playCategory                 | List       | The Google Play store categories of applications associated with the company.
| itunesCategory               | List       | The iTunes store categories of applications associated with the company.
| businessModels               | List       | The business models employed by the company to generate revenue.
| industries                   | List       | The industries the company operates within.
| keywords                     | List       | Keywords associated with the company.
| page                         | Number     | The page of items from the result set to return.
| perPage                      | Number     | The numbers of items to return per page.

## Mattermark.getCompany
Retrieve a specific company.

| Field    | Type       | Description
|----------|------------|----------
| apiKey   | credentials| Your api key.
| companyId| String     | Id of the company.

## Mattermark.getCompanyNews
The company stories endpoint retrieves the 50 latest news articles about the specified company.

| Field    | Type       | Description
|----------|------------|----------
| apiKey   | credentials| Your api key.
| companyId| String     | Id of the company.

## Mattermark.getSimilarCompanies
The similar companies endpoint returns up to 20 of the most similar companies ordered related to the specified company.

| Field    | Type       | Description
|----------|------------|----------
| apiKey   | credentials| Your api key.
| companyId| String     | Id of the company.

## Mattermark.getCompanyEmployees
This endpoint allows you to retrieve key personnel for a specific company in our database.

| Field    | Type       | Description
|----------|------------|----------
| apiKey   | credentials| Your api key.
| companyId| String     | Id of the company.

## Mattermark.getCompanyEmployeeInfo
This endpoint allows you to retrieve contact information for a specific person at a company.

| Field    | Type       | Description
|----------|------------|----------
| apiKey   | credentials| Your api key.
| companyId| String     | Id of the company.
| fullName| String     | The full name of the individual to find contact information for.

## Mattermark.getListOfFundingEvents
Retrieve a list of funding events for a specific query.

| Field           | Type       | Description
|-----------------|------------|----------
| apiKey          | credentials| Your api key.
| amount          | Number     | money reported raised in the funding round.
| cities          | List       | Pipe separated list of city names.
| countries       | List       | List of three character country codes.
| startFundingDate| DatePicker | Start funding date.
| endFundingDate  | DatePicker | End funding date.Use only with startFundingDate.
| investorIds     | List       | List of investor ids.
| investorSlugs   | List       | List of investor slugs, see Investors to get a list of all investors.
| series          | Select     | List of series.
| page            | Number     | The page of items from the result set to return.
| perPage         | Number     | The numbers of items to return per page.

## Mattermark.getInvestor
Returns details for a specific investor. Information includes the size of their portfolio and some stats around their portfolio and funding deals.

| Field     | Type       | Description
|-----------|------------|----------
| apiKey    | credentials| Your api key.
| investorId| String     | The ID of the investor to retrieve.

## Mattermark.getInvestorPortfolioCompanies
Returns a list of portfolio companies for a specific investor.

| Field     | Type       | Description
|-----------|------------|----------
| apiKey    | credentials| Your api key.
| investorId| String     | The ID of the investor to retrieve.

## Mattermark.getInvestorByComplexQuery
Returns a list of investors matching the MSFL query. The Mattermark Semantic Filter Language allows you to perform a complex query in a single request.See more [here](https://docs.mattermark.com/api_v1/queries/index.html)

| Field  | Type       | Description
|--------|------------|----------
| apiKey | credentials| Your api key.
| dataset| Select     | Select of the dataset.
| filter | JSON       | Json filter object.
| sort   | JSON       | Json sort object.
| page   | Number     | The page of items from the result set to return.
| perPage| Number     | The numbers of items to return per page.

##### Example for filter field
```
{ "portfolio_size":{"gte":100}}
```
##### Example for sort field
```
[{"name":"desc"}]
```

