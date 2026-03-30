#!/bin/bash
# Update PHP_PAM_VERSION in header from composer.json
# Run automatically via Makefile before build

set -e

COMPOSER_JSON="composer.json"
HEADER_FILE="php_pam.h"

if [ ! -f "$COMPOSER_JSON" ]; then
    echo "Error: $COMPOSER_JSON not found"
    exit 1
fi

if [ ! -f "$HEADER_FILE" ]; then
    echo "Error: $HEADER_FILE not found"
    exit 1
fi

# Extract version from composer.json
# Handle both "version": "3.0.0" and "version": "3.0.0-dev"
VERSION=$(grep '"version"' "$COMPOSER_JSON" | \
          sed 's/.*"version"[[:space:]]*:[[:space:]]*"\([^"]*\)".*/\1/' | \
          sed 's/-dev$//')

if [ -z "$VERSION" ]; then
    echo "Error: Could not extract version from $COMPOSER_JSON"
    exit 1
fi

echo "Syncing version: $VERSION"

# Update header file
sed -i "s/#define PHP_PAM_VERSION \".*\"/#define PHP_PAM_VERSION \"$VERSION\"/" "$HEADER_FILE"

# Verify the change
grep "PHP_PAM_VERSION" "$HEADER_FILE"
