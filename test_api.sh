#!/bin/bash
# Quick API test script

# Register a user
echo "=== REGISTERING USER ==="
curl -s -X POST "http://localhost:8000/api/v1/auth/register" \
  -H "Content-Type: application/json" \
  -d '{"name":"Admin","email":"admin@example.com","password":"Pass1234","password_confirmation":"Pass1234"}' \
  | jq . 2>/dev/null || echo "Failed to parse JSON"

echo -e "\n=== DONE ==="
