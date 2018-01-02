config {
	### Language and locallization

	# this must be set to the language of the site
	language = de
	metaCharset = utf-8

	# make sure to set this to the language your site is in
	locale_all = de_DE
	htmlTag_langKey = de

	# Sets the default system language
	sys_language_uid = 0

	# How to handle locallization
	sys_language_mode = content_fallback

	# Records that are not locallized till be hidden
	sys_language_overlay = hideNonTranslated

	# Setting up the language variable "L" to be passed along with links
	config.linkVars = L
}

[globalVar = GP:L=1]
	config {
		language = en
		locale_all = en_GB.utf8
		htmlTag_langKey = en
		sys_language_uid = 1
	}
[global]
