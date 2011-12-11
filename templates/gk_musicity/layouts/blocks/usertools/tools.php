	<a class="tools_size_btn" title="<?php echo JText::_('Increase font size');?>" id="gk-tool-increase" onclick="switchFontSize('<?php echo $this->template."_".GK_TOOL_FONT;?>','inc'); return false;">A+</a>
	
	<a class="tools_size_btn" title="<?php echo JText::_('Default font size');?>" id="gk-tool-reset" onclick="switchFontSize('<?php echo $this->template."_".GK_TOOL_FONT;?>',<?php echo $this->_tpl->params->get(GK_TOOL_FONT);?>); return false;">R</a>
	
	<a class="tools_size_btn" title="<?php echo JText::_('Decrease font size');?>" id="gk-tool-decrease" onclick="switchFontSize('<?php echo $this->template."_".GK_TOOL_FONT;?>','dec'); return false;">A-</a>

<script type="text/javascript">var CurrentFontSize=parseInt('<?php echo $this->getParam(GK_TOOL_FONT);?>');</script>