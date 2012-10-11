<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

	
      <!-- identity template -->
        <xsl:template match="/">
        <pdf>
         <dynamic-page>
        <xsl:apply-templates/>
        </dynamic-page>
         </pdf>
        </xsl:template>  
        
        

</xsl:stylesheet>