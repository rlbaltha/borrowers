<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
     xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template name="leftbar">
<!-- nav bar table-->
<table cellpadding='0' cellspacing='0'>
<tr>
<td class='nav01' width='150px' height='58px'>
<a href="{$path}current_issue" onMouseOver="imageSwap('a','a2','Index')" onMouseOut="imageSwap('a','a1','Borrowers and Lenders')"><img name="a" src="/borrowers/web/bundles/borrowershome/img/current_issue_off.jpg" border="0" width='150px' height="58px"/></a>
</td>
</tr>
<tr>
<td class='nav02' width='150px' height='54px'>

<a href="{$path}previous_issue" onMouseOver="imageSwap('b','b2','Index')" onMouseOut="imageSwap('b','b1','Borrowers and Lenders')"><img name="b" src="/borrowers/web/bundles/borrowershome/img/previous_issue_off.jpg" border="0" width='150px' height="54px"/></a>

<a href="{$path}about" onMouseOver="imageSwap('e','e2','Index')" onMouseOut="imageSwap('e','e1','Borrowers and Lenders')"><img name="e" src="/borrowers/web/bundles/borrowershome/img/b5-off-book-d2.jpg" border="0" width='150px' height="36px"/></a> 
</td>
</tr>
<tr>
<td class='nav03' width='150px' height='36px'>

<a href="{$path}archive" onMouseOver="imageSwap('c','c2','Index')" onMouseOut="imageSwap('c','c1','Borrowers and Lenders')"><img name="c" src="/borrowers/web/bundles/borrowershome/img/archive-off.jpg" border="0" width='150px' height="36px"/></a>

<!--  
<a href="" onMouseOver="imageSwap('f','f2','Index')" onMouseOut="imageSwap('f','f1','Borrowers and Lenders')"><img name="f" src="/borrowers/web/bundles/borrowershome/img/b6-off-book-d2.jpg" border="0" width='150px' height="36px"/></a>
</td>
</tr>
<tr>
<td class='nav04' width='150px' height='36px'>
-->
<!--
<a href="" onMouseOver="imageSwap('d','d2','Index')" onMouseOut="imageSwap('d','d1','Borrowers and Lenders')"><img name="d" src="/borrowers/web/bundles/borrowershome/img/b4-off-book-d2.jpg" border="0" width='150px' height="36px"/></a>
-->
</td>
</tr>
<tr>
<td class='nav05' width='150px' height='36px'>
<!-- 
<a href="" onMouseOver="imageSwap('e','e2','Index')" onMouseOut="imageSwap('e','e1','Borrowers and Lenders')"><img name="e" src="/borrowers/web/bundles/borrowershome/img/b5-off-book-d2.jpg" border="0" width='150px' height="36px"/></a> 
-->
</td>
</tr>
<tr>
<td class='nav06' width='150px' height='36px'>
<!-- 
<a href="" onMouseOver="imageSwap('f','f2','Index')" onMouseOut="imageSwap('f','f1','Borrowers and Lenders')"><img name="f" src="/borrowers/web/bundles/borrowershome/img/b6-off-book-d2.jpg" border="0" width='150px' height="36px"/></a>
-->
</td>
</tr>
</table>

</xsl:template>
</xsl:stylesheet>


