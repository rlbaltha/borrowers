<?xml version="1.0"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:strip-space elements="*"/>
<xsl:param name="pipeline"/>
<xsl:variable name='path'><xsl:if test="$pipeline='preview_toc'">../production/</xsl:if></xsl:variable>
<xsl:include href="leftbar.xsl"/>
<xsl:include href="about_text.xsl"/>
<xsl:variable name="current_page"><xsl:text>about</xsl:text></xsl:variable>
<xsl:template match="/">

<html>
<head>
<title>Borrowers and Lenders:  The Journal of Shakespeare and Appropriation</title>
<link href="/bundles/borrowershome/css/bandl5.css" type="text/css" rel="stylesheet"/>
<script type="text/javascript" src="/bundles/borrowershome/js/nav.js"/>
<script type="text/javascript" src="/bundles/borrowershome/js/overlib.js">
<!-- overLIB (c) Erik Bosrup -->
</script>
</head>
<body>


<!-- header table -->
<table cellpadding='0' cellspacing='0'>

<!-- header row -->
<tr>
<td class='header' height='150px'/>
</tr>

<!-- body row -->
<tr>
<td>

<!-- body table -->
<table cellpadding='0' cellspacing='0'>
<tr>
<td class='leftside' width='150px' valign='top'>
<xsl:call-template name="leftbar"/>
</td>

<!-- body cell -->
<td valign='top' class='textarea'>
<img src='/bundles/borrowershome/bodyspacer.gif'/>

<xsl:call-template name="about_text"/>


</td>

<td class='rightside' width='330px'/>
</tr>
</table>

<!--close body row-->
</td>
</tr>

<!--footer row-->
<tr>
<td class='footer' height='180px'/>
</tr>
</table>


</body>
</html>

</xsl:template>



</xsl:stylesheet>
