<?php /* Smarty version 2.6.21, created on 2014-11-12 03:39:17
         compiled from content_header_v2.tpl */ ?>
<div id="headerv2">
<?php echo $this->_tpl_vars['pgtitle']; ?>

<?php if ($this->_tpl_vars['dosearch']): ?>
<div style="display: inline-block; padding-right: 2px; float: right;">
<img src="images/search.gif" border="none"/>
<input id="search_term"/>
</div>
<?php endif; ?>
<?php if ($this->_tpl_vars['domenu']): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "brainjarmenu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?>
</div>