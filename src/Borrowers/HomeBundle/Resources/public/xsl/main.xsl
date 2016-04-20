<?xml version="1.0"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:strip-space elements="*"/>

    <xsl:template match="/">

        <html>
            <xsl:for-each select='body/essayTitle'>
                <p class='essaytitle'>
                    <xsl:apply-templates/>
                </p>
            </xsl:for-each>

            <xsl:for-each select='body/byline'>
                <p class='title'>
                    <xsl:apply-templates/>
                </p>
            </xsl:for-each>


            <!-- navigation section -->
            <hr/>
            <p class='nav'>
                <xsl:if test="count(//abstract) != 0">
                    <a href='#abstract'>
                        <xsl:text>Abstract | </xsl:text>
                    </a>
                </xsl:if>
                <xsl:for-each select="//subTitle">
                    <xsl:variable name='subtitle'>
                        <xsl:text>#subtitle</xsl:text>
                        <xsl:number level="any"/>
                    </xsl:variable>
                    <a href='{$subtitle}'>
                        <xsl:apply-templates/>
                    </a>

                    <xsl:if test="position()!=last() or (count(//note) != 0 or count(//refitem) != 0)">
                        <xsl:text> | </xsl:text>
                    </xsl:if>
                </xsl:for-each>
                <xsl:if test="count(//note) != 0">
                    <a href='#notes'>
                        <xsl:text>Notes </xsl:text>
                    </a>
                    <xsl:if test="count(//refitem) != 0">
                        <xsl:text> | </xsl:text>
                    </xsl:if>
                </xsl:if>

                <xsl:if test="count(//refitem) != 0">
                    <a href='#references'>
                        <xsl:text>References </xsl:text>
                    </a>
                </xsl:if>

                <xsl:if test="count(//onlineresourceitem) != 0">
                    <xsl:text> | </xsl:text>
                    <a href='#onlineresources'>
                        <xsl:text>Online Resources </xsl:text>
                    </a>
                </xsl:if>
            </p>
            <!-- end of navigation -->

            <!-- abstract -->
            <xsl:for-each select='body/abstract'>
                <hr/>
                <a name='abstract'/>
                <p class='title'>
                    <xsl:text>Abstract</xsl:text>
                </p>
                <xsl:apply-templates/>
                <hr/>
            </xsl:for-each>

            <!-- epigraph -->
            <xsl:for-each select='body/epigraph'>
                <br/>
                <a name='epigraph'/>
                <p class='epigraph'>
                    <i>
                        <xsl:apply-templates/>
                    </i>
                </p>
            </xsl:for-each>


            <br/>


            <!-- main template call -->
            <xsl:apply-templates/>


            <!-- endnotes -->
            <br/>
            <br/>

            <xsl:if test="count(//note) != 0">
                <a name='notes'/>
                <p class='title'>
                    <xsl:text>Notes</xsl:text>
                </p>
            </xsl:if>
            <xsl:for-each select='//note'>
                <xsl:variable name='notetext'>
                    <xsl:text>n</xsl:text>
                    <xsl:number level="any"/>
                </xsl:variable>
                <xsl:variable name='notereturn'>
                    <xsl:text>#nr</xsl:text>
                    <xsl:number level="any"/>
                </xsl:variable>
                <a name='{$notetext}'/>
                <table>
                    <tr>
                        <td valign='top'>
                            <a href='{$notereturn}'>
                                <xsl:number level="any"/>
                                <xsl:text>.&#160;&#160;  </xsl:text>
                            </a>
                        </td>
                        <td>
                            <xsl:apply-templates/>
                        </td>
                    </tr>
                </table>
            </xsl:for-each>


            <!--references section-->
            <xsl:for-each select='body/references'>
                <xsl:if test="count(refitem) != 0">
                    <br/>
                    <br/>
                    <a name='references'/>
                    <p class='title'>
                        <xsl:text>References</xsl:text>
                    </p>
                    <xsl:apply-templates/>
                </xsl:if>
            </xsl:for-each>


            <!--online resources section-->
            <xsl:for-each select='body/onlineresources'>
                <xsl:if test="count(onlineresourceitem) != 0">
                    <br/>
                    <a name='onlineresources'/>
                    <p class='title'>
                        <xsl:text>Online Resources</xsl:text>
                    </p>
                    <xsl:apply-templates/>
                </xsl:if>
            </xsl:for-each>

            <!--permissions section-->
            <xsl:for-each select='body/permissions'>
                <xsl:if test="count(permissionsitem) != 0">
                    <br/>
                    <p class='title'>
                        <xsl:text>Permissions</xsl:text>
                    </p>
                    <xsl:apply-templates/>
                </xsl:if>
            </xsl:for-each>


            <!--navigation section-->
            <hr/>
            <p class='nav'>
                <xsl:if test="count(//abstract) != 0">
                    <a href='#abstract'>
                        <xsl:text>Abstract | </xsl:text>
                    </a>
                </xsl:if>
                <xsl:for-each select="//subTitle">
                    <xsl:variable name='subtitle'>
                        <xsl:text>#subtitle</xsl:text>
                        <xsl:number level="any"/>
                    </xsl:variable>
                    <a href='{$subtitle}'>
                        <xsl:apply-templates/>
                    </a>

                    <xsl:if test="position()!=last() or (count(//note) != 0 or count(//refitem) != 0)">
                        <xsl:text> | </xsl:text>
                    </xsl:if>
                </xsl:for-each>
                <xsl:if test="count(//note) != 0">
                    <a href='#notes'>
                        <xsl:text>Notes </xsl:text>
                    </a>
                    <xsl:if test="count(//refitem) != 0">
                        <xsl:text> | </xsl:text>
                    </xsl:if>
                </xsl:if>

                <xsl:if test="count(//refitem) != 0">
                    <a href='#references'>
                        <xsl:text>References </xsl:text>
                    </a>
                </xsl:if>

                <xsl:if test="count(//onlineresourceitem) != 0">
                    <xsl:text> | </xsl:text>
                    <a href='#onlineresources'>
                        <xsl:text>Online Resources </xsl:text>
                    </a>
                </xsl:if>

                <xsl:text> | </xsl:text>
                <a href='#top'>
                    <xsl:text>Top </xsl:text>
                </a>
            </p>
            <hr/>
            <!-- end of navigation -->

            <!--citation section-->
            <br/>
            <br/>
            <p class='footer'>
                <xsl:for-each select='body/citation'>
                    <xsl:apply-templates/>
                </xsl:for-each>
                <br/>
            </p>

        </html>
    </xsl:template>


    <!-- templates -->
    <xsl:template match="background"/>
    <xsl:template match="comment"/>
    <xsl:template match="error"/>
    <xsl:template match="admin"/>
    <xsl:template match="citation"/>
    <xsl:template match="abstract"/>
    <xsl:template match="essayTitle"/>
    <xsl:template match="byline"/>
    <xsl:template match="onlineresources"/>
    <xsl:template match="permissions"/>
    <xsl:template match="epigraph"/>
    <!--
    <xsl:template match="essayTitle">
     <p class='title'><xsl:apply-templates/></p>
    </xsl:template>

    <xsl:template match="byline">
     <p class='title'><xsl:apply-templates/></p>
    </xsl:template>


     -->

    <xsl:template match="subTitle">
        <xsl:variable name='subTitleText'>
            <xsl:text>subtitle</xsl:text>
            <xsl:number level="any"/>
        </xsl:variable>
        <a name='{$subTitleText}'/>
        <p class='title'>
            <a href="#top">
                <xsl:apply-templates/>
            </a>
        </p>

    </xsl:template>


    <xsl:template match="author">
        <xsl:apply-templates/>
    </xsl:template>

    <xsl:template match="institution">
        <xsl:text>, </xsl:text>
        <xsl:apply-templates/>
    </xsl:template>

    <xsl:template match="references"/>

    <xsl:template match="paragraph">
        <xsl:choose>
            <xsl:when test="name(parent::node()) ='abstract'">
                <p class="abstract">
                    <xsl:apply-templates/>
                </p>
            </xsl:when>
            <xsl:otherwise>

                <div class="body">
                    <xsl:apply-templates/>
                </div>
            </xsl:otherwise>
        </xsl:choose>

    </xsl:template>


    <!-- note hack here for server migration -->
    <xsl:template match="image">
        <xsl:variable name="uri">
            <xsl:choose>
                <xsl:when test="substring-after(@uri, 'http://') = 'atropos'">
                    <xsl:text></xsl:text><xsl:value-of select="substring-after(@uri, 'atropos.english.uga.edu')"/>
                </xsl:when>
                <xsl:when test="substring-after(@uri, 'http://') = 'klotho'">
                    <xsl:text></xsl:text><xsl:value-of select="substring-after(@uri, 'klotho.english.uga.edu')"/>
                </xsl:when>
                <xsl:when test="substring-after(@uri, 'http://') = 'bandl'">
                    <xsl:text></xsl:text><xsl:value-of select="substring-after(@uri, 'bandl.english.uga.edu')"/>
                </xsl:when>
                <xsl:otherwise>
                    <xsl:value-of select="@uri"/>
                </xsl:otherwise>
            </xsl:choose>
        </xsl:variable>
        <xsl:variable name="src">
            <xsl:choose>
                <xsl:when test="contains(., 'atropos')">
                    <xsl:text></xsl:text><xsl:value-of select="substring-after(., 'atropos.english.uga.edu')"/>
                </xsl:when>
                <xsl:when test="contains(., 'klotho')">
                    <xsl:text></xsl:text><xsl:value-of select="substring-after(., 'klotho.english.uga.edu')"/>
                </xsl:when>
                <xsl:when test="contains(., 'bandl')">
                    <xsl:text></xsl:text><xsl:value-of select="substring-after(., 'bandl.english.uga.edu')"/>
                </xsl:when>
                <xsl:otherwise>
                    <xsl:value-of select="."/>
                </xsl:otherwise>
            </xsl:choose>
        </xsl:variable>
        <table align="{@align}">
            <tr>
                <td style="padding:20px">
                    <xsl:choose>
                        <xsl:when test="$uri!=''">
                            <img src="{$uri}"/>
                        </xsl:when>
                        <xsl:otherwise>
                            <img src="{$src}" alt="{@caption}" title="{@caption}"/>
                        </xsl:otherwise>
                    </xsl:choose>
                </td>
            </tr>
            <tr>
                <td align="{@align}" style="padding-bottom:10px">
                    <i>
                        <xsl:value-of select="@caption"/>
                    </i>
                </td>
            </tr>
        </table>
    </xsl:template>

    <xsl:template match="paragraph/blockQuote">
        <xsl:variable name='citation'>
            <xsl:if test="@pageNumber!='' or @lineNumber!=''">
                <xsl:text> (</xsl:text>
                <xsl:if test="@source!=''">
                    <i>
                        <xsl:value-of select="@source"/>
                    </i>
                    <xsl:text> </xsl:text>
                </xsl:if>
                <xsl:value-of select="@pageNumber"/><xsl:value-of select="@lineNumber"/><xsl:text>) </xsl:text>
            </xsl:if>
        </xsl:variable>
        <xsl:variable name="refid">
            <xsl:value-of select='@refid'/>
        </xsl:variable>
        <xsl:variable name='source'>
            <xsl:value-of select="../../references/refitem[@refid=$refid]"/>
        </xsl:variable>

        <xsl:choose>
            <xsl:when test='count(line) != 0'>
                <table class='verse'>
                    <tr>
                        <td>
                            <a class='wc' href="#{@refid}" data-container="body" data-toggle="popover" data-placement="right" data-content="{$source}"
                               data-trigger="hover">
                                <xsl:apply-templates/>
                            </a>
                            <xsl:value-of select='$citation'/>
                        </td>
                    </tr>
                </table>
            </xsl:when>
            <xsl:otherwise>
                <table class='quote'>
                    <tr>
                        <td>
                            <a class='wc' href="#{@refid}" data-container="body" data-toggle="popover" data-placement="right" data-content="{$source}"
                               data-trigger="hover">
                                <xsl:apply-templates/>
                            </a>
                            <xsl:value-of select='$citation'/>
                        </td>
                    </tr>
                </table>
            </xsl:otherwise>
        </xsl:choose>


    </xsl:template>

    <xsl:template match="note/blockQuote">
        <xsl:variable name='citation'>
            <xsl:if test="@pageNumber!='' or @lineNumber!=''">
                <xsl:text> (</xsl:text>
                <xsl:if test="@source!=''">
                    <i>
                        <xsl:value-of select="@source"/>
                    </i>
                    <xsl:text> </xsl:text>
                </xsl:if>
                <xsl:value-of select="@pageNumber"/><xsl:value-of select="@lineNumber"/><xsl:text>) </xsl:text>
            </xsl:if>
        </xsl:variable>
        <xsl:variable name="refid">
            <xsl:value-of select='@refid'/>
        </xsl:variable>
        <xsl:variable name='source'>
            <xsl:value-of select="/body/references/refitem[@refid=$refid]"/>
        </xsl:variable>

        <xsl:choose>
            <xsl:when test='count(line) != 0'>
                <table class='verse'>
                    <tr>
                        <td>
                            <a class='wc' href="#{@refid}" data-container="body" data-toggle="popover" data-placement="right" data-content="{$source}"
                               data-trigger="hover">
                                <xsl:apply-templates/>
                            </a>
                        </td>
                    </tr>
                </table>
            </xsl:when>
            <xsl:otherwise>
                <table class='quote'>
                    <tr>
                        <td>
                            <a class='wc' href="#{@refid}" data-container="body" data-toggle="popover" data-placement="right" data-content="{$source}"
                               data-trigger="hover">
                                <xsl:apply-templates/>
                            </a>
                        </td>
                    </tr>
                </table>
            </xsl:otherwise>
        </xsl:choose>
    </xsl:template>

    <xsl:template match="note/inlineQuote">
        <xsl:variable name='citation'>
            <xsl:if test="@pageNumber!='' or @lineNumber!=''">
                <xsl:text> (</xsl:text>
                <xsl:if test="@source!=''">
                    <i>
                        <xsl:value-of select="@source"/>
                    </i>
                    <xsl:text> </xsl:text>
                </xsl:if>
                <xsl:value-of select="@pageNumber"/><xsl:value-of select="@lineNumber"/><xsl:text>)</xsl:text>
            </xsl:if>
        </xsl:variable>
        <xsl:variable name="refid">
            <xsl:value-of select='@refid'/>
        </xsl:variable>
        <xsl:variable name='source'>
            <xsl:value-of select="/body/references/refitem[@refid=$refid]"/>
        </xsl:variable>


        <a class='wc' href="#{@refid}" data-container="body" data-toggle="popover" data-placement="right" data-content="{$source}" data-trigger="hover">
            <xsl:apply-templates/>
        </a>
    </xsl:template>

    <xsl:template match="paragraph/blockQuote/note/inlineQuote">
        <xsl:variable name='citation'>
            <xsl:if test="@pageNumber!='' or @lineNumber!=''">
                <xsl:text> (</xsl:text>
                <xsl:if test="@source!=''">
                    <i>
                        <xsl:value-of select="@source"/>
                    </i>
                    <xsl:text> </xsl:text>
                </xsl:if>
                <xsl:value-of select="@pageNumber"/><xsl:value-of select="@lineNumber"/><xsl:text>)</xsl:text>
            </xsl:if>
        </xsl:variable>
        <xsl:variable name="refid">
            <xsl:value-of select='@refid'/>
        </xsl:variable>
        <xsl:variable name='source'>
            <xsl:value-of select="/body/references/refitem[@refid=$refid]"/>
        </xsl:variable>


        <a class='wc' href="#{@refid}" data-container="body" data-toggle="popover" data-placement="right" data-content="{$source}" data-trigger="hover">
            <xsl:apply-templates/>
        </a>
    </xsl:template>


    <xsl:template match="paragraph/inlineQuote">
        <xsl:variable name='citation'>
            <xsl:if test="@pageNumber!='' or @lineNumber!=''">
                <xsl:text> (</xsl:text>
                <xsl:if test="@source!=''">
                    <i>
                        <xsl:value-of select="@source"/>
                    </i>
                    <xsl:text> </xsl:text>
                </xsl:if>
                <xsl:value-of select="@pageNumber"/><xsl:value-of select="@lineNumber"/><xsl:text>)</xsl:text>
            </xsl:if>
        </xsl:variable>
        <xsl:variable name="refid">
            <xsl:value-of select='@refid'/>
        </xsl:variable>
        <xsl:variable name='source'>
            <xsl:value-of select="/body/references/refitem[@refid=$refid]"/>
        </xsl:variable>


        <a class='wc' href="#{@refid}" data-container="body" data-toggle="popover" data-placement="right" data-content="{$source}" data-trigger="hover">
            <xsl:apply-templates/>
        </a>
    </xsl:template>

    <xsl:template match="refitem">
        <a name="{@refid}"/>
        <p class="wc">
            <xsl:apply-templates/>
        </p>
    </xsl:template>

    <xsl:template match="onlineresourceitem">
        <p class="or">
            <xsl:apply-templates/>
        </p>
    </xsl:template>

    <xsl:template match="permissionsitem">
        <p class="or">
            <xsl:apply-templates/>
        </p>
    </xsl:template>

    <xsl:template match="sentence">
        <xsl:apply-templates/>
    </xsl:template>

    <xsl:template match="foreignWord">
        <i>
            <xsl:apply-templates/>
        </i>
    </xsl:template>

    <xsl:template match="note">
        <xsl:variable name='note'>
            <xsl:text>#n</xsl:text>
            <xsl:number level="any"/>
        </xsl:variable>
        <xsl:variable name='notereturn'>
            <xsl:text>nr</xsl:text>
            <xsl:number level="any"/>
        </xsl:variable>
        <a href='{$note}'>
            <sup>
                <b>
                    <xsl:number level="any"/>
                    <a name='{$notereturn}'/>
                </b>
            </sup>
        </a>
    </xsl:template>

    <xsl:template match="emphasis">
        <i>
            <xsl:apply-templates/>
        </i>
    </xsl:template>

    <xsl:template match="list">
        <xsl:choose>
            <xsl:when test="@type='numbered'">
                <ol>
                    <xsl:apply-templates/>
                </ol>
            </xsl:when>
            <xsl:when test="@type='bulleted'">
                <ul>
                    <xsl:apply-templates/>
                </ul>
            </xsl:when>
        </xsl:choose>
    </xsl:template>

    <xsl:template match="listItem">
        <li>
            <xsl:apply-templates/>
        </li>
    </xsl:template>

    <!-- templates for a basic table -->

    <xsl:template match="table">
        <br/>
        <br/>
        <div align='center'>
            <table border='1' cellpadding='3'>
                <xsl:apply-templates/>
            </table>
            <br/>
            <i>
                <xsl:value-of select="@caption"/>
            </i>
        </div>
    </xsl:template>

    <xsl:template match="row">
        <tr>
            <xsl:apply-templates/>
        </tr>
    </xsl:template>

    <xsl:template match="column">
        <td align="left">
            <xsl:apply-templates/>&#160;
        </td>
    </xsl:template>

    <xsl:template match="revieweditem">
        <p class='body'>
            <xsl:apply-templates/>
        </p>
    </xsl:template>

    <xsl:template match="refitem/titleOfLongWork">
        <xsl:text> </xsl:text>
        <span class='italics'>
            <xsl:apply-templates/>
        </span>
    </xsl:template>

    <xsl:template match="titleOfLongWork">
        <span class='italics'>
            <xsl:apply-templates/>
        </span>
    </xsl:template>

    <xsl:template match="titleOfShortWork">
        <xsl:text>&quot;</xsl:text>
        <xsl:apply-templates/>
        <xsl:text>&quot;</xsl:text>
    </xsl:template>

    <xsl:template match="title">
        <tr>
            <td align="center">
                <xsl:apply-templates/>
            </td>
        </tr>
    </xsl:template>

    <xsl:template match="stanza">
        <tr>
            <td>
                <xsl:apply-templates/>
            </td>
        </tr>
    </xsl:template>

    <xsl:template match="line">
        <xsl:apply-templates/>
        <xsl:if test="position()!=last()">
            <br/>
        </xsl:if>
    </xsl:template>

    <xsl:template match="sentence">
        <xsl:apply-templates/>
    </xsl:template>

    <xsl:template match="link">
        <xsl:variable name="link">
            <xsl:choose>
                <xsl:when test="contains(., 'atropos')">
                    <xsl:text></xsl:text><xsl:value-of select="substring-after(., 'atropos.english.uga.edu')"/>
                </xsl:when>
                <xsl:when test="contains(., 'bandl')">
                    <xsl:text></xsl:text><xsl:value-of select="substring-after(., 'bandl.english.uga.edu')"/>
                </xsl:when>
                <xsl:otherwise>
                    <xsl:value-of select="."/>
                </xsl:otherwise>
            </xsl:choose>
        </xsl:variable>
        <xsl:variable name="uri">
            <xsl:choose>
                <xsl:when test="contains(@uri, 'atropos')">
                    <xsl:text></xsl:text><xsl:value-of select="substring-after(@uri, 'atropos.english.uga.edu')"/>
                </xsl:when>
                <xsl:when test="contains(@uri, 'bandl')">
                    <xsl:text></xsl:text><xsl:value-of select="substring-after(@uri, 'bandl.english.uga.edu')"/>
                </xsl:when>
                <xsl:otherwise>
                    <xsl:value-of select="@uri"/>
                </xsl:otherwise>
            </xsl:choose>
        </xsl:variable>
        <xsl:choose>
            <xsl:when test="@uri">
                <a href="{$uri}">
                    <xsl:apply-templates/>
                </a>
            </xsl:when>
            <xsl:otherwise>
                <a href="{$link}">
                    <xsl:apply-templates/>
                </a>
            </xsl:otherwise>
        </xsl:choose>
    </xsl:template>

    <xsl:template match="soundClip">
        <xsl:variable name="soundClip">
            <xsl:value-of select="."/>
        </xsl:variable>
        <xsl:variable name="uri">
            <xsl:choose>
                <xsl:when test="contains(@uri, 'atropos')">
                    <xsl:text></xsl:text><xsl:value-of select="substring-after(@uri, 'atropos.english.uga.edu')"/>
                </xsl:when>
                <xsl:when test="contains(@uri, 'bandl')">
                    <xsl:text></xsl:text><xsl:value-of select="substring-after(@uri, 'bandl.english.uga.edu')"/>
                </xsl:when>
                <xsl:otherwise>
                    <xsl:value-of select="@uri"/>
                </xsl:otherwise>
            </xsl:choose>
        </xsl:variable>
        <FORM>
            <INPUT type="button" value="{@format}" onClick="window.open('{$uri}','audiowindow','width=50,height=10')"/>
        </FORM>
        <i>
            <xsl:apply-templates/>
        </i>
    </xsl:template>


    <xsl:template match="filmClip">
        <xsl:variable name="filmClip">
            <xsl:value-of select="."/>
        </xsl:variable>
        <xsl:variable name="uri">
            <xsl:choose>
                <xsl:when test="contains(@uri, 'atropos')">
                    <xsl:text></xsl:text><xsl:value-of select="substring-after(@uri, 'atropos.english.uga.edu')"/>
                </xsl:when>
                <xsl:when test="contains(@uri, 'bandl')">
                    <xsl:text></xsl:text><xsl:value-of select="substring-after(@uri, 'bandl.english.uga.edu')"/>
                </xsl:when>
                <xsl:otherwise>
                    <xsl:value-of select="@uri"/>
                </xsl:otherwise>
            </xsl:choose>
        </xsl:variable>

        <xsl:choose>
            <xsl:when test="contains(@uri, 'kaltura')">
                <table align="center" cellspacing='10'>
                <tr>
                    <td style="padding:20px">
                        <iframe id="kaltura_player{position()}"
                                src="{@uri}"
                                width="608" height="402"
                                allowfullscreen="allowfullscreen"
                                webkitallowfullscreen="webkitallowfullscreen"
                                mozAllowFullScreen="mozAllowFullScreen"
                                frameborder="0">
                        </iframe>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <i>
                            <xsl:value-of select="@caption"/>
                        </i>
                    </td>
                </tr>
                </table>
            </xsl:when>
            <xsl:when test="contains(@uri, '.mov') or contains(@uri, '.mp4')">
                <table align="center" cellspacing='10'>
                    <tr>
                        <td style="padding:20px">
                            <script src="http://podcaster.gcsu.edu/AC_Quicktime/ac_quicktime.js" language="JavaScript" type="text/javascript"></script>
                            <script src="http://podcaster.gcsu.edu/AC_Quicktime/qtp_library.js" language="JavaScript" type="text/javascript"></script>

                            <script type="text/javascript">
                                QT_WritePoster_XHTML('Click to Play', '<xsl:value-of select="@poster"/>',
                                '<xsl:value-of select="@uri"/>',
                                '601', '364', '',
                                'controller', 'true',
                                'autoplay', 'false',
                                'bgcolor', 'black',
                                'scale', 'tofit');

                            </script>
                            <noscript>
                                <object width="601" height="364" classid="clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B"
                                        codebase="http://www.apple.com/qtactivex/qtplugin.cab">
                                    <param name="src" value="{@poster}"/>
                                    <param name="href" value="{@uri}"/>
                                    <param name="target" value="myself"/>
                                    <param name="controller" value="false"/>
                                    <param name="autoplay" value="true"/>
                                    <param name="scale" value="tofit"/>
                                    <embed width="601" height="364" type="video/quicktime" pluginspage="http://www.apple.com/quicktime/download/"
                                           src=""
                                           href="{@uri}"
                                           target="myself"
                                           controller="false"
                                           autoplay="true"
                                           scale="tofit">
                                    </embed>
                                </object>
                            </noscript>


                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                            <i>
                                <xsl:value-of select="@caption"/>
                            </i>
                        </td>
                    </tr>
                </table>


            </xsl:when>
            <xsl:otherwise>
                <center>
                    <FORM ACTION="{$uri}" METHOD="GET">
                        <INPUT TYPE="submit" VALUE="Video: RealPlayer required"/>
                    </FORM>
                    <i>
                        <xsl:apply-templates/>
                    </i>
                </center>
                <br/>
            </xsl:otherwise>
        </xsl:choose>
    </xsl:template>


    <xsl:template name="globalReplace">
        <xsl:param name="outputString"/>
        <xsl:param name="target"/>
        <xsl:param name="target2"/>
        <xsl:param name="replacement"/>
        <xsl:choose>
            <xsl:when test="contains($outputString,$target)">

                <xsl:value-of select=
                                      "concat(substring-before($outputString,$target),
           $replacement)"/>
                <xsl:call-template name="globalReplace">
                    <xsl:with-param name="outputString"
                                    select="substring-after($outputString,$target)"/>
                    <xsl:with-param name="target" select="$target"/>
                    <xsl:with-param name="replacement"
                                    select="$replacement"/>
                </xsl:call-template>
            </xsl:when>
            <!--
            <xsl:when test="contains($outputString,$target2)">

              <xsl:value-of select=
                "concat(substring-before($outputString,$target2),
                       $replacement2)"/>
              <xsl:call-template name="globalReplace">
                <xsl:with-param name="outputString"
                     select="substring-after($outputString,$target2)"/>
                <xsl:with-param name="target" select="$target2"/>
                <xsl:with-param name="replacement2"
                     select="$replacement2"/>
              </xsl:call-template>
            </xsl:when>  -->
            <xsl:otherwise>
                <xsl:value-of select="$outputString"/>
            </xsl:otherwise>
        </xsl:choose>
    </xsl:template>


    <xsl:template match="bio">
        <xsl:value-of select="." disable-output-escaping="yes"/>
        <br/>
        <br/>
    </xsl:template>


    <xsl:template match="underline">
        <span class='underline'>
            <xsl:apply-templates/>
        </span>
    </xsl:template>

    <xsl:template match="pdfReplace">
        <xsl:apply-templates/>
    </xsl:template>

    <xsl:template match="indent">&#160;&#160;&#160;&#160;&#160;</xsl:template>

    <xsl:template match="preserveSpace">
        <pre>
            <xsl:apply-templates/>
        </pre>
    </xsl:template>


</xsl:stylesheet>
