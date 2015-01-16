<?php /* Smarty version 2.6.21, created on 2014-07-10 21:19:46
         compiled from content_header.tpl */ ?>

<div id="header">
<?php echo $this->_tpl_vars['pgtitle']; ?>

<?php if ($this->_tpl_vars['domenu']): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?>

</div>