6D`c<?php exit; ?>a:1:{s:7:"content";O:8:"stdClass":24:{s:2:"ID";i:30;s:11:"post_author";s:1:"1";s:9:"post_date";s:19:"2022-04-09 14:46:09";s:13:"post_date_gmt";s:19:"2022-04-09 14:46:09";s:12:"post_content";s:1975:"<!-- wp:paragraph -->
<p>There is no direct setting that you can use to get back the old Windows 10 context menu on Windows 11. Instead, you have to tweak the registry editor a little bit to restore the classic context menu.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Before attempting any change on your registry, you should get a backup if you have no idea what this is. </p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"backgroundColor":"light-gray"} -->
<p class="has-light-gray-background-color has-background">Press <strong><kbd>Win</kbd>+<kbd>R</kbd>,</strong> enter "cmd" in the Run command and hit <kbd><strong>Enter</strong></kbd>.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>If you have UAC activated in any setting other than off you will need to run it as an administrator. Write "cmd" and the command prompt will appear. Right click on it and pick "Run as administrator".</p>
<!-- /wp:paragraph -->

<!-- wp:image {"id":31,"sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full"><img src="https://kourentzes.com/konstantinos/wp-content/uploads/2022/04/run_cmd_as_administrator.png" alt="" class="wp-image-31"/><figcaption>run_as_administrator</figcaption></figure>
<!-- /wp:image -->

<!-- wp:code -->
<pre class="wp-block-code"><code>reg.exe add “HKCU\Software\Classes\CLSID\{86ca1aa0-34aa-4e8b-a509-50c905bae2a2}\InprocServer32” /f</code></pre>
<!-- /wp:code -->

<!-- wp:paragraph -->
<p>Copy paste the above Registry entry and press enter.</p>
<!-- /wp:paragraph -->

<!-- wp:image {"id":32,"sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full"><img src="https://kourentzes.com/konstantinos/wp-content/uploads/2022/04/reg_exe_from_cmd.png" alt="" class="wp-image-32"/></figure>
<!-- /wp:image -->

<!-- wp:paragraph -->
<p></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>et voila!</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p></p>
<!-- /wp:paragraph -->";s:10:"post_title";s:76:"Restore the Old Context (Right-Click) Menu via Registry Editor in Windows 11";s:12:"post_excerpt";s:0:"";s:11:"post_status";s:7:"publish";s:14:"comment_status";s:4:"open";s:11:"ping_status";s:4:"open";s:13:"post_password";s:0:"";s:9:"post_name";s:74:"restore-the-old-context-right-click-menu-via-registry-editor-in-windows-11";s:7:"to_ping";s:0:"";s:6:"pinged";s:0:"";s:13:"post_modified";s:19:"2022-04-09 14:48:02";s:17:"post_modified_gmt";s:19:"2022-04-09 14:48:02";s:21:"post_content_filtered";s:0:"";s:11:"post_parent";i:0;s:4:"guid";s:41:"https://kourentzes.com/konstantinos/?p=30";s:10:"menu_order";i:0;s:9:"post_type";s:4:"post";s:14:"post_mime_type";s:0:"";s:13:"comment_count";s:1:"0";s:6:"filter";s:3:"raw";}}