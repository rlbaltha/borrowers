<?xml version="1.0" ?>
<xsl:stylesheet version="1.0" 
                xmlns:xsl="http://www.w3.org/1999/XSL/Transform" 
                xmlns:fo="http://www.w3.org/1999/XSL/Format">

<xsl:template match="/">

<fo:root xmlns:fo="http://www.w3.org/1999/XSL/Format">
  <fo:layout-master-set>

     <fo:simple-page-master master-name="first"
      page-height="11in" page-width="8.5in"
      margin-top="1in" margin-bottom="1in"
      margin-left="1.0in" margin-right="1.0in"
      orphans="3">
      <fo:region-body margin-top="0.5in"/>
    </fo:simple-page-master>

  
    <fo:simple-page-master master-name="even"
      page-height="11in" page-width="8.5in"
      margin-top="1in" margin-bottom="1in"
      margin-left="1.0in" margin-right="1.0in"
      orphans="3">
        <fo:region-body margin-top="0.5in"/>
      <fo:region-before region-name="header-even" extent="1in"/>
      
    </fo:simple-page-master>
    
    <fo:simple-page-master master-name="odd"
      page-height="11in" page-width="8.5in"
      margin-top="1in" margin-bottom="1in"
      margin-left="1.0in" margin-right="1.0in"
      orphans="3">
        <fo:region-body margin-top="0.5in"/>
      <fo:region-before region-name="header-odd" extent="1in"/>
      
    </fo:simple-page-master>
    
    <fo:page-sequence-master master-name="document">
      <fo:repeatable-page-master-alternatives>
        <fo:conditional-page-master-reference odd-or-even="even" page-position="rest"
          master-reference="even"/>
        <fo:conditional-page-master-reference odd-or-even="odd" page-position="rest"
          master-reference="odd"/>
        <fo:conditional-page-master-reference page-position="first"
          master-reference="first"/>
      </fo:repeatable-page-master-alternatives>
    </fo:page-sequence-master>
  </fo:layout-master-set>
  
  <fo:page-sequence master-reference="document">
  <fo:title font-variant="small-caps">Borrowers and Lenders</fo:title>
    <fo:static-content flow-name="header-even">
      <fo:block text-align-last="start" font-family="Times" line-height="1.5em" font-variant="small-caps">
      <fo:inline>
      <fo:page-number/>
      <fo:leader leader-length='14em' leader-pattern='space'/>
      Borrowers and Lenders
      </fo:inline>
      </fo:block>
    </fo:static-content>
    <fo:static-content flow-name="header-odd">
      <fo:block text-align-last="end" font-family="Times" line-height="1.5em" font-variant="small-caps">
      <fo:inline>
      Borrowers and Lenders      
      <fo:leader leader-length='14em' leader-pattern='space'/>
      <fo:page-number/>
      </fo:inline>
      </fo:block>
    </fo:static-content>
    <fo:flow flow-name="xsl-region-body">
    
<!-- main body of text -->    
      <fo:block>
      <xsl:apply-templates/>
     </fo:block>

<!-- notes -->     

      <xsl:if test="count(//note) != 0">
      <fo:block font-family="Times" font-size='14pt' text-indent="2em" line-height="1.5em" text-align="center"  space-before.optimum="1em" space-after="0em" font-variant="small-caps">
      <xsl:text>Notes</xsl:text>
      </fo:block>
      </xsl:if>

     <xsl:for-each select='//note'>
    <fo:block font-family="Times" margin-left="1.3em" line-height="1.5em" text-align="justify" text-indent='-1.3em'>
      <xsl:number level="any"/><xsl:text>.  </xsl:text>
      <xsl:apply-templates/>
     </fo:block>
      </xsl:for-each>
      
<!--online resources section-->
    <xsl:if test="count(//onlineresourceitem) != 0">
    <fo:block font-family="Times" font-size='14pt' line-height="1.5em" space-before.optimum="1em" space-after="0em" text-align="center" font-variant="small-caps"><xsl:text>Online Resources</xsl:text></fo:block>
    <xsl:for-each select="//onlineresourceitem">
    <fo:block font-family="Times" line-height="1.5em" text-align="justify">
    <xsl:apply-templates/>
    </fo:block>
    </xsl:for-each>
    </xsl:if>
   
