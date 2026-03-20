#!/bin/bash

# Register a user
echo "=== API TEST: REGISTERING USER ==="
curl -s -X POST "http://localhost:8000/api/v1/auth/register" \
  -H "Content-Type: application/json" \
  -d '{
    "name":"Admin User",
    "email":"admin@example.com",
    "password":"AdminPass123",
    "password_confirmation":"AdminPass123"
  }' | jq . 2>/dev/null || echo "Response (raw):"  && curl -s -X POST "http://localhost:8000/api/v1/auth/register" \
  -H "Content-Type: application/json" \
  -d '{"name":"Admin","email":"admin@mail.com","password":"Pass123","password_confirmation":"Pass123"}'

echo ""
echo "=== TEST COMPLETE ==="
