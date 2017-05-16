<xsl:template match="search_page">
    <div class="col-xs-12 col-md-4 shop_item">
        <div class="item">
            <div class="grid_wrap">
                <div class="product-image">
                    <a href="{url}">
                        <xsl:choose>
                            <xsl:when test="shop_item/image_small != ''">
                                <img src="{shop_item/dir}{shop_item/image_small}" class="image"/>
                            </xsl:when>
                            <xsl:otherwise>
                                <img src="/images/theme/omtex/noPhoto.jpg" class="image"/>
                            </xsl:otherwise>
                        </xsl:choose>
                    </a>
                </div>
                <p class="text-center">
                    <a href="{url}">
                        <xsl:value-of select="title"/>
                    </a>
                </p>
                <p class="text-center price-box">
                    <xsl:value-of select="format-number(shop_item/price_tax, '### ##0,00', 'my')"/>
                    <xsl:text> </xsl:text>
                    <xsl:value-of select="shop_item/currency"/>
                </p>
                <p>
                <div class="shop_property in-stock">
                    В наличии: <span><xsl:value-of select="shop_item/rest"/></span>
                </div>
                </p>
            </div>
        </div>
    </div>
</xsl:template>