<!--permissions section-->
    <xsl:if test="count(//permissionsitem) != 0">
    <fo:block font-family="Times" font-size='14pt' line-height="1.5em" space-before.optimum="1em" space-after="0em" text-align="center" font-variant="small-caps"><xsl:text>Permissions</xsl:text></fo:block>
    <xsl:for-each select="//permissionsitem">
    <fo:block font-family="Times" line-height="1.5em" text-align="justify">
    <xsl:apply-templates/>
    </fo:block>
    </xsl:for-each>
    </xsl:if>   
      
<!-- references -->      
    <xsl:if test="count(//refitem) != 0">
    <fo:block font-family="Times" font-variant="small-caps" font-size='14pt' line-height="1.5em"  break-before="page" space-after="0em" text-align="center">
   <xsl:text>References</xsl:text></fo:block>
   <xsl:for-each select="//refitem">
    <fo:block font-family="Times" margin-left="3em" line-height="1.5em" text-align="justify" text-indent='-3em'>
   <xsl:apply-templates/>
    </fo:block>
   </xsl:for-each>
   </xsl:if>     
      
   

    </fo:flow>
  </fo:page-sequence>
  
    
</fo:root>
</xsl:template>

  
  
  
<!-- templates -->
  
  <xsl:template match="essayTitle">
    <fo:block font-family="Times" font-size='20pt' line-height="2em" space-before.optimum="1em" space-after="1em" text-align="center"><xsl:apply-templates/></fo:block>
  </xsl:template>
  
  <xsl:template match="revieweditem">
    <fo:block font-family="Times" font-size='16pt' line-height="2em" space-before.optimum="1em" space-after="1em" text-align="center" font-variant="small-caps"><xsl:apply-templates/></fo:block>
  </xsl:template>
 
 <xsl:template match="subTitle">
    <fo:block font-family="Times" font-size='14pt' font-variant="small-caps" line-height="1.5em" space-before.optimum="1em" space-after=".5em" text-align="center"><xsl:apply-templates/></fo:block>
  </xsl:template>
  
 <xsl:template match="byline">
    <fo:block font-family="Times" font-size='14pt' line-height="1.5em" space-before.optimum="0.5em" space-after="1em" text-align="center" font-variant="small-caps">
    <xsl:value-of select='author'/><xsl:if test="institution!=''">, <xsl:value-of select='institution'/></xsl:if>
    </fo:block>
  </xsl:template>
  

  

<xsl:template match="paragraph">
<fo:block font-family="Times" font-size='12pt' line-height="1.5em" text-align="justify">
&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;<xsl:apply-templates/>
</fo:block>
</xsl:template>

<xsl:template match="preserveSpace" name="split">
	<xsl:param name="string" select="string()"/>
	<xsl:variable name="break" select="'&#xA;'"/>
	<xsl:variable name="multiline" select="contains($string, $break)"/>
	<xsl:variable name="line">
		<xsl:choose>
		<xsl:when test="$multiline">
		<xsl:value-of select="normalize-space(substring-before($string, $break))"/>
		</xsl:when>
		<xsl:otherwise>
		<xsl:value-of select="normalize-space($string)"/>
		</xsl:otherwise>
		</xsl:choose>
	</xsl:variable>
<fo:block font-family="Times" margin-left="3em"  line-height="1.5em" text-align="left" space-before.optimum="1em" space-after=".2em">
	<xsl:if test="string($line)">
		<fo:block font-family="Times" text-indent="3em" line-height="0.5em" text-align="left">
		<xsl:value-of select="$line"/></fo:block>
	</xsl:if>
	<xsl:if test="$multiline">
		<fo:block font-family="Times" text-indent="3em" line-height="0.5em" text-align="left">
		<xsl:call-template name="split">
		<xsl:with-param name="string" select="substring-after($string, $break)"/>
		</xsl:call-template>
		</fo:block>
	</xsl:if>
</fo:block>
</xsl:template>



<xsl:template match="abstract/paragraph">
<fo:block font-family="Times" font-size='10pt' line-height="1.5em" text-align="justify" margin-left="3em" margin-right="3em">
<xsl:apply-templates/>
</fo:block>
</xsl:template>

<xsl:template match="epigraph">
<fo:block font-family="Times" font-size='10pt' line-height="1.5em" text-align="justify" margin-left="3em" margin-right="3em" font-style='italic' space-after="2em">
<xsl:apply-templates/>
</fo:block>
</xsl:template>

<xsl:template match="abstract">
<fo:block><fo:leader leader-pattern='rule' leader-length='100%' rule-style='solid'/></fo:block>

<fo:block font-family="Times" font-size='14pt' line-height="1.5em" space-before.optimum="0.5em" space-after="0.5em" text-align="center"  font-variant="small-caps">Abstract</fo:block>

