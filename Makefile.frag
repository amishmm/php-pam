# Makefile fragment for PAM extension
# Auto-included by phpize-generated Makefile

# Sync version from composer.json before building
$(all_targets): sync-version

.PHONY: sync-version
sync-version:
	@if [ -f scripts/sync-version.sh ]; then \
		bash scripts/sync-version.sh; \
	fi
