###########################################################
#	Backend Configuration
###########################################################

#----------------------------------------------------------
#	Set some useful defaults for new content elements
#----------------------------------------------------------
TCAdefaults{
	tt_content {
		header_layout = 2
	}
}

#----------------------------------------------------------
#	Remove some "useless" fields
#----------------------------------------------------------
#TCEFORM{
#	pages_language_overlay{
#		author.disabled = 1
#	}
#}

#----------------------------------------------------------
#	Page module
#----------------------------------------------------------
mod {
	# Show the content element wizard with tabs
	wizards.newContentElement.renderMode = tabs

	# Default flag
	SHARED {
		defaultLanguageLabel = DE
		defaultLanguageFlag = de.gif
	}
}

#----------------------------------------------------------
#	Content elements
#----------------------------------------------------------
TCEFORM.tt_content {
	header_layout {
		altLabels {
			1 = LLL:EXT:template/Resources/Private/Language/locallang_be.xml:tt_content.header_layout.1
			2 = LLL:EXT:template/Resources/Private/Language/locallang_be.xml:tt_content.header_layout.2
			3 = LLL:EXT:template/Resources/Private/Language/locallang_be.xml:tt_content.header_layout.3
			4 = LLL:EXT:template/Resources/Private/Language/locallang_be.xml:tt_content.header_layout.4
			5 = LLL:EXT:template/Resources/Private/Language/locallang_be.xml:tt_content.header_layout.5
		}
	}

	# Change layouts
	layout {
		removeItems = 1,2,3
		addItems {
			22 = LLL:EXT:template/Resources/Private/Language/locallang_be.xml:tt_content.layout.striped
			24 = LLL:EXT:template/Resources/Private/Language/locallang_be.xml:tt_content.layout.box-solo
			26 = LLL:EXT:template/Resources/Private/Language/locallang_be.xml:tt_content.layout.box-white-solo
			28 = LLL:EXT:template/Resources/Private/Language/locallang_be.xml:tt_content.layout.box-black-solo
			30 = LLL:EXT:template/Resources/Private/Language/locallang_be.xml:tt_content.layout.box-red-solo
			32 = LLL:EXT:template/Resources/Private/Language/locallang_be.xml:tt_content.layout.box-blue-solo
			34 = LLL:EXT:template/Resources/Private/Language/locallang_be.xml:tt_content.layout.box-gray-solo
			36 = LLL:EXT:template/Resources/Private/Language/locallang_be.xml:tt_content.layout.box-darkgray-solo
			40 = LLL:EXT:template/Resources/Private/Language/locallang_be.xml:tt_content.layout.red-overlapping
			41 = LLL:EXT:template/Resources/Private/Language/locallang_be.xml:tt_content.layout.red
		}
	}
}

tx_news.templateLayouts {
    Newsticker = Newsticker
}

#----------------------------------------------------------
#	Permissions for new Pages
#----------------------------------------------------------
TCEMAIN {
	permissions.userid = 1
	permissions.groupid = 1
	user = show,edit,delete,new,editcontent
	group = show,edit,delete,new,editcontent
	everybody show,edit,delete,new,editcontent
}