<fo:block font-family="Times"  font-size='10pt'  line-height="1.1em" text-align="justify" space-before.optimum="1em" space-after="0em">
<xsl:apply-templates/>
</fo:block>
<fo:block space-after="2em"><fo:leader leader-pattern='rule' leader-length='100%' rule-style='solid'/></fo:block>
</xsl:template>


<xsl:template match="blockQuote">
<fo:block font-family="Times" margin-left="3em"  line-height="1.5em" text-align="justify" space-before.optimum="1em" space-after="1em">
<xsl:apply-templates/>
<xsl:if test="@pageNumber!='' or @lineNumber!=''">
 <xsl:text> (</xsl:text>
 <xsl:if test="@source!=''">
 <i><xsl:value-of select="@source"/></i><xsl:text> </xsl:text>
 </xsl:if>
 <xsl:value-of select="@pageNumber"/><xsl:value-of select="@lineNumber"/><xsl:text>)</xsl:text>
</xsl:if>
</fo:block>
</xsl:template>

<xsl:template match="indent"> 
 <fo:inline margin-left="1em"></fo:inline>
</xsl:template>

<xsl:template match="poem">
<fo:block font-family="Times" text-indent="10em" line-height="1.5em" text-align="justify">
<xsl:apply-templates/>
</fo:block>
</xsl:template> 

<xsl:template match="note"> 
 <fo:inline vertical-align="super" font-size='8pt'><xsl:number level="any"/></fo:inline>
</xsl:template>


<xsl:template match="refitem/link">
  <xsl:apply-templates/>
</xsl:template>

<xsl:template match="onlineresourceitem/link">
  <xsl:text> </xsl:text> <xsl:apply-templates/>
</xsl:template>

<xsl:template match="titleOfLongWork">
 <fo:inline font-style="italic"><xsl:apply-templates/></fo:inline>
</xsl:template>

<xsl:template match="refitem/titleOfLongWork">
 <xsl:text> </xsl:text><fo:inline font-style="italic"><xsl:apply-templates/></fo:inline>
</xsl:template>

<xsl:template match="soundClip">
 <fo:inline font-style="italic">(A sound clip is available in the HTML version of this document.)</fo:inline>
</xsl:template>


<xsl:template match="filmClip">
 <fo:inline font-style="italic">(A film clip is available in the HTML version of this document.)</fo:inline>
</xsl:template>


<xsl:template match="foreignWord">
 <fo:inline font-style="italic"><xsl:apply-templates/></fo:inline>
</xsl:template>

<xsl:template match="emphasis">
 <fo:inline font-style="italic"><xsl:apply-templates/></fo:inline>
</xsl:template>

<xsl:template match="underline">
 <fo:inline text-decoration="underline"><xsl:apply-templates/></fo:inline>
</xsl:template>

<xsl:template match="titleOfShortWork">
 "<xsl:apply-templates/>"
</xsl:template>


<xsl:template match="stanza">
<fo:block space-after="1em">
 <xsl:apply-templates/>
 </fo:block>
</xsl:template>

<xsl:template match="line">
<fo:block font-family="Times" text-indent="3em" line-height="1.5em" text-align="justify">
 <xsl:apply-templates/>
 <xsl:if test='position()=last()'>
<xsl:if test="@pageNumber!='' or @lineNumber!=''">
 <xsl:text> (</xsl:text>
 <xsl:if test="@source!=''">
 <fo:inline font-style="italic"><xsl:value-of select="@source"/></fo:inline><xsl:text> </xsl:text>
 </xsl:if>
 <xsl:value-of select="@pageNumber"/><xsl:value-of select="@lineNumber"/><xsl:text>)</xsl:text>
</xsl:if>
 </xsl:if>
 </fo:block>
</xsl:template>

<xsl:template match="inlineQuote">
<xsl:apply-templates/>
 <xsl:if test="@pageNumber!='' or @lineNumber!=''">
 <xsl:text> (</xsl:text>
 <xsl:if test="@source!=''">
 <fo:inline font-style="italic"><xsl:value-of select="@source"/></fo:inline><xsl:text> </xsl:text>
 </xsl:if>
 <xsl:value-of select="@pageNumber"/><xsl:value-of select="@lineNumber"/><xsl:text>)</xsl:text>
</xsl:if>
</xsl:template>

