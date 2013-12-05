<!--
<br><br>
<span  onclick='javascript:Editor.AddText( "content" , "\n[template type=\"full-width\"]\nFull Width Text\n[/template]\n");'>Full Width</span>
<span  onclick='javascript:Editor.AddText( "content" , "\n[template type=\"two-col\"]\nFirst Col Text\n[/template]\n\n[template type=\"two-col\"]\nSecond Col Text\n[/template]\n");'>Two Col</span>
<span  onclick='javascript:Editor.AddText( "content" , "\n[template type=\"three-col\"]\nFirst Col Text\n[/template]\n\n[template type=\"three-col\"]\nSecond Col Text\n[/template]\n\n[template type=\"three-col\"]\nThird Col Text\n[/template]\n");'>Three Col</span>
<span  onclick='javascript:Editor.AddText( "content" , "\n[template type=\"four-col\"]\nFirst Col Text\n[/template]\n\n[template type=\"four-col\"]\nSecond Col Text\n[/template]\n\n[template type=\"four-col\"]\nThird Col Text\n[/template]\n\n[template type=\"four-col\"]\nFourth Col Text\n[/template]\n");'>Four Col</span>
<span  onclick='javascript:Editor.AddText( "content" , "\n[template type=\"delimiter\"][/template]\n");'>Delimiter</span>
<span  onclick='javascript:Editor.AddText( "content" , "\n[template type=\"blockquote\"]\nBlockquote Text\n[/template]\n");'>Blockquote</span>
<span  onclick='javascript:Editor.AddText( "content" , "\n-br-[check_list type=\"default\"]\n<ul>\n\t<li>First Item</li>\n\t<li>Second Item</li>\n\t<li>Third Item</li>\n</ul>\n[/check_list]\n-br-");'>Checklist</span>
<span  onclick='javascript:Editor.AddText( "content" , "\n[button type=\"default\"]\nButton Label\n[/button]\n");'>Buttons</span>
<span  onclick='javascript:Editor.AddText( "content" , "\n[box type=\"default\"]\nbox Description\n[/box]\n");'>Box</span>
<span  onclick='javascript:Editor.AddText( "content" , "\n[toggle type=\"default\"]\nToggle Description\n[/toggle]\n");'>Toggle</span>
<span  onclick='javascript:Editor.AddText( "content" , "\n[tabs type=\"default\"]\nTab Description\n[/tabs]\n");'>Tabs</span>

<br><br> -->
<div id="notify">
	<p class="cosmo-box tick" style="margin-left: 0px;"><span class="cosmo-ico"></span>Shortcode was inserted</p>
</div>
<div id="error_message">
	<p class="cosmo-box error" style="margin-left: 0px;"><span class="cosmo-ico"></span>Sorry, something went wrong.</p>
</div>
<div class="shcode-tabber" >
    <ul class="tabs" id="shmenu">    <!-- the container for the tabs -->
        <li id="shtemplate" class="current"><a href="javascript:void(0)"><?php _e( 'Columns' , 'cosmotheme' ); ?></a></li>
        <li id="shbutton" ><a href="javascript:void(0)"><?php _e( 'Button' , 'cosmotheme' ); ?></a></li>
        <li id="tabs" ><a href="javascript:void(0)"> <?php _e( 'Tabs &amp; Toggles' , 'cosmotheme' ); ?></a></li>
        <li id="box" ><a href="javascript:void(0)"><?php _e( 'Info Box' , 'cosmotheme' ); ?></a></li>
        <li id="devider" ><a href="javascript:void(0)"><?php _e( 'Typography' , 'cosmotheme' ); ?></a></li>
        <li id="contact" ><a href="javascript:void(0)"><?php _e( 'Map/Contact' , 'cosmotheme' ); ?></a></li>
        <li id="conference" ><a href="javascript:void(0)"><?php _e( 'Conference' , 'cosmotheme' ); ?></a></li>
        <li id="price_table" ><a href="javascript:void(0)"><?php _e( 'Price Table' , 'cosmotheme' ); ?></a></li>
		<li id="table" ><a href="javascript:void(0)"><?php _e( 'Table' , 'cosmotheme' ); ?></a></li>  
    </ul>
    <div class="panels">    <!-- the container for contents -->
        <div  id="shtemplate">
            <?php include 'column.php'; ?>
        </div>
        <div id="shbutton" class="panel none">
            <?php include 'button.php'; ?>
        </div>
        <div id="tabs" class="panel none">
            <?php include 'tabs.php'; ?>
        </div>
        <div id="box" class="panel none">
            <?php include 'box.php'; ?>
        </div>
        <div id="devider" class="panel none">
            <?php include 'devider.php'; ?>
        </div>
        <div id="contact" class="panel none">
            <?php include 'contact.php'; ?>
        </div>
        <div id="conference" class="panel none">
            <?php include 'conference.php'; ?>
        </div>
        <div id="price_table" class="panel none">
            <?php include 'price.php'; ?>
        </div>
		<div id="table" class="panel none">
            <?php include 'table.php'; ?>
        </div>
    </div>
</div>
