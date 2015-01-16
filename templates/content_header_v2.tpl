{* Common content header markup 
   Defines the header div and its contents 
   Version 2
*}
<div id="headerv2">
{$pgtitle}
{* Global search input control *}
{if $dosearch}
<div style="display: inline-block; padding-right: 2px; float: right;">
<img src="images/search.gif" border="none"/>
<input id="search_term"/>
</div>
{/if}
{* menu display control *}
{if $domenu}{include file="brainjarmenu.tpl"}{/if}
</div>
