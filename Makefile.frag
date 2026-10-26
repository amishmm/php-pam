# Makefile fragment for PAM extension
# Auto-included by phpize-generated Makefile

# Generate version header before compiling source
pam.lo: pam_version.h

pam_version.h:
	@bash $(top_srcdir)/scripts/sync-version.sh
