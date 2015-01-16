&lt;?php echo &lt;&lt;&lt;EOF
The console command has been generated.
&lt;br&gt;&lt;br&gt;
You may add the following to 
&lt;strong&gt;protected/config/console.php&lt;/strong&gt;'s 
&lt;em&gt;commandMap&lt;/em&gt; to activate it:
&lt;br&gt;&lt;br&gt;
&lt;code&gt;
'$command' =&gt; array(&lt;br&gt;
&lt;nobr&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;'class' =&gt; '$scriptPath.$command.$className',&lt;/nobr&gt;
&lt;br&gt;
),&lt;br&gt;
&lt;/code&gt;
EOF;