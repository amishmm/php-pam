#!/bin/bash
# Generate pam_version.h from composer.json
# Run automatically via Makefile before build

set -e

COMPOSER_JSON="composer.json"
VERSION_HEADER="pam_version.h"

if [ ! -f "$COMPOSER_JSON" ]; then
    echo "Error: $COMPOSER_JSON not found"
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

echo "Generating version header: $VERSION"

# Generate version header
cat > "$VERSION_HEADER" <<EOF
/* Generated from composer.json by scripts/sync-version.sh
 * DO NOT EDIT - This file is auto-generated during build */

#ifndef PAM_VERSION_H
#define PAM_VERSION_H

#define PHP_PAM_VERSION "$VERSION"

#endif /* PAM_VERSION_H */
EOF

# Verify the generated file
grep "PHP_PAM_VERSION" "$VERSION_HEADER"
