import sys
import os

# Change to the AI model directory
ai_dir = os.path.join(os.path.dirname(__file__), 'ai', 'career-insight-predictor-v2')
os.chdir(ai_dir)

# Add the current directory to Python path
sys.path.insert(0, ai_dir)

from app import predict
import json

# Test data
skills = "Interaction Design, Adobe XD"
education = "BEng Software Engineering"
current_role = "UI/UX Designer"
experience_years = 2
company_comment = "Delivers clean, maintainable work. Excellent feedback from peers and clients."

# Call the predict function
result = predict(skills, education, current_role, experience_years, company_comment)

# Print the result
print("AI Model Response:")
print(result)

# Try to parse JSON
try:
    parsed = json.loads(result)
    print("\nParsed JSON:")
    print(json.dumps(parsed, indent=2))
except json.JSONDecodeError as e:
    print(f"\nFailed to parse JSON: {e}")