# AI Integration Guide

This guide explains how to integrate your Hugging Face space with the Employee-Bee application.

## Overview

The Employee-Bee application now uses your Hugging Face space for generating career insights instead of the local Python script. The integration works by calling your Hugging Face API endpoint with employee data and displaying the results in the application.

## Configuration

The integration is configured through the `.env` file:

```env
# AI Service Configuration
AI_SERVICE_ENABLED=true
AI_SERVICE_URL=https://minura-jayasingha-01--career-insight-ai.hf.space/run/predict
HF_API_URL=https://minura-jayasingha-01--career-insight-ai.hf.space/run/predict
```

## How It Works

1. When a user requests career insights, the application calls the `AiController->generateInsights()` method
2. This method calls `AiService->generateCareerInsights()` with the employee's unique ID
3. The service retrieves employee data from the database:
   - Skills from `employee_career_data.skills`
   - Education from `employee_career_data.education`
   - Current role from `company_employees.role_title`
   - Years of experience calculated from employment history
4. The data is sent to your Hugging Face API endpoint
5. The response is parsed and displayed to the user

## API Endpoint

The integration uses the following endpoint:
```
https://minura-jayasingha-01--career-insight-ai.hf.space/run/predict
```

## Data Format

The data sent to your Hugging Face model follows this format:

```json
{
  "data": [
    "Python, SQL, Machine Learning",  // skills (comma-separated)
    "BSc Computer Science",           // education
    "Data Analyst",                   // current role
    2                                 // years of experience
  ]
}
```

## Response Format

The response from your Hugging Face model should follow this format:

```json
{
  "data": [
    "🎯 Predicted Next Role: Data Scientist\n\n✅ Matched Skills: Python\n❌ Missing Skills: SQL, Machine Learning...\n\n📈 Career Path:\n Data Scientist ...\n\n👥 Peers:\n user_id | current_role | ..."
  ]
}
```

The prediction is returned as a single string inside `data[0]`.

## Testing

To test the integration, you can:

1. Visit the employee insights page in the application
2. Click "Generate New Insights"
3. Check that the insights are generated from your Hugging Face model

You can also run the test script at `resources/views/test/test_ai_integration.php` to verify the integration.

## Troubleshooting

If you encounter issues:

1. Check that your Hugging Face API key is correct in the `.env` file
2. Verify that your Hugging Face space is running and accessible
3. Check the application logs for error messages
4. Ensure employee data exists in the database for testing

## Future Improvements

Possible enhancements to this integration:

1. Add caching of insights to reduce API calls
2. Implement error handling for network issues
3. Add rate limiting to prevent excessive API usage
4. Implement fallback to default insights when API is unavailable