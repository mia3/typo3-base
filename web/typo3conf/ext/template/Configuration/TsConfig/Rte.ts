/**
 * MIA3 GmbH & Co. KG
 */

 RTE {
  classes {
    highlight {
      name = highlight
      value = color: #982530;
    }
    hiddenxs {
      name = hidden-xs
      value = color: green;
    }
    hiddensm {
      name = hidden-sm
      value = color: yellow;
    }
    hiddenmd {
      name = hidden-md
      value = color: orange;
    }
    hiddenlg {
      name = hidden-lg
      value = color: red;
    }
    noparagraph {
      name = p ohne Abstand
      value = color: pink;
    }
  }
}

RTE.default {
	// custom css file
	contentCSS = typo3conf/ext/template/Resources/Public/Styles/rte.css

	// show all css-classes form RTE.css
	showTagFreeClasses = 1

	// Toolbar options
	hidePStyleItems = PRE, H5, H6, DIV, ADDRESS

	showButtons = blockstyle, textstyle, bold, italic, subscript, superscript, orderedlist, unorderedlist, outdent, indent, insertcharacter, link, unlink, removeformat, chMode, formatblock, insertcharacter, undo, redo, table, toggleborders, tableproperties, rowproperties, rowinsertabove, rowinsertunder, rowdelete, rowsplit, columninsertbefore, columninsertafter, columndelete, columnsplit, cellproperties, cellinsertbefore, cellinsertafter, celldelete, cellsplit, cellmerge
	hideButtons = blockstylelabel, findreplace, fontsize, strikethrough, lefttoright, righttoleft, textcolor, bgcolor, textindicator, inserttag, emoticon, user, spellcheck, justifyfull, acronym, copy, cut, paste, showhelp, about, left, right, center

	keepButtonGroupTogether = 1
	showStatusBar =  1
  ignoreMainStyleOverride = 1

	// ...... Markup options ......
	proc {

		// .... allow/deny tags ....
    allowTags = h1, h2, h3, h4, h5, h6, p, br, ul, ol, li, strong, em, sub, sup, strike, a, q, cite, abbr, acronym, b, i, span, table, tr, td, th, tbody, thead, tfoot
    allowTagsOutside = h1, h2, h3, h4, h5, h6, p, br, ul, ol, li, strong, em, sub, sup, strike, a, q, cite, abbr, acronym, b, i, span, table, tr, td, th, tbody, thead, tfoot
    denyTags = font, div, re, u, img, nobr, hr, tt, center
    keepPDIVattribs = class, id, itemscope, itemtype, itemprop
    allowedClasses = highlight, hiddenxs, hiddensm, hiddenmd, hiddenlg, noparagraph
		// classesCharacter = highlight, hiddenxs, hiddensm, hiddenmd, hiddenlg, noparagraph
    dontConvBRtoParagraph = 1
		transformBoldAndItalicTags = 1

		// .... html parser settings ....
		HTMLparser_rte {
			allowTags < RTE.default.proc.allowTags
			denyTags < RTE.default.proc.denyTags
      removeTags < RTE.default.proc.denyTags
      removeComments = 1
      keepNonMatchedTags = 1
		}

		// .... database settings ....
		entryHTMLparser_db = 1
		entryHTMLparser_db {
			allowTags < RTE.default.proc.allowTags
			denyTags < RTE.default.proc.denyTags
			noAttrib = h1, h2, h3, h4, h5, h6, p, b, i, u, strike, sub, sup, strong, em, quote, blockquote, cite, tt, br, center, div, font
			rmTagIfNoAttrib = span, div, font
      htmlSpecialChars = 0

      tags {
        p.fixAttrib.align.unset >
        p.allowedAttribs = class, id, itemscope, itemtype, itemprop
        div.fixAttrib.align.unset >
        div.allowedAttribs = class, id, itemscope, itemtype, itemprop
        hr.allowedAttribs = class
        span.allowedAttribs = class, id, itemscope, itemtype, itemprop
      }
		}

    HTMLparser_db.tags.span.allowedAttribs := addToList(class, id, itemscope, itemtype, itemprop)

		exitHTMLparser_db = 1
		exitHTMLparser_db {
			allowTags < RTE.default.proc.allowTags
			tags {
				b.remap = strong
				i.remap = em
			}
		}
	}

  buttons.blockstyle {
    showTagFreeClasses = 1
    tags {
      div.allowedClasses := addToList (highlight, hiddenxs, hiddensm, hiddenmd, hiddenlg)
      p.allowedClasses := addToList (highlight, hiddenxs, hiddensm, hiddenmd, hiddenlg, noparagraph)
    }
  }
  buttons.textstyle {
    showTagFreeClasses = 1
    tags.span {
      allowedClasses := addToList (highlight, hiddenxs, hiddensm, hiddenmd, hiddenlg)
      allowedAttribs := addToList (class, id, itemscope, itemtype, itemprop)
    }
  }

	# Einträge im RTE select Feld "Format"
  # zunächst eine Übersicht aller Standard Einträge:
  # address, article, aside, div, footer, header, nav, p, h1 - h6, pre, blockquote, section,
  # jetzt all das was wir nicht wollen:
  buttons.formatblock.removeItems (
      address
    , article
    , aside
    , div
    , footer
    , header
    , nav
    , h6
    , pre
    , blockquote
    , section
  )

	// .... link attributes ....
	classesAnchor = external-link, external-link-new-window, internal-link, internal-link-new-window, download, mail
	classesAnchor {
		// default classes
		default {
			page = internal-link
			url = external-link-new-window
			file = download
			mail = mail
		}

		// clean title tags
		internalLink.titleText >
		externalLink.titleText >
		download.titleText >
		mail.titleText >
	}

	// .... general options ....
	enableWordClean = 1
	removeTrailingBR = 1
	removeComments = 1
	removeTags < RTE.default.proc.denyTags
	removeTagsAndContents = style, script

	// .... use same processing as on entry to database to clean content pasted into the editor ....
	enableWordClean.HTMLparser < RTE.default.proc.entryHTMLparser_db

	// FE RTE configuration (htmlArea RTE only)
	FE < RTE.default
	FE {
		userElements >
		userLinks >
	}
}