<!-- old broken fo list 
<xsl:template match="list">
<fo:block font-family="Times" margin-left="3em"  line-height="1.5em" text-align="justify" space-before.optimum="1em" space-after="1em">
<xsl:choose>
 <xsl:when test="@type='numbered'">
 	<fo:list-block >
	<xsl:apply-templates/>
	</fo:list-block>
 </xsl:when>
 <xsl:when test="@type='bulleted'">
 	<fo:list-block >
	<xsl:apply-templates/>
	</fo:list-block>
 </xsl:when>
</xsl:choose>
</fo:block>
</xsl:template>


<xsl:template match="listItem">
        <fo:list-item>
            	<fo:list-item-label end-indent="label-end()" >
                <fo:block>
		<xsl:choose>
		<xsl:when test="../@type='numbered'">
		<xsl:value-of select="position()"/><xsl:text>. </xsl:text>
		</xsl:when>
		<xsl:when test="../@type='bulleted'">
		<xsl:text>&#183; </xsl:text>
		</xsl:when>
		</xsl:choose>
		</fo:block>
		</fo:list-item-label>
		<fo:list-item-body start-indent="body-start()" >
                <fo:block>
                    <xsl:apply-templates/>
                </fo:block>
            </fo:list-item-body>
	</fo:list-item>
</xsl:template>
-->

<xsl:template match="list">
<fo:block font-family="Times" margin-left="3em"  line-height="1.5em" text-align="left" space-before.optimum="1em" space-after="1em">
<xsl:apply-templates/>
</fo:block>
</xsl:template>

<xsl:template match="listItem">
              <fo:block>
		<xsl:choose>
		<xsl:when test="../@type='numbered'">
		<xsl:value-of select="position()"/><xsl:text>. </xsl:text>
		</xsl:when>
		<xsl:when test="../@type='bulleted'">
		<xsl:text>&#183; </xsl:text>
		</xsl:when>
		</xsl:choose>
                <xsl:apply-templates/>
             </fo:block>
</xsl:template>



<xsl:template match="table">
<xsl:variable name="columns">
<xsl:value-of select="count(row/column) div count(row)"/>
</xsl:variable>

<fo:table border="0.5pt solid black"
          text-align="left"
          border-spacing="3pt"
	  space-before.optimum="1em"
	  space-after="1em" 
	  width="6in"
	  >
  <fo:table-column number-columns-repeated="{$columns}"/>
  <fo:table-body>
  <xsl:apply-templates/>
  </fo:table-body>
</fo:table>
<fo:block text-align="center"><fo:inline font-style="italic"><xsl:value-of select="@caption"/></fo:inline></fo:block>
</xsl:template>

<xsl:template match="row">
    <fo:table-row>
    <xsl:apply-templates/>
    </fo:table-row>
</xsl:template>

<xsl:template match="column">
      <fo:table-cell padding="3pt" border="0.5pt solid black">
        <fo:block><xsl:apply-templates/></fo:block>
      </fo:table-cell>
</xsl:template>

<!-- for images that we want to display in the pdf -->
<xsl:template match="image[@type='pdf']">
<fo:table table-layout="fixed" width="100%"  text-align="{@align}">
  <fo:table-column column-width="proportional-column-width(1)"/>
  <fo:table-body>
    <fo:table-row keep-with-next="always">
      <fo:table-cell>
        <fo:block>
	<xsl:choose>
	<xsl:when test="@uri!=''">
	<fo:external-graphic src="url({@uri})" width="200px"/>
	</xsl:when>
	<xsl:otherwise>
	<fo:external-graphic src="url({.})" width="200px"/>
	</xsl:otherwise>
	</xsl:choose>
        </fo:block>
      </fo:table-cell>
    </fo:table-row>
    <fo:table-row>
      <fo:table-cell>
        <fo:block><xsl:value-of select="@caption"/></fo:block>
      </fo:table-cell>
    </fo:table-row>
  </fo:table-body>
</fo:table>
</xsl:template>

<xsl:template match="symbol[@role = 'symbolfont']">
  <fo:inline font-family="Symbol" margin-right="2px">
    <xsl:apply-templates/>
  </fo:inline>
</xsl:template>

<xsl:template match="pdfReplace">
    <xsl:value-of select="@replace"/>
</xsl:template>

<xsl:template match="pdfReplaceWithImage">
    <fo:external-graphic src="url({@uri})" width="{@width}"/>
</xsl:template>


<xsl:template match="comment"/>
<xsl:template match="error"/>   
<xsl:template match="image"/>  
<xsl:template match="admin"/>  
<xsl:template match="onlineresources"/>
<xsl:template match="permissions"/>
<xsl:template match="references"/>
</xsl:stylesheet>
