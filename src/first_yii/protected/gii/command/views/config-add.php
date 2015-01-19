echo print <<< EOF
The console command has been generated.
<br><br>
You may add the following to 
<strong>protected/config/console.php</strong>'s 
<em>commandMap</em> to activate it:
<br><br>
<code>
'$command' => array(<br>
<nobr>&nbsp;&nbsp;&nbsp;'class' => '$scriptPath.$command.$className',</nobr>
<br>
),<br>
</code>
EOF